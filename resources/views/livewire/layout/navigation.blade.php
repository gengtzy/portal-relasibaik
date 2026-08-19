<!-- Navigation Links -->
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-nav-link>
    
    {{-- Tambahan Menu Baru --}}
    <x-nav-link :href="route('admin.publications')" :active="request()->routeIs('admin.publications')">
        Publikasi
    </x-nav-link>
    <x-nav-link :href="route('admin.members')" :active="request()->routeIs('admin.members')">
        Member
    </x-nav-link>
</div>