@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Detail Produk</h2>
                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-900">
                        Kembali ke Daftar Produk
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover rounded-lg">
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-coffee text-gray-400 text-5xl"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $product->name }}</h3>
                        <p class="text-gray-500 mt-1">{{ $product->category->name }}</p>
                        
                        <div class="mt-4">
                            <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->is_available ? 'Tersedia' : 'Habis' }}
                            </span>
                        </div>
                        
                        <div class="mt-6">
                            <h4 class="text-sm font-medium text-gray-900">Deskripsi</h4>
                            <p class="mt-1 text-sm text-gray-600">{{ $product->description ?? '-' }}</p>
                        </div>
                        
                        <div class="mt-6 flex space-x-4">
                            <a href="{{ route('products.edit', $product->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-edit mr-2"></i> Edit
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    <i class="fas fa-trash mr-2"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection