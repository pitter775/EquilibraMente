<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\SiteController;
use App\Http\Controllers\PagBankController;
use App\Http\Controllers\cliente\ClienteDashboardController;
use App\Http\Controllers\cliente\ReservaClienteController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\SalaController;
use App\Http\Controllers\admin\ReservaController;
use App\Http\Controllers\admin\RelatorioController;
use App\Http\Controllers\admin\UsuarioController;
use App\Http\Controllers\admin\ContratoController;
use App\Http\Controllers\ImagemSalaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CepController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\NewsletterController;
use App\Models\DebugLog;
use App\Http\Controllers\admin\FechaduraController;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\CadastroAprovadoMail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\MercadoPagoController;

Route::get('/teste-mercadopago/{id}', [MercadoPagoController::class, 'teste']);
Route::get('/teste-link-falso', [MercadoPagoController::class, 'testeFixo']);





Route::get('/pagar/{reservaId}', [MercadoPagoController::class, 'pagar'])->name('pagar.mercadopago');

Route::get('/pagamento/sucesso', [MercadoPagoController::class, 'sucesso'])->name('pagamento.sucesso');
Route::get('/pagamento/erro', [MercadoPagoController::class, 'erro'])->name('pagamento.erro');
Route::get('/pagamento/pendente', [MercadoPagoController::class, 'pendente'])->name('pagamento.pendente');

// Webhook (importante usar HTTPS real!)
Route::post('/webhook/mercadopago', [MercadoPagoController::class, 'webhook'])->name('mercadopago.webhook');



Route::get('/mercadopago/status/{reservaId}', [MercadoPagoController::class, 'status'])->name('mercadopago.status');



Route::post('/reserva/cancelar', [SiteController::class, 'cancelarReserva']);



// envio para pasta log - tested
Route::get('/teste-upload', [App\Http\Controllers\TesteUploadController::class, 'formulario']);
Route::post('/teste-upload', [App\Http\Controllers\TesteUploadController::class, 'upload']);


Route::get('/debug-request', function () {
    return response()->json([
        'host' => request()->getHost(),
        'url' => request()->fullUrl(),
        'isSecure' => request()->secure(),
        'scheme' => request()->getScheme(),
        'app_url' => config('app.url'),
    ]);
});


Route::get('/teste-aprovar/{id}', function ($id) {
    // dd(request()->secure(), request()->getScheme());
    $link = URL::signedRoute('admin.usuario.aprovacao.ver', ['user' => $id]);
    $appUrl = config('app.url');

    return "
        <h1>Teste de Link de Aprovação</h1>

        <p><strong>APP_URL:</strong> $appUrl</p>

        <p><strong>Link Gerado:</strong></p>
        <a href='$link' 
           style='display:inline-block; padding:10px 20px; background:#28a745; color:#fff; border-radius:5px; text-decoration:none;'
           target='_blank'>
            👉 Acessar Link de Aprovação
        </a>

        <p>Ou copia esse link:</p>
        <p>$link</p>
    ";
});



Route::get('/teste-email-aprovado', function () {
    // Pega o primeiro usuário com status aprovado (ou você coloca um ID fixo)
    $user = User::where('email', 'pitter775@gmail.com')->firstOrFail();

    Mail::to($user->email)->send(new CadastroAprovadoMail($user));

    return 'E-mail de teste enviado para ' . $user->email . ' ✔️';
});


//Isso garante que só quem tem o link assinado pode acessar a imagem.
Route::get('/admin/documento/{user}', function (\App\Models\User $user) {
    if (!$user->documento_caminho || !\Storage::exists($user->documento_caminho)) {
        abort(404);
    }

    $mime = \Storage::mimeType($user->documento_caminho);
    $conteudo = \Storage::get($user->documento_caminho);

    return response($conteudo)->header('Content-Type', $mime);
})->middleware(['signed'])->name('documento.ver');





Route::post('/admin/usuarios/{id}/aprovar', [UsuarioController::class, 'aprovarUsuario'])->name('admin.usuario.aprovar');
Route::post('/admin/usuarios/{id}/reprovar', [UsuarioController::class, 'reprovarUsuario'])->name('admin.usuario.reprovar');



Route::get('/cadastro-aprovado/{user}', [UsuarioController::class, 'verCadastroAprovado'])
    ->name('usuario.aprovado.ver')
    ->middleware('signed');


// email aprovacao
Route::get('/admin/aprovar-cadastro/{user}', [UsuarioController::class, 'verCadastroParaAprovacao'])
    ->name('admin.usuario.aprovacao.ver')
    ->middleware('signed');


Route::post('/admin/aprovar/{user}', [UsuarioController::class, 'aprovarUsuario'])->name('admin.usuario.aprovar.forcar');
Route::post('/admin/reprovar/{user}', [UsuarioController::class, 'reprovarUsuario'])->name('admin.usuario.reprovar.forcar');




Route::get('/reserva/dados/{id}', [SiteController::class, 'buscarDadosReserva']);

// Route::get('/pagbank/status/{referenceId}', [PagBankController::class, 'verificarStatus'])->name('pagbank.status');
// // Route::post('/pagbank/callback', [PagBankController::class, 'callback'])->name('pagbank.callback');
// Route::match(['get', 'post'], '/pagbank/callback', [PagBankController::class, 'callback'])->name('pagbank.callback');


Route::get('/debug/logs', function () {
    return response()->json(DebugLog::latest()->get());
});


Route::get('/debug/clear-logs', function () {
    DebugLog::truncate();
    return response('Logs limpos com sucesso!');
});


// Rota pública para o site
Route::get('/debug-usuario', function () {
    if (!auth()->check()) {
        return response()->json(['error' => 'Usuário não autenticado.']);
    }

    return response()->json([
        'id' => auth()->id(),
        'email' => auth()->user()->email,
        'tipo_usuario' => auth()->user()->tipo_usuario,
        'cadastro_completo' => auth()->user()->cadastro_completo,
    ]);
});

Route::get('/teste-log', function () {
    Log::error('Teste de log - verificando sistema de logs');
    abort(500, 'Erro proposital para testar logs');
});


Route::get('/politica-privacidade', function () {
    return view('site.politica-privacidade1');
})->name('privacidade');
Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/sala/{id}', [SiteController::class, 'detalhes'])->name('site.sala.detalhes');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');


// Rota para exibir a página de revisão da reserva (GET)
Route::get('/reserva/revisao', [SiteController::class, 'exibirRevisao'])->name('reserva.revisao');
// Rota para processar os dados da reserva e salvar na sessão (POST)
Route::post('/reserva/revisao', [SiteController::class, 'revisao'])->name('reserva.revisao.processar');
// Rota para confirmar a reserva (POST)





Route::post('/reserva/confirmar', [SiteController::class, 'confirmar'])->name('reserva.confirmar');




// Rotas para gestão de imagens
Route::post('/salas/{sala}/imagens', [ImagemSalaController::class, 'store'])->name('imagens.store');
Route::delete('/imagens/{imagem}', [ImagemSalaController::class, 'destroy'])->name('imagens.destroy');
Route::post('/imagens/{imagem}/principal', [ImagemSalaController::class, 'definirPrincipal'])->name('imagens.definirPrincipal');

// ** Nova rota para buscar horários disponíveis para uma sala em uma data específica **
Route::get('/horarios-disponiveis/{sala_id}/{data_reserva}', [ReservaController::class, 'horariosDisponiveis'])->name('reservas.horariosDisponiveis');

// Rota para criação de reservas por hora
Route::post('/reservar', [ReservaController::class, 'store'])->name('reservar.store');

// Exibe todas as reservas de uma sala (ainda útil para admin ou dashboard)
Route::get('/reservas/{sala_id}', [ReservaController::class, 'listarReservas']);

// Outras rotas públicas
Route::view('/politica-de-privacidade', 'politica-de-privacidade')->name('politica.privacidade');
Route::view('/termos-de-servico', 'termos-de-servico')->name('termos.servico');

