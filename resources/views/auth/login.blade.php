<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIAKAD</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-sm text-gray-800">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-sm">

            <div class="text-center mb-4">
                <h1 class="text-lg font-bold text-gray-700">SIAKAD</h1>
                <p class="text-xs text-gray-500">Sistem Informasi Akademik Sederhana</p>
            </div>

            <div class="bg-white border border-gray-300 p-6">
                <h2 class="font-semibold text-gray-700 mb-4 border-b border-gray-200 pb-2">Login</h2>

                @if (session('status'))
                    <div class="mb-3 px-3 py-2 border border-blue-300 bg-blue-50 text-blue-700 text-xs">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-3 px-3 py-2 border border-red-300 bg-red-50 text-red-700 text-xs">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="block text-xs font-medium text-gray-600 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-3 py-2 border border-gray-300 text-sm focus:outline-none focus:border-blue-500"
                    </div>
                    <div class="mb-3">
                        <label for="password" class="block text-xs font-medium text-gray-600 mb-1">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-3 py-2 border border-gray-300 text-sm focus:outline-none focus:border-blue-500">
                    </div>
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="border-gray-300">
                        <label for="remember" class="ml-2 text-xs text-gray-600">Ingat saya</label>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2">
                        Masuk
                    </button>
                </form>
        </div>
    </div>

</body>
</html>
