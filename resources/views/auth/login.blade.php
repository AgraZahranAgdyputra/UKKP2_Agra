<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'Admin Panel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-slate-100 px-4">

    <div class="w-full max-w-sm rounded-2xl bg-white p-8 shadow-lg">
        <div class="mb-8 text-center">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-500 text-lg font-bold text-white">
                A
            </div>
            <h1 class="text-xl font-semibold text-slate-800">Masuk ke Admin Panel</h1>
            <p class="mt-1 text-sm text-slate-500">Silakan login untuk melanjutkan</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="admin@mail.com"
                />
            </div>

            <div>
                <x-input-label for="password" value="Password" />
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                />
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                Ingat saya
            </label>

            <x-button type="submit" class="w-full justify-center">
                Masuk
            </x-button>
        </form>
    </div>

</body>
</html>
