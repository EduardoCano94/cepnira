<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEPNIRA — Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-900 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">

        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-blue-900">CEPNIRA</h1>
            <p class="text-gray-500 text-sm mt-1">Sistema Administrativo Escolar</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="usuario@cepnira.mx" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••" required>
            </div>

            <button type="submit"
                class="w-full bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2 rounded-lg transition">
                Iniciar sesión
            </button>
        </form>

    </div>

</body>
</html>