<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Contract;

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
            'aceita_contrato' => 'accepted', // valida o checkbox
        ]);
    
        if (Auth::check()) {
            // Atualiza o usuário autenticado
            $user = Auth::user();
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
                'password' => Hash::make($request->input('senha')),
                'cadastro_completo' => true,
            ]);
        } else {
            // Verifica duplicidade de e-mail
            if (User::where('email', $request->input('email'))->exists()) {
                return $request->ajax()
                    ? response()->json(['error' => 'E-mail já cadastrado. Faça login ou use outro e-mail.'], 422)
                    : redirect()->back()->with('error', 'E-mail já cadastrado. Faça login ou use outro e-mail.');
            }
    
            // Cria novo usuário e faz login
            $user = User::create([
                'name' => $request->input('fullname'),
                'email' => $request->input('email'),
                'telefone' => $request->input('telefone'),
                'cpf' => $request->input('cpf'),
                'sexo' => $request->input('sexo'),
                'idade' => $request->input('idade'),
                'registro_profissional' => $request->input('registro_profissional'),
                'tipo_registro_profissional' => $request->input('tipo_registro_profissional'),
                'password' => Hash::make($request->input('senha')),
                'cadastro_completo' => true,
            ]);
    
            Auth::login($user);
        }
    
        // Salva ou atualiza o endereço
        $user->endereco()->updateOrCreate([], [
            'rua' => $request->input('endereco_rua'),
            'numero' => $request->input('endereco_numero'),
            'complemento' => $request->input('endereco_complemento'),
            'bairro' => $request->input('endereco_bairro'),
            'cidade' => $request->input('endereco_cidade'),
            'estado' => $request->input('endereco_estado'),
            'cep' => $request->input('endereco_cep'),
        ]);
    
        // Salva o histórico do contrato
        $user->contratos()->create([
            'versao_contrato' => 'v1.0 - 2025-05-16',
            'aceito_em' => now(),
        ]);
    
        // Redireciona
        // $redirectUrl = session()->pull('voltar_para_sala', route('usuario.minhas.reservas'));
        $redirectUrl = session()->pull('voltar_para_sala', url('/'));
    
        return $request->ajax()
            ? response()->json(['redirect' => $redirectUrl, 'message' => 'Cadastro completado com sucesso!'])
            : redirect($redirectUrl)->with('success', 'Cadastro completado com sucesso!');
    }
    
    

    public function mostrarFormularioCompletarCadastro()
    {
        $googleData = session('google_data', []);
        $contrato = Contract::latest()->first(); // pega o contrato mais recente
    
        return view('site.completar-cadastro', compact('googleData', 'contrato'));
    }


}
