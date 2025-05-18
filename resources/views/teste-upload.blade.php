<!DOCTYPE html>
<html>
<head>
    <title>Teste Upload</title>
</head>
<body>
    <h1>Testar upload para pasta de logs</h1>

    @if(session('erro'))
        <p style="color:red;">{{ session('erro') }}</p>
    @endif

    <form action="{{ url('/teste-upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="arquivo" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
