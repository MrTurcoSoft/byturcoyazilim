<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giriş - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Admin Paneli</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-2">Devam etmek için giriş yapın</p>
            </div>
            
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg text-red-600 dark:text-red-400 text-sm">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            
            <form action="{{ route('login') }}" method="POST" data-testid="login-form">
                @csrf
                
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">E-posta</label>
                    <input type="email" id="email" name="email" required autofocus value="{{ old('email') }}"
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           data-testid="login-email">
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Şifre</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                           data-testid="login-password">
                </div>
                
                <div class="flex items-center mb-6">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-blue-600 rounded border-gray-300">
                    <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-400">Beni hatırla</label>
                </div>
                
                <button type="submit" class="w-full px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors" data-testid="login-submit">
                    Giriş Yap
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-blue-600">
                    ← Ana Sayfaya Dön
                </a>
            </div>
        </div>
    </div>
</body>
</html>
