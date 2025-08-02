@extends('layouts.app')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Transaksi Baru</h2>
                
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form id="order-form" action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-2">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Daftar Produk</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($products as $product)
                                    <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                        <div class="p-4 cursor-pointer" onclick="addProduct({{ json_encode([
                                            'id' => $product->id,
                                            'name' => $product->name,
                                            'price' => $product->price,
                                            'image' => $product->image ? asset('storage/'.$product->image) : null
                                        ]) }})">
                                            @if($product->image)
                                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-32 object-cover rounded">
                                            @else
                                                <div class="w-full h-32 bg-gray-200 rounded flex items-center justify-center">
                                                    <i class="fas fa-coffee text-gray-400 text-3xl"></i>
                                                </div>
                                            @endif
                                            <div class="mt-2">
                                                <h4 class="font-medium text-gray-900">{{ $product->name }}</h4>
                                                <p class="text-sm text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Keranjang</h3>
                                
                                <div id="cart-items" class="space-y-3">
                                    <p id="empty-cart-message" class="text-gray-500 text-center py-4">Belum ada produk di keranjang</p>
                                </div>
                                
                                <div class="mt-4 border-t pt-4">
                                    <div class="flex justify-between">
                                        <span class="font-medium">Total:</span>
                                        <span id="total-amount" class="font-bold">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Transaksi</h3>
                                
                                <div class="mb-4">
                                    <label for="customer_name" class="block text-sm font-medium text-gray-700">Nama Pelanggan*</label>
                                    <input type="text" name="customer_name" id="customer_name" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                        value="{{ old('customer_name') }}">
                                    @error('customer_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700">Status Pesanan*</label>
                                    <select name="status" id="status" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                                    <textarea name="notes" id="notes" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('notes') }}</textarea>
                                </div>
                                
                                <input type="hidden" name="items" id="order-items" value="{{ old('items') }}">
                                
                                <button type="submit" id="submit-button" disabled
                                    class="w-full mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                    Proses Transaksi
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let cart = [];
    
    document.addEventListener('DOMContentLoaded', function() {
        const oldItems = document.getElementById('order-items').value;
        if (oldItems) {
            try {
                const items = JSON.parse(oldItems);
                if (Array.isArray(items)) {
                    cart = items.map(item => ({
                        product_id: item.product_id,
                        name: item.name || 'Unknown Product',
                        price: item.price || 0,
                        quantity: item.quantity,
                        subtotal: item.quantity * (item.price || 0)
                    }));
                    updateCart();
                }
            } catch (e) {
                console.error('Error parsing old items:', e);
            }
        }

        document.getElementById('cart-items').addEventListener('click', function(event) {
            const target = event.target;
            if (target.classList.contains('btn-increase')) {
                const index = parseInt(target.getAttribute('data-index'));
                updateQuantity(index, 1);
            } else if (target.classList.contains('btn-decrease')) {
                const index = parseInt(target.getAttribute('data-index'));
                updateQuantity(index, -1);
            }
        });
    });
    
    function addProduct(product) {
        const existingItem = cart.find(item => item.product_id == product.id);
        
        if (existingItem) {
            existingItem.quantity += 1;
            existingItem.subtotal = existingItem.quantity * product.price;
        } else {
            cart.push({
                product_id: product.id,
                name: product.name,
                price: product.price,
                quantity: 1,
                subtotal: product.price
            });
        }
        
        updateCart();
    }
    
    function updateQuantity(index, change) {
        const item = cart[index];
        if (!item) return;
        
        item.quantity += change;
        
        if (item.quantity < 1) {
            cart.splice(index, 1);
        } else {
            item.subtotal = item.quantity * item.price;
        }
        
        updateCart();
    }
    
    function updateCart() {
        const cartItems = document.getElementById('cart-items');
        const emptyCartMessage = document.getElementById('empty-cart-message');
        const totalAmount = document.getElementById('total-amount');
        const orderItems = document.getElementById('order-items');
        const submitButton = document.getElementById('submit-button');
        
        cartItems.innerHTML = '';
        
        if (cart.length === 0) {
            emptyCartMessage.style.display = 'block';
            totalAmount.textContent = 'Rp 0';
            submitButton.disabled = true;
        } else {
            emptyCartMessage.style.display = 'none';
            let total = 0;
            
            cart.forEach((item, index) => {
                total += item.subtotal;
                
                const itemElement = document.createElement('div');
                itemElement.className = 'flex justify-between items-center p-3 bg-white rounded border';
                itemElement.innerHTML = `
                    <div>
                        <h4 class="font-medium">${item.name}</h4>
                        <p class="text-sm text-gray-600">Rp ${item.price.toLocaleString('id-ID')} x ${item.quantity}</p>
                    </div>
                    <div class="flex items-center">
                        <span class="font-medium mr-4">Rp ${item.subtotal.toLocaleString('id-ID')}</span>
                        <div class="flex items-center border rounded">
                            <button type="button" class="btn-decrease px-2 py-1 text-gray-600 hover:bg-gray-100" data-index="${index}">
                                -
                            </button>
                            <span class="px-2">${item.quantity}</span>
                            <button type="button" class="btn-increase px-2 py-1 text-gray-600 hover:bg-gray-100" data-index="${index}">
                                +
                            </button>
                        </div>
                    </div>
                `;
                cartItems.appendChild(itemElement);
            });
            
            totalAmount.textContent = `Rp ${total.toLocaleString('id-ID')}`;
            orderItems.value = JSON.stringify(cart.map(item => ({
                product_id: item.product_id,
                quantity: item.quantity
            })));
            submitButton.disabled = false;
        }
    }
</script>
@endsection