<div style="max-width: 600px; margin: 20px auto; font-family: Arial, sans-serif; background-color: #fdfdfd; padding: 30px; border: 1px solid #eee; border-radius: 10px;">

    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('assets/img/logoescuro.png') }}" alt="Logo Equilibra Mente" style="width: 180px; margin-bottom: 10px;">
        <h2 style="color: #4CAF50; font-size: 20px;">Novo cadastro aguardando aprovação</h2>
    </div>

    <p style="text-align: center;"> {{ $user->name }}</p>
    <p style="text-align: center;">{{ $user->email }}</p>
    <p style="text-align: center;">{{ $user->telefone }}</p>

    <div style="margin-top: 30px; text-align: center;">
        <a href="{{ $link }}"
           style="display: inline-block; padding: 12px 24px; background-color: #28a745; color: #fff;
           text-decoration: none; border-radius: 5px; font-weight: bold;">
           ✅ Abrir para aprovar
        </a>
    </div>

    <p style="margin-top: 40px; font-size: 12px; color: #999; text-align: center;">
        Equilibra Mente · Sistema de gestão de salas
    </p>
</div>
