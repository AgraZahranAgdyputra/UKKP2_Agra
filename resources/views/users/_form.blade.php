@php $user = $user ?? null; @endphp

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
    <div>
        <x-input-label for="name" value="Nama" />
        <x-text-input
            id="name"
            name="name"
            value="{{ old('name', $user->name ?? '') }}"
            required
            autofocus
            placeholder="Nama lengkap"
        />
        <x-input-error :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" value="Email" />
        <x-text-input
            id="email"
            type="email"
            name="email"
            value="{{ old('email', $user->email ?? '') }}"
            required
            placeholder="user@mail.com"
        />
        <x-input-error :messages="$errors->get('email')" />
    </div>

    <div>
        <x-input-label for="role" value="Role" />
        <select
            id="role"
            name="role"
            required
            class="mt-1 block w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            @foreach (['admin', 'staff', 'customer'] as $role)
                <option value="{{ $role }}" {{ old('role', $user->role ?? 'customer') === $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('role')" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="password" :value="$user ? 'Password (kosongkan jika tidak diganti)' : 'Password'" />
        
        <x-text-input
            id="password"
            type="password"
            name="password"
            :required="!$user" 
            placeholder="{{ $user ? '------' : 'Minimal 6 karakter' }}"
        />
        
        <x-input-error :messages="$errors->get('password')" />
    </div>
</div>