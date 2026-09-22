<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-slate-800">Selamat Datang</h2>
        <p class="text-sm text-slate-500 mt-1">Silakan masuk ke akun Anda</p>
    </div>

    <form wire:submit="login" class="space-y-5">
        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input wire:model="form.email" id="email" type="email" required autofocus autocomplete="username"
                class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm px-4 py-2.5 shadow-sm transition-colors">
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input wire:model="form.password" id="password" type="password" required autocomplete="current-password"
                class="w-full rounded-lg border-slate-300 focus:border-blue-500 focus:ring-blue-500 text-sm px-4 py-2.5 shadow-sm transition-colors">
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember" class="inline-flex items-center cursor-pointer">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500 cursor-pointer">
                <span class="ms-2 text-sm text-slate-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-600 hover:text-blue-700 font-medium hover:underline transition-colors" href="{{ route('password.request') }}" wire:navigate>
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit"
                class="w-full bg-blue-600 text-white rounded-lg px-4 py-2.5 text-sm font-bold hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 transition-colors flex justify-center items-center shadow-md">
                
                {{-- Efek Loading (Spinner) saat tombol ditekan --}}
                <svg wire:loading wire:target="login" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                
                Masuk
            </button>
        </div>
    </form>
</div>