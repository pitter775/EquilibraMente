<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function index()
    {
        // Exibe a tela principal de usuários (com DataTable carregado via AJAX)
        return view('admin.usuarios.index');
    }
    public function listar()
    {
        // Retorna todos os usuários no formato JSON para o DataTable
        $usuarios = User::all();
        return response()->json($usuarios);
    }
    public function cadastrar(Request $request)
    {
        $usuario = new User();
        $usuario->name = $request->input('fullname');
        $usuario->email = $request->input('email');
        $usuario->tipo_usuario = $request->input('perfil');
        $usuario->cpf = $request->input('cpf');
        $usuario->sexo = $request->input('sexo');
        $usuario->idade = $request->input('idade');
        $usuario->photo = $request->input('photo');
        $usuario->telefone = $request->input('telefone'); // Salva o telefone com DDD
        $usuario->status = $request->input('status');
        $usuario->registro_profissional = $request->input('registro_profissional');
        $usuario->tipo_registro_profissional = $request->input('tipo_registro_profissional');
        $usuario->password = Hash::make($request->input('senha'));
        $usuario->save();
    
        // Salva o endereço (se aplicável)
        if ($request->filled(['endereco_rua', 'endereco_numero', 'endereco_bairro', 'endereco_cidade', 'endereco_estado', 'endereco_cep'])) {
            $usuario->endereco()->create([
                'rua' => $request->input('endereco_rua'),
                'numero' => $request->input('endereco_numero'),
                'complemento' => $request->input('endereco_complemento'),
                'bairro' => $request->input('endereco_bairro'),
                'cidade' => $request->input('endereco_cidade'),
                'estado' => $request->input('endereco_estado'),
                'cep' => $request->input('endereco_cep')
            ]);
        }
    
        return response()->json(['success' => true]);
    }  
    public function atualizar($id, Request $request)
    {
        $usuario = User::findOrFail($id);
        $usuario->name = $request->input('fullname');
        $usuario->email = $request->input('email');
        $usuario->tipo_usuario = $request->input('perfil');
        $usuario->cpf = $request->input('cpf');
        $usuario->sexo = $request->input('sexo');
        $usuario->idade = $request->input('idade');
        $usuario->telefone = $request->input('telefone');
        $usuario->photo = $request->input('photo');
        $usuario->status = $request->input('status');
        $usuario->registro_profissional = $request->input('registro_profissional');
        $usuario->tipo_registro_profissional = $request->input('tipo_registro_profissional');
    
        if ($request->filled('senha')) {
            $usuario->password = Hash::make($request->input('senha'));
        }
    
        $usuario->save();
    
        // Atualização do endereço
        if ($request->filled(['endereco_rua', 'endereco_numero', 'endereco_bairro', 'endereco_cidade', 'endereco_estado', 'endereco_cep'])) {
            $usuario->endereco()->updateOrCreate(
                [],
                [
                    'rua' => $request->input('endereco_rua'),
                    'numero' => $request->input('endereco_numero'),
                    'complemento' => $request->input('endereco_complemento'),
                    'bairro' => $request->input('endereco_bairro'),
                    'cidade' => $request->input('endereco_cidade'),
                    'estado' => $request->input('endereco_estado'),
                    'cep' => $request->input('endereco_cep')
                ]
            );
        } else {
            $usuario->endereco()->delete();
        }
    
        return response()->json(['success' => true]);
    }
    public function deletar($id)
    {
        // Exclui o usuário pelo ID
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return response()->json(['success' => true]);
    }
    public function detalhes($id)
    {
        $usuario = User::with('endereco')->findOrFail($id);
        return response()->json($usuario);
    }   
    public function toggleStatus(User $user)
    {
        // Alterna o status do usuário entre 'ativo' e 'inativo'
        $user->status = $user->status === 'ativo' ? 'inativo' : 'ativo';
        $user->save();

        return redirect()->route('admin.usuarios.index')->with('success', 'Status do usuário atualizado!');
    }
    public function completarCadastro(Request $request)
    {
        \Log::info('Dados recebidos no completarCadastro:', $request->all());
    
        // Validação dos dados
        $request->validate([
            'fullname' => 'required|string|max:255',
            'photo' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:15',
            'cpf' => 'required|string|max:14',
            'sexo' => 'required|string|max:10',
            'idade' => 'required|integer',
            'registro_profissional' => 'nullable|string|max:255',
            'senha' => 'required|string|min:8|confirmed',
            'tipo_registro_profissional' => 'nullable|string|max:255',
            'endereco_rua' => 'required|string|max:255',
            'endereco_numero' => 'required|string|max:10',
            'endereco_complemento' => 'nullable|string|max:255',
            'endereco_bairro' => 'required|string|max:255',
            'endereco_cidade' => 'required|string|max:255',
            'endereco_estado' => 'required|string|max:2',
            'endereco_cep' => 'required|string|max:9',
        ]);

        \Log::info('Validouuu');
    
    
        if (Auth::check()) {
            \Log::info('Tá logado');
            $user = Auth::user();
            // Atualiza o usuário existente
            $user->update([
                'name' => $request->input('fullname'),
                'photo' => $request->input('photo'),
                'email' => $request->input('email'),
                'telefone' => $request->input('telefone'),
                'cpf' => $request->input('cpf'),
                'sexo' => $request->input('sexo'),
                'idade' => $request->input('idade'),
                'registro_profissional' => $request->input('registro_profissional'),
                'tipo_registro_profissional' => $request->input('tipo_registro_profissional'),
                'password' => Hash::make($request->input('senha')), // Adiciona o hash da senha
                'cadastro_completo' => true, // Marca o cadastro como completo
            ]);

        } else {

            \Log::info('Não esta logado ');
            
             // Verifica se o e-mail já existe
                $existingUser = User::where('email', $request->input('email'))->first();

                if ($existingUser) {
                    // Retorna uma mensagem de erro se o e-mail já está cadastrado
                    \Log::info('ja existe um usuario com memsmo emil');
                    if ($request->ajax()) {
                        return response()->json([
                            'error' => 'E-mail já cadastrado. Faça login ou use outro e-mail.'
                        ], 422);
                    }
                    return redirect()->back()->with('error', 'E-mail já cadastrado. Faça login ou use outro e-mail.');
                
                }
            // Cria um novo usuário e realiza o login
            $user = User::create([
                'name' => $request->input('fullname'),
                'email' => $request->input('email'),
                'telefone' => $request->input('telefone'),
                'cpf' => $request->input('cpf'),
                'sexo' => $request->input('sexo'),
                'idade' => $request->input('idade'),
                'registro_profissional' => $request->input('registro_profissional'),
                'tipo_registro_profissional' => $request->input('tipo_registro_profissional'),
                'password' => Hash::make($request->input('senha')), // Hash da senha
                'cadastro_completo' => true, // Marca o cadastro como completo
            ]);

            if ($user) {

                \Log::info('novo usuario criado');
            }else{
                \Log::info('criou um novo');
            }

           
    
            Auth::login($user); // Realiza o login automaticamente
        }
    
        // Atualiza ou cria o endereço relacionado
        $user->endereco()->updateOrCreate([], [
            'rua' => $request->input('endereco_rua'),
            'numero' => $request->input('endereco_numero'),
            'complemento' => $request->input('endereco_complemento'),
            'bairro' => $request->input('endereco_bairro'),
            'cidade' => $request->input('endereco_cidade'),
            'estado' => $request->input('endereco_estado'),
            'cep' => $request->input('endereco_cep'),
        ]);
    
        // Determina a URL de redirecionamento
        $redirectUrl = session()->has('url_detalhe')
            ? session('url_detalhe')
            : route('site.index'); // Redireciona para a home após o login
    
        \Log::info('Redirecionando para URL:', ['redirectUrl' => $redirectUrl]);
    
        // Verifica se a requisição é AJAX
        if ($request->ajax()) {
            return response()->json([
                'redirect' => $redirectUrl,
                'message' => 'Cadastro completado com sucesso!',
            ]);
        }
    
        // Redireciona normalmente, se não for uma requisição AJAX
        return redirect($redirectUrl)->with('success', 'Cadastro completado com sucesso!');
    }
    
    

    public function mostrarFormularioCompletarCadastro()
    {
        // Envia os dados do Google pela sessão, se estiverem disponíveis
        $googleData = session('google_data', []);

        return view('site.completar-cadastro', compact('googleData'));
    }


}
