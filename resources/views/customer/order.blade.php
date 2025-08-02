<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #eef2ff;
            --secondary-color: #3f37c9;
            --accent-color: #4cc9f0;
            --success-color: #4ade80;
            --danger-color: #f87171;
            --light-color: #f8f9fa;
            --dark-color: #1e293b;
            --gray-color: #64748b;
            --light-gray: #f1f5f9;
            --border-radius: 12px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        body {
            background-color: #ffffff;
            font-family: 'Poppins', sans-serif;
            color: var(--dark-color);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
        }
        
        .hero-section {
            background: linear-gradient(135deg, #4361ee 0%, #3f37c9 100%);
            color: white;
            border-radius: var(--border-radius);
            overflow: hidden;
            position: relative;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-pattern {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.3;
        }
        
        .product-card {
            transition: var(--transition);
            height: 100%;
            border-radius: var(--border-radius);
            overflow: hidden;
            border: none;
            box-shadow: var(--shadow-sm);
            background: white;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .product-img-container {
            position: relative;
            overflow: hidden;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }
        
        .product-img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
            width: 100%;
        }
        
        .product-card:hover .product-img {
            transform: scale(1.05);
        }
        
        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: var(--success-color);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 2;
        }
        
        .category-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background-color: rgba(0,0,0,0.7);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            z-index: 2;
        }
        
        .wishlist-btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: white;
            color: var(--danger-color);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            z-index: 2;
            border: none;
        }
        
        .wishlist-btn:hover {
            background-color: var(--danger-color);
            color: white;
            transform: scale(1.1);
        }
        
        .wishlist-btn.active {
            background-color: var(--danger-color);
            color: white;
        }
        
        .product-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 3rem;
        }
        
        .product-description {
            font-size: 0.875rem;
            color: var(--gray-color);
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 2.8rem;
        }
        
        .product-price {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        .add-to-cart-btn {
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .add-to-cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }
        
        .cart-container {
            position: sticky;
            top: 20px;
            border-radius: var(--border-radius);
            overflow: hidden;
            border: none;
            box-shadow: var(--shadow-md);
            background: white;
        }
        
        .cart-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1rem 1.5rem;
        }
        
        .cart-count-badge {
            background-color: white;
            color: var(--primary-color);
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.875rem;
        }
        
        .cart-item {
            padding: 1rem 0;
            border-bottom: 1px solid var(--light-gray);
            transition: background-color 0.2s;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .cart-item:hover {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        .cart-item-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .cart-item-name {
            font-weight: 500;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }
        
        .cart-item-price {
            font-size: 0.875rem;
            color: var(--gray-color);
        }
        
        .quantity-control {
            width: 120px;
        }
        
        .quantity-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px !important;
            background-color: var(--light-gray);
            border: none;
            transition: var(--transition);
        }
        
        .quantity-btn:hover {
            background-color: #e2e8f0;
        }
        
        .quantity-input {
            text-align: center;
            border-left: none;
            border-right: none;
            border-color: var(--light-gray);
            font-weight: 500;
        }
        
        .remove-item-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--light-gray);
            color: var(--danger-color);
            border: none;
            transition: var(--transition);
        }
        
        .remove-item-btn:hover {
            background-color: var(--danger-color);
            color: white;
        }
        
        .empty-cart {
            padding: 2rem 0;
            text-align: center;
        }
        
        .empty-cart-icon {
            font-size: 3rem;
            color: #e2e8f0;
            margin-bottom: 1rem;
        }
        
        .empty-cart-text {
            color: var(--gray-color);
            font-size: 1rem;
        }
        
        .checkout-btn {
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: var(--transition);
            width: 100%;
            background: linear-gradient(135deg, var(--success-color) 0%, #22c55e 100%);
            border: none;
        }
        
        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 222, 128, 0.3);
        }
        
        .checkout-btn:disabled {
            background: var(--light-gray);
            color: var(--gray-color);
        }
        
        .search-box {
            border-radius: 8px 0 0 8px;
            padding: 10px 16px;
            border: 1px solid #e2e8f0;
            transition: var(--transition);
        }
        
        .search-box:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .search-btn {
            border-radius: 0 8px 8px 0;
            padding: 10px 20px;
            background-color: var(--primary-color);
            border: none;
            transition: var(--transition);
        }
        
        .search-btn:hover {
            background-color: var(--secondary-color);
        }
        
        .filter-btn {
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: var(--transition);
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            border: 1px solid #e2e8f0;
            background-color: white;
            color: var(--gray-color);
        }
        
        .filter-btn:hover, .filter-btn.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
        }
        
        .total-price {
            font-weight: 700;
            font-size: 1.25rem;
            color: var(--primary-color);
        }
        
        .section-title {
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px;
        }
        
        .form-control {
            border-radius: 8px;
            padding: 10px 16px;
            border: 1px solid #e2e8f0;
            transition: var(--transition);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .no-results {
            padding: 3rem 0;
            text-align: center;
        }
        
        .no-results-icon {
            font-size: 3rem;
            color: #e2e8f0;
            margin-bottom: 1rem;
        }
        
        .no-results-text {
            color: var(--gray-color);
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .reset-filters-btn {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
            background-color: white;
            border: 1px solid #e2e8f0;
            transition: var(--transition);
        }
        
        .reset-filters-btn:hover {
            background-color: var(--light-gray);
            transform: translateY(-2px);
        }
        
        .floating-cart-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(67, 97, 238, 0.3);
            z-index: 1000;
            border: none;
            transition: var(--transition);
        }
        
        .floating-cart-btn:hover {
            transform: translateY(-5px) scale(1.05);
            background-color: var(--secondary-color);
        }
        
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger-color);
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        @media (max-width: 991.98px) {
            .cart-container {
                position: relative;
                top: 0;
                margin-top: 2rem;
            }
            
            .product-img {
                height: 160px;
            }
            
            .floating-cart-btn {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }
            
            .cart-badge {
                width: 20px;
                height: 20px;
                font-size: 0.65rem;
            }
        }
        
        @media (max-width: 767.98px) {
            .product-img {
                height: 140px;
            }
            
            .hero-section {
                padding: 1.5rem !important;
            }
            
            .hero-title {
                font-size: 1.5rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
        }
        
        /* Animation classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .shake {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }
        
        @keyframes shake {
            10%, 90% { transform: translateX(-1px); }
            20%, 80% { transform: translateX(2px); }
            30%, 50%, 70% { transform: translateX(-4px); }
            40%, 60% { transform: translateX(4px); }
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shopping-bag me-2"></i>ShopEase
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container my-4">
        <div class="hero-section p-4 p-lg-5 mb-4">
            <div class="hero-pattern"></div>
            <div class="hero-content row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title display-5 fw-bold mb-3">Discover Amazing Products</h1>
                    <p class="hero-subtitle mb-4">Shop the latest trends and enjoy exclusive deals</p>
                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control search-box" placeholder="Search products...">
                        <button class="btn search-btn" type="button" id="searchBtn">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="https://cdn.pixabay.com/photo/2017/08/06/22/01/online-shopping-2596612_1280.jpg" class="img-fluid rounded" alt="Shopping">
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container py-4">
        <div class="row">
            <!-- Product Listing -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="section-title">Our Products</h2>
                    <div class="d-flex">
                        <select class="form-select form-select-sm me-2" style="width: 120px;">
                            <option selected>Sort by</option>
                            <option value="price-asc">Price: Low to High</option>
                            <option value="price-desc">Price: High to Low</option>
                            <option value="name-asc">Name: A-Z</option>
                            <option value="name-desc">Name: Z-A</option>
                        </select>
                    </div>
                </div>

                <!-- Category Filters -->
                <div class="mb-4">
                    <div class="d-flex flex-wrap">
                        <button class="filter-btn active" data-category="all">
                            <i class="fas fa-layer-group me-1"></i> All
                        </button>
                        @foreach($categories as $category)
                            <button class="filter-btn" data-category="{{ $category->id }}">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="productGrid">
                    @foreach($products as $product)
                        <div class="col product-item fade-in" data-category="{{ $product->category_id }}" 
                             data-name="{{ strtolower($product->name) }}" 
                             data-price="{{ $product->price }}">
                            <div class="card product-card h-100">
                                <div class="product-img-container">
                                    <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/placeholder.png') }}" 
                                         class="product-img" 
                                         alt="{{ $product->name }}">
                                    @if($product->discount)
                                        <span class="product-badge">-{{ $product->discount }}%</span>
                                    @endif
                                    <span class="category-badge">{{ $product->category->name }}</span>
                                    <button class="wishlist-btn" data-product-id="{{ $product->id }}">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <h5 class="product-title">{{ $product->name }}</h5>
                                    <p class="product-description">{{ $product->description }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            @if($product->discount)
                                                <span class="text-muted text-decoration-line-through me-2">@currency($product->price)</span>
                                                <span class="product-price">@currency($product->price * (1 - $product->discount/100))</span>
                                            @else
                                                <span class="product-price">@currency($product->price)</span>
                                            @endif
                                        </div>
                                        <button class="btn btn-primary btn-sm add-to-cart add-to-cart-btn" 
                                                data-product-id="{{ $product->id }}"
                                                data-product-name="{{ $product->name }}"
                                                data-product-price="{{ $product->discount ? $product->price * (1 - $product->discount/100) : $product->price }}"
                                                data-product-image="{{ $product->image ? asset('storage/'.$product->image) : asset('images/placeholder.png') }}">
                                            <i class="fas fa-cart-plus me-1"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- No Results Message -->
                <div class="no-results d-none" id="noResults">
                    <i class="fas fa-search no-results-icon"></i>
                    <h4 class="no-results-text">No products found</h4>
                    <p class="text-muted mb-4">Try adjusting your search or filter criteria</p>
                    <button class="btn reset-filters-btn" id="resetFilters">
                        <i class="fas fa-sync-alt me-1"></i> Reset Filters
                    </button>
                </div>
                
                <!-- Pagination -->
                <nav class="mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Shopping Cart -->
            <div class="col-lg-4">
                <div class="cart-container">
                    <div class="cart-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0"><i class="fas fa-shopping-cart me-2"></i> Your Cart</h4>
                            <span class="cart-count-badge" id="cartCount">0</span>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <form id="orderForm" action="{{ route('customer.order') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">Your Name *</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Special Instructions</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Any special requests..."></textarea>
                            </div>
                            <hr>
                            <div id="cartItems" style="max-height: 300px; overflow-y: auto;">
                                <div class="empty-cart">
                                    <i class="fas fa-shopping-basket empty-cart-icon"></i>
                                    <p class="empty-cart-text">Your cart is empty</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                                <h5 class="mb-0">Total:</h5>
                                <h5 class="mb-0 total-price" id="cartTotal">@currency(0)</h5>
                                <input type="hidden" name="total_amount" id="totalAmount" value="0">
                            </div>
                            <button type="submit" class="btn checkout-btn" id="checkoutBtn" disabled>
                                <i class="fas fa-check-circle me-2"></i> Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Cart Button (Mobile) -->
    <button class="floating-cart-btn d-lg-none" id="mobileCartBtn">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-badge" id="mobileCartCount">0</span>
    </button>

    <!-- Footer -->
    <footer class="bg-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3">ShopEase</h5>
                    <p class="text-muted">Your one-stop shop for all your needs. Quality products at affordable prices.</p>
                    <div class="social-icons">
                        <a href="#" class="text-decoration-none me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-decoration-none me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-decoration-none me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h6 class="fw-bold mb-3">Shop</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">All Products</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Featured</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">New Arrivals</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Sale</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h6 class="fw-bold mb-3">About</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">About Us</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Blog</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Careers</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted">Press</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="fw-bold mb-3">Newsletter</h6>
                    <p class="text-muted mb-3">Subscribe to get updates on new products and special offers.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Your email">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="text-muted mb-0">&copy; 2023 ShopEase. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-decoration-none text-muted me-3">Privacy Policy</a>
                    <a href="#" class="text-decoration-none text-muted me-3">Terms of Service</a>
                    <a href="#" class="text-decoration-none text-muted">Contact Us</a>
                </div>
            </div>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cart = [];
    let cartTotal = 0;
    const wishlist = [];

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Add to cart functionality
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const productName = this.dataset.productName;
            const productPrice = parseFloat(this.dataset.productPrice);
            const productImage = this.dataset.productImage;

            const existingItem = cart.find(item => item.id === productId);
            if (existingItem) {
                existingItem.quantity += 1;
                existingItem.subtotal = existingItem.quantity * productPrice;
            } else {
                cart.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage,
                    quantity: 1,
                    subtotal: productPrice
                });
            }
            
            // Add animation effect
            const buttonRect = this.getBoundingClientRect();
            const cartIcon = document.createElement('div');
            cartIcon.innerHTML = '<i class="fas fa-cart-plus text-primary"></i>';
            cartIcon.style.position = 'fixed';
            cartIcon.style.left = `${buttonRect.left + buttonRect.width/2}px`;
            cartIcon.style.top = `${buttonRect.top}px`;
            cartIcon.style.zIndex = '1000';
            cartIcon.style.fontSize = '20px';
            cartIcon.style.transition = 'all 0.5s ease-out';
            document.body.appendChild(cartIcon);
            
            setTimeout(() => {
                const cartRect = document.getElementById('cartContainer').getBoundingClientRect();
                cartIcon.style.left = `${cartRect.right - 30}px`;
                cartIcon.style.top = `${cartRect.top + 20}px`;
                cartIcon.style.opacity = '0.5';
                cartIcon.style.transform = 'scale(1.5)';
            }, 10);
            
            setTimeout(() => {
                document.body.removeChild(cartIcon);
                updateCart();
                
                // Add shake effect to cart button
                document.getElementById('cartContainer').classList.add('shake');
                setTimeout(() => {
                    document.getElementById('cartContainer').classList.remove('shake');
                }, 500);
            }, 500);
        });
    });

    // Wishlist functionality
    document.querySelectorAll('.wishlist-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const icon = this.querySelector('i');
            
            if (this.classList.contains('active')) {
                // Remove from wishlist
                const index = wishlist.indexOf(productId);
                if (index > -1) {
                    wishlist.splice(index, 1);
                }
                this.classList.remove('active');
                icon.classList.replace('fas', 'far');
            } else {
                // Add to wishlist
                wishlist.push(productId);
                this.classList.add('active');
                icon.classList.replace('far', 'fas');
                
                // Add animation
                this.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 300);
            }
        });
    });

    // Currency formatting
    function formatCurrency(amount) {
        return 'Rp ' + amount.toLocaleString('id-ID');
    }

    // Update cart display
    function updateCart() {
        const cartItemsContainer = document.getElementById('cartItems');
        const cartTotalElement = document.getElementById('cartTotal');
        const totalAmountInput = document.getElementById('totalAmount');
        const checkoutBtn = document.getElementById('checkoutBtn');
        const cartCountElement = document.getElementById('cartCount');
        const mobileCartCount = document.getElementById('mobileCartCount');

        cartTotal = cart.reduce((total, item) => total + item.subtotal, 0);

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="empty-cart">
                    <i class="fas fa-shopping-basket empty-cart-icon"></i>
                    <p class="empty-cart-text">Your cart is empty</p>
                </div>`;
            checkoutBtn.disabled = true;
            cartCountElement.textContent = '0';
            mobileCartCount.textContent = '0';
        } else {
            cartItemsContainer.innerHTML = '';
            cart.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.className = 'cart-item fade-in';
                itemElement.innerHTML = `
                    <div class="d-flex align-items-center mb-2">
                        <img src="${item.image}" class="cart-item-img me-3" alt="${item.name}">
                        <div class="flex-grow-1">
                            <div class="cart-item-name">${item.name}</div>
                            <div class="cart-item-price">${formatCurrency(item.price)}</div>
                        </div>
                        <span class="fw-bold">${formatCurrency(item.subtotal)}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="input-group quantity-control">
                            <button class="btn decrease-qty quantity-btn" data-product-id="${item.id}">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="form-control form-control-sm text-center quantity-input" value="${item.quantity}" min="1" data-product-id="${item.id}">
                            <button class="btn increase-qty quantity-btn" data-product-id="${item.id}">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <button class="btn remove-item remove-item-btn" data-product-id="${item.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>`;
                cartItemsContainer.appendChild(itemElement);
            });
            checkoutBtn.disabled = false;
            const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
            cartCountElement.textContent = totalItems;
            mobileCartCount.textContent = totalItems;
        }

        cartTotalElement.textContent = formatCurrency(cartTotal);
        totalAmountInput.value = cartTotal;
        addCartItemEventListeners();
        updateOrderItems();
    }

    // Add event listeners to cart items
    function addCartItemEventListeners() {
        document.querySelectorAll('.decrease-qty').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const item = cart.find(item => item.id === productId);
                if (item.quantity > 1) {
                    item.quantity -= 1;
                    item.subtotal = item.quantity * item.price;
                    updateCart();
                }
            });
        });

        document.querySelectorAll('.increase-qty').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const item = cart.find(item => item.id === productId);
                item.quantity += 1;
                item.subtotal = item.quantity * item.price;
                updateCart();
            });
        });

        document.querySelectorAll('.quantity-control input').forEach(input => {
            input.addEventListener('change', function() {
                const productId = this.dataset.productId;
                const newQuantity = parseInt(this.value);
                if (newQuantity > 0) {
                    const item = cart.find(item => item.id === productId);
                    item.quantity = newQuantity;
                    item.subtotal = item.quantity * item.price;
                    updateCart();
                } else {
                    this.value = 1;
                }
            });
        });

        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.productId;
                const index = cart.findIndex(item => item.id === productId);
                if (index !== -1) {
                    // Add removal animation
                    const itemElement = this.closest('.cart-item');
                    itemElement.style.transform = 'translateX(-100%)';
                    itemElement.style.opacity = '0';
                    itemElement.style.transition = 'all 0.3s ease';
                    
                    setTimeout(() => {
                        cart.splice(index, 1);
                        updateCart();
                    }, 300);
                }
            });
        });
    }

    // Update hidden form inputs with order items
    function updateOrderItems() {
        document.querySelectorAll('input[name^="items"]').forEach(input => input.remove());
        const form = document.getElementById('orderForm');
        cart.forEach((item, index) => {
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = `items[${index}][product_id]`;
            idInput.value = item.id;
            form.appendChild(idInput);

            const qtyInput = document.createElement('input');
            qtyInput.type = 'hidden';
            qtyInput.name = `items[${index}][quantity]`;
            qtyInput.value = item.quantity;
            form.appendChild(qtyInput);
        });
    }

    // Enhanced filtering functionality
    function performSearch() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const activeCategory = document.querySelector('.filter-btn.active').dataset.category;
        const priceRange = getPriceRange(); // Get selected price range
        
        let visibleCount = 0;
        
        document.querySelectorAll('.product-item').forEach(item => {
            const name = item.dataset.name;
            const cat = item.dataset.category;
            const price = parseFloat(item.dataset.price);
            
            const matchSearch = name.includes(searchTerm);
            const matchCat = activeCategory === 'all' || cat === activeCategory;
            const matchPrice = priceRange.min === null || 
                             (price >= priceRange.min && price <= priceRange.max);
            
            if (matchSearch && matchCat && matchPrice) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        const noResults = document.getElementById('noResults');
        if (visibleCount === 0) {
            noResults.classList.remove('d-none');
        } else {
            noResults.classList.add('d-none');
        }
    }
    
    // Get selected price range (you could implement price range filters)
    function getPriceRange() {
        // This is a placeholder - you could implement actual price range filters
        return { min: null, max: null };
    }

    // Search event listeners
    document.getElementById('searchBtn').addEventListener('click', performSearch);
    document.getElementById('searchInput').addEventListener('input', performSearch);
    document.getElementById('searchInput').addEventListener('keyup', function(e) {
        if (e.key === 'Enter') performSearch();
    });

    // Category filter buttons
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            performSearch();
        });
    });
    
    // Reset filters button
    document.getElementById('resetFilters').addEventListener('click', function() {
        document.getElementById('searchInput').value = '';
        document.querySelector('.filter-btn[data-category="all"]').click();
        performSearch();
    });

    // Form validation
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        const name = document.getElementById('customer_name').value.trim();
        if (!name) {
            e.preventDefault();
            alert('Please enter your name');
            document.getElementById('customer_name').focus();
        }
    });
    
    // Mobile cart button
    document.getElementById('mobileCartBtn').addEventListener('click', function() {
        document.getElementById('cartContainer').scrollIntoView({ behavior: 'smooth' });
    });
    
    // Initialize with search
    performSearch();
});
</script>
</body>
</html>