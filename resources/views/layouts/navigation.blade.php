<nav class="border-b border-slate-200 bg-white shadow-sm">
    <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-4 px-4 py-3 sm:flex-nowrap sm:px-6 lg:px-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="flex h-9 w-9 items-center justify-center rounded-md text-[#14532d]" aria-label="Dashboard">
                @if (file_exists(public_path('build/images/logo-lyra.png')))
                    <img src="{{ asset('build/images/logo-lyra.png') }}" alt="Logo LYRA" class="h-9 w-9 object-contain" />
                @elseif (file_exists(public_path('build/images/logo-lyra.svg')))
                    <img src="{{ asset('build/images/logo-lyra.svg') }}" alt="Logo LYRA" class="h-9 w-9 object-contain" />
                @else
                    <x-application-logo class="h-9 w-9" />
                @endif
            </a>

            <div class="hidden items-center gap-6 text-sm font-medium sm:flex">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-nav-link>
                @can('ver-productos')
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                        Productos
                    </x-nav-link>
                @endcan
                @can('ver-categorias')
                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                        Categorías
                    </x-nav-link>
                @endcan
                @can('ver-clientes')
                    <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                        Clientes
                    </x-nav-link>
                @endcan
                @can('ver-ventas')
                    <x-nav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')">
                        Ventas
                    </x-nav-link>
                    @can('ver-proveedores')
 <x-nav-link :href="route('providers.index')" :active="request()->routeIs('providers.*')">
 Proveedores
 </x-nav-link>
@endcan
@can('ver-compras')
 <x-nav-link :href="route('purchases.index')" :active="request()->routeIs('purchases.*')">
 Compras
 </x-nav-link>
@endcan
                @endcan
                @can('ver-inventario')
                    <x-nav-link :href="route('inventory.kardex')" :active="request()->routeIs('inventory.*')">
                        Kardex
                    </x-nav-link>
                @endcan
                @can('ver-auditoria')
                    <x-nav-link :href="route('audit.index')" :active="request()->routeIs('audit.*')">
                        Auditoría
                    </x-nav-link>
                @endcan
                @can('ver-ventas')
@canany(['ver-usuarios', 'ver-roles', 'ver-permisos'])
 <x-nav-link :href="route('settings.index')" :active="request()->routeIs('settings.*')">
 Configuración
 </x-nav-link>
@endcanany

                @endcan
            </div>
        </div>

        @auth
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-[#dcfce7] text-[11px] font-bold text-[#14532d]">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>

                <div class="hidden min-w-0 text-right sm:block">
                    <div class="truncate text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</div>
                    <div class="text-[10px] uppercase tracking-[0.18em] text-slate-500">Usuario</div>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="ml-1">
                    @csrf
                    <button type="submit" class="inline-flex items-center rounded-md border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-700 transition hover:border-[#14532d] hover:text-[#14532d]">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        @endauth

        <div class="w-full border-t border-slate-100 pt-2 sm:hidden">
            @can('ver-categorias')
                <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.*')">
                    Categorías
                </x-responsive-nav-link>
            @endcan
            @can('ver-clientes')
                <x-responsive-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">
                    Clientes
                </x-responsive-nav-link>
            @endcan
            @can('ver-ventas')
                <x-responsive-nav-link :href="route('sales.index')" :active="request()->routeIs('sales.*')">
                    Ventas
                </x-responsive-nav-link>
            @endcan
            @can('ver-proveedores')
                <x-responsive-nav-link :href="route('providers.index')" :active="request()->routeIs('providers.*')">
                    Proveedores
                </x-responsive-nav-link>
            @endcan
            @can('ver-compras')
                <x-responsive-nav-link :href="route('purchases.index')" :active="request()->routeIs('purchases.*')">
                    Compras
                </x-responsive-nav-link>
            @endcan
            @can('ver-inventario')
                <x-responsive-nav-link :href="route('inventory.kardex')" :active="request()->routeIs('inventory.*')">
                    Kardex
                </x-responsive-nav-link>
            @endcan
            @can('ver-auditoria')
                <x-responsive-nav-link :href="route('audit.index')" :active="request()->routeIs('audit.*')">
                    Auditoría
                </x-responsive-nav-link>
            @endcan
            @canany(['ver-usuarios', 'ver-roles', 'ver-permisos'])
                <x-responsive-nav-link :href="route('settings.index')" :active="request()->routeIs('settings.*')">
                    Configuración
                </x-responsive-nav-link>
            @endcanany
        </div>
    </div>
</nav>