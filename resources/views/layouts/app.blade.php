<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEPNIRA — @yield('titulo', 'Sistema Administrativo')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-blue-900 text-white flex flex-col min-h-screen fixed">
        <div class="p-6 border-b border-blue-800">
            <h1 class="text-xl font-bold">CEPNIRA</h1>
            <p class="text-blue-300 text-xs mt-1">Sistema Administrativo</p>
        </div>

        <nav class="flex-1 p-4 flex flex-col gap-1">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-800 {{ request()->routeIs('dashboard') ? 'bg-blue-800' : '' }}">
                Dashboard
            </a>

            @if(in_array(auth()->user()->rol, ['secretaria','subdirector','director']))
            <a href="{{ route('alumnos.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-800 {{ request()->routeIs('alumnos.*') ? 'bg-blue-800' : '' }}">
                Alumnos
            </a>
            @endif

            @if(in_array(auth()->user()->rol, ['director','subdirector']))
            <a href="{{ route('validacion.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-blue-800 {{ request()->routeIs('validacion.*') ? 'bg-blue-800' : '' }}">
                Validación
            </a>
            @endif
        </nav>

        <div class="p-4 border-t border-blue-800">
            <p class="text-sm text-blue-300 mb-1">{{ auth()->user()->name }}</p>
            <p class="text-xs text-blue-400 mb-3 capitalize">{{ auth()->user()->rol }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full bg-red-600 hover:bg-red-700 text-white text-sm py-2 rounded-lg">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </aside>

    {{-- Contenido principal --}}
    <main class="ml-64 flex-1 p-6">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 px-4 py-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('info'))
            <div class="bg-yellow-100 text-yellow-800 border border-yellow-300 px-4 py-3 rounded-lg mb-4">
                {{ session('info') }}
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>