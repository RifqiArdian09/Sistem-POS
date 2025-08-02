<!-- Desktop Sidebar -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-60 bg-white border-r">
        <!-- Logo -->
        <div class="p-6 border-b">
            <h1 class="text-xl font-semibold text-gray-800">EssyCoff</h1>
        </div>
        
        <!-- User Info -->
        <div class="p-4 border-b bg-gray-50">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-blue-600 text-sm"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Kasir</p>
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fas fa-home w-5"></i>
                <span class="ml-3">Dashboard</span>
            </a>
            <a href="{{ route('orders.index') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('orders.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fas fa-cash-register w-5"></i>
                <span class="ml-3">Transaksi</span>
            </a>
            <a href="{{ route('categories.index') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('categories.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fas fa-tags w-5"></i>
                <span class="ml-3">Kategori Produk</span>
            </a>
            <a href="{{ route('products.index') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('products.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fas fa-coffee w-5"></i>
                <span class="ml-3">Produk</span>
            </a>
            <a href="{{ route('orders.pending.index') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('orders.pending') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fas fa-clock w-5"></i>
                <span class="ml-3">Pesanan Pending</span>
            </a>
            
            <a href="{{ route('reports.index') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('reports.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                <i class="fas fa-file-alt w-5"></i>
                <span class="ml-3">Laporan</span>
            </a>
        </nav>
        
        <!-- Logout -->
        <div class="p-4 border-t">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-3 py-2 text-sm text-red-600 rounded hover:bg-red-50">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="ml-3">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Mobile Sidebar -->
<div class="md:hidden fixed inset-0 z-50" x-show="mobileMenuOpen" x-cloak>
    <div class="fixed inset-0 bg-black bg-opacity-50" @click="mobileMenuOpen = false"></div>
    <div class="relative flex flex-col w-64 h-full bg-white">
        <div class="p-6 border-b">
            <h1 class="text-xl font-semibold text-gray-800">EssyCoff</h1>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-600' }}">
                <i class="fas fa-home w-5"></i>
                <span class="ml-3">Dashboard</span>
            </a>
            <a href="{{ route('orders.index') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('orders.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600' }}">
                <i class="fas fa-cash-register w-5"></i>
                <span class="ml-3">Transaksi</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('categories.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600' }}">
                <i class="fas fa-tags w-5"></i>
                <span class="ml-3">Kategori Produk</span>
            </a>
            <a href="{{ route('products.index') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('products.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600' }}">
                <i class="fas fa-coffee w-5"></i>
                <span class="ml-3">Produk</span>
            </a>
            <a href="{{ route('orders.pending.index') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('orders.pending') ? 'bg-blue-50 text-blue-600' : 'text-gray-600' }}">
                <i class="fas fa-clock w-5"></i>
                <span class="ml-3">Pesanan Pending</span>
            </a>
            
            <a href="{{ route('reports.index') }}" class="flex items-center px-3 py-2 text-sm rounded {{ request()->routeIs('reports.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600' }}">
                <i class="fas fa-file-alt w-5"></i>
                <span class="ml-3">Laporan</span>
            </a>
        </nav>
        <div class="p-4 border-t">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full px-3 py-2 text-sm text-red-600 rounded">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="ml-3">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>