// Google Login e Cadastro Completo
Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/completar-cadastro', [UsuarioController::class, 'mostrarFormularioCompletarCadastro'])->name('completar.cadastro.form');
Route::post('/completar-cadastro', [UsuarioController::class, 'completarCadastro'])->name('completar.cadastro');

// Requisição de busca por CEP
Route::get('/api/cep/{cep}', [CepController::class, 'buscarCep']);

// Rotas para clientes (somente após autenticação)
Route::middleware(['auth'])->group(function () {
    Route::get('/cliente', [ReservaClienteController::class, 'minhasReservas'])->name('cliente.index');
    Route::get('/cliente/reservas', [ReservaClienteController::class, 'minhasReservas'])->name('cliente.reservas');
    Route::get('/cliente/reserva/{reserva}/chave', [ReservaClienteController::class, 'verChave'])->name('cliente.reserva.chave');
    Route::post('/cliente/reservas/{reserva}/cancelar', [ReservaClienteController::class, 'cancelar'])->name('cliente.reservas.cancelar');
    Route::post('/cliente/reservas/{reserva}/pagar', [MercadoPagoController::class, 'pagarReserva'])->name('cliente.reservas.pagar');
});

// Rotas para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/contrato', [ContratoController::class, 'index'])->name('admin.contrato.index');
    Route::post('/contrato', [ContratoController::class, 'salvar'])->name('admin.contrato.salvar');


    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/analitico', [AdminDashboardController::class, 'analitico'])->name('admin.analitico');


    Route::get('/admin/salas', [SalaController::class, 'index'])->name('salas.index');
    Route::get('/admin/salas/create', [SalaController::class, 'create'])->name('salas.create');
    Route::post('/admin/salas', [SalaController::class, 'store'])->name('salas.store');
    Route::get('/admin/salas/{sala}/edit', [SalaController::class, 'edit'])->name('salas.edit');
    Route::post('/admin/salas/{sala}', [SalaController::class, 'update'])->name('salas.update');
    Route::delete('/admin/salas/{sala}', [SalaController::class, 'destroy'])->name('salas.destroy');
    Route::get('/admin/salas/{sala}/dados', [SalaController::class, 'getSalaData'])->name('salas.dados');
    Route::get('/admin/salas/{sala}/imagens', [ImagemSalaController::class, 'index'])->name('imagens.index');
    // Route::delete('/admin/imagens/{imagem}', [ImagemSalaController::class, 'destroy'])->name('imagens.destroy');
    Route::get('/salas/all', [SalaController::class, 'getSalasData'])->name('salas.data');

    // Rotas para gerenciamento de usuários
    Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::get('/admin/usuarios/listar', [UsuarioController::class, 'listar'])->name('admin.usuarios.listar');
    Route::post('/admin/usuarios/cadastrar', [UsuarioController::class, 'cadastrar'])->name('admin.usuarios.cadastrar');
    Route::post('/admin/usuarios/atualizar/{id}', [UsuarioController::class, 'atualizar'])->name('admin.usuarios.atualizar');
    Route::delete('/admin/usuarios/deletar/{id}', [UsuarioController::class, 'deletar'])->name('admin.usuarios.deletar');
    Route::get('/admin/usuarios/detalhes/{id}', [UsuarioController::class, 'detalhes'])->name('admin.usuarios.detalhes');
    Route::post('/admin/usuarios/{user}/toggle-status', [UsuarioController::class, 'toggleStatus'])->name('admin.usuarios.toggle-status');

    // Rotas para reservas e relatórios
    Route::get('/admin/reservas', [ReservaController::class, 'index']);
    Route::get('/admin/reservas/listar', [ReservaController::class, 'listar'])->name('admin.reservas.listar');
    Route::get('/admin/relatorios', [RelatorioController::class, 'index']);


    Route::get('/admin/fechadura', [FechaduraController::class, 'index'])->name('admin.fechadura.index');
    Route::put('/fechaduras/{sala}', [FechaduraController::class, 'atualizar'])->name('fechaduras.update');






});

// Requisição para autenticação
require __DIR__.'/auth.php';
