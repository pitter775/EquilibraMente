<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\SiteController;
use App\Http\Controllers\cliente\ClienteDashboardController;
use App\Http\Controllers\cliente\ReservaClienteController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\SalaController;
use App\Http\Controllers\admin\ReservaController;
use App\Http\Controllers\admin\RelatorioController;
use App\Http\Controllers\admin\UsuarioController;
use App\Http\Controllers\ImagemSalaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CepController;


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
    \Log::error('Teste de log - verificando sistema de logs');
    abort(500, 'Erro proposital para testar logs');
});


Route::get('/politica-privacidade', function () {
    return view('site.politica-privacidade1');
})->name('privacidade');

// Rota pública para o site
Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/sala/{id}', [SiteController::class, 'detalhes'])->name('site.sala.detalhes');


// Rota para exibir a página de revisão da reserva (GET)
Route::get('/reserva/revisao', [SiteController::class, 'exibirRevisao'])->name('reserva.revisao');
// Rota para processar os dados da reserva e salvar na sessão (POST)
Route::post('/reserva/revisao', [SiteController::class, 'revisao'])->name('reserva.revisao.processar');
// Rota para confirmar a reserva (POST)
// Route::post('/reserva/confirmar', [SiteController::class, 'salvarReserva'])->name('reserva.confirmar');
Route::post('/reserva/salvar', [SiteController::class, 'salvarReserva'])->name('reserva.salvar');





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
});

// Rotas para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/salas', [SalaController::class, 'index'])->name('salas.index');
    Route::get('/admin/salas/create', [SalaController::class, 'create'])->name('salas.create');
    Route::post('/admin/salas', [SalaController::class, 'store'])->name('salas.store');
    Route::get('/admin/salas/{sala}/edit', [SalaController::class, 'edit'])->name('salas.edit');
    Route::post('/admin/salas/{sala}', [SalaController::class, 'update'])->name('salas.update');
    Route::delete('/admin/salas/{sala}', [SalaController::class, 'destroy'])->name('salas.destroy');
    Route::get('/admin/salas/{sala}/dados', [SalaController::class, 'getSalaData'])->name('salas.dados');
    Route::get('/admin/salas/{sala}/imagens', [ImagemSalaController::class, 'index'])->name('imagens.index');
    Route::delete('/admin/imagens/{imagem}', [ImagemSalaController::class, 'destroy'])->name('imagens.destroy');
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





});

// Requisição para autenticação
require __DIR__.'/auth.php';
