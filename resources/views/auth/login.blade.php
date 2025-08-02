<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cashier Login - EssyCoff</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      overflow: hidden;
    }

    .coffee-pattern {
      background-image:
        radial-gradient(circle at 25% 25%, rgba(139, 69, 19, 0.1) 2px, transparent 2px),
        radial-gradient(circle at 75% 75%, rgba(160, 82, 45, 0.1) 2px, transparent 2px);
      background-size: 50px 50px;
    }

    .glass-effect {
      backdrop-filter: blur(20px);
      background: rgba(255, 255, 255, 0.95);
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .floating {
      animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
      0%, 100% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-5px);
      }
    }

    .gradient-text {
      background: linear-gradient(135deg, #8B4513, #A0522D, #D2691E);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .coffee-steam {
      position: absolute;
      width: 3px;
      height: 20px;
      background: linear-gradient(to top, transparent, rgba(255, 255, 255, 0.6), transparent);
      border-radius: 50%;
      animation: steam 2s infinite;
    }

    @keyframes steam {
      0%, 100% {
        opacity: 0;
        transform: translateY(0) rotate(0deg);
      }
      50% {
        opacity: 1;
        transform: translateY(-15px) rotate(3deg);
      }
    }

    .input-focus {
      transition: all 0.3s ease;
    }

    .input-focus:focus {
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(139, 69, 19, 0.1);
    }

    .btn-hover {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn-hover:hover {
      transform: translateY(-1px);
      box-shadow: 0 10px 20px rgba(139, 69, 19, 0.3);
    }

    .btn-hover::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .btn-hover:hover::before {
      left: 100%;
    }

    ::-webkit-scrollbar {
      display: none;
    }

    .coffee-bean {
      position: absolute;
      opacity: 0.1;
      animation: float-bean 12s linear infinite;
    }

    @keyframes float-bean {
      0% {
        transform: translateY(0) rotate(0deg);
      }
      100% {
        transform: translateY(-100vh) rotate(360deg);
      }
    }

    .form-transition {
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .form-transition:hover {
      transform: translateY(-2px);
    }
  </style>
</head>

<body class="bg-gradient-to-br from-amber-50 via-orange-50 to-yellow-100 min-h-screen coffee-pattern">

  <div class="min-h-screen flex overflow-hidden relative">

    <!-- Floating Coffee Beans -->
    <div class="coffee-bean" style="top: 15%; left: 10%; animation-delay: 0s; animation-duration: 15s;">
      <i class="fas fa-coffee text-amber-600 text-lg"></i>
    </div>
    <div class="coffee-bean" style="top: 30%; left: 80%; animation-delay: 2s; animation-duration: 18s;">
      <i class="fas fa-coffee text-amber-700 text-base"></i>
    </div>
    <div class="coffee-bean" style="top: 70%; left: 20%; animation-delay: 4s; animation-duration: 20s;">
      <i class="fas fa-coffee text-amber-800 text-lg"></i>
    </div>
    <div class="coffee-bean" style="top: 80%; left: 75%; animation-delay: 1s; animation-duration: 17s;">
      <i class="fas fa-coffee text-amber-500 text-base"></i>
    </div>

    <!-- Left: Image -->
    <div class="hidden lg:block lg:w-3/5 relative overflow-hidden">
      <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 hover:scale-105"
        src="https://images.unsplash.com/photo-1509042239860-f550ce710b93" alt="Coffee Shop" />
      <div class="absolute inset-0 bg-gradient-to-tr from-black via-transparent to-amber-900 opacity-60"></div>

      <!-- Steam -->
      <div class="absolute top-1/3 left-1/4">
        <div class="coffee-steam" style="animation-delay: 0s;"></div>
        <div class="coffee-steam" style="left: 6px; animation-delay: 0.5s;"></div>
        <div class="coffee-steam" style="left: 12px; animation-delay: 1s;"></div>
      </div>

      <div class="absolute inset-0 flex flex-col items-center justify-center text-center px-8">
        <div class="floating">
          <i class="fas fa-coffee text-white text-5xl mb-4 opacity-90"></i>
        </div>
        <h1 class="text-white text-4xl font-bold drop-shadow-2xl mb-3 leading-tight">
          Welcome to<br>
          <span class="text-amber-300">EssyCoff</span>
        </h1>
        <p class="text-white text-lg opacity-90 max-w-sm leading-relaxed">
          Point of Sale System
        </p>
        <div class="mt-6 flex space-x-3">
          <div class="w-2 h-2 bg-white rounded-full opacity-60"></div>
          <div class="w-2 h-2 bg-amber-300 rounded-full"></div>
          <div class="w-2 h-2 bg-white rounded-full opacity-60"></div>
        </div>
      </div>
    </div>

    <!-- Right: Login Form -->
    <div class="w-full lg:w-2/5 flex items-center justify-center py-8 px-4 sm:px-6 lg:px-8 relative">
      <div class="glass-effect rounded-2xl p-6 w-full max-w-sm form-transition">
        <div class="text-center mb-6">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 mb-3 shadow-lg floating">
            <i class="fas fa-cash-register text-white text-xl"></i>
          </div>
          <h2 class="text-2xl font-bold gradient-text mb-1">Cashier Login</h2>
          <p class="text-gray-600 text-xs">Access POS System</p>
        </div>

        <form class="space-y-4" method="POST" action="{{ route('login') }}">
          @csrf

          <div class="relative">
            <label for="username" class="block text-xs font-semibold text-gray-700 mb-1">
              <i class="fas fa-user mr-1 text-amber-600"></i>Username
            </label>
            <input id="username" name="username" type="text" required autofocus
              class="input-focus rounded-lg w-full px-3 py-2.5 border-2 border-gray-200 placeholder-gray-400 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white/80 backdrop-blur-sm"
              placeholder="Enter username" />
          </div>

          <div class="relative">
            <label for="password" class="block text-xs font-semibold text-gray-700 mb-1">
              <i class="fas fa-lock mr-1 text-amber-600"></i>Password
            </label>
            <input id="password" name="password" type="password" required
              class="input-focus rounded-lg w-full px-3 py-2.5 border-2 border-gray-200 placeholder-gray-400 text-gray-900 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white/80 backdrop-blur-sm"
              placeholder="Enter password" />
          </div>

          <div class="flex items-center">
            <label class="flex items-center">
              <input type="checkbox" class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
              <span class="ml-2 text-xs text-gray-600">Remember me</span>
            </label>
          </div>

          <button type="submit"
            class="btn-hover w-full flex justify-center items-center py-2.5 px-4 text-sm font-semibold rounded-lg text-white bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 shadow-lg">
            <i class="fas fa-sign-in-alt mr-2"></i>
            Login to POS
          </button>

          <div class="text-center pt-2">
            <a href="#" class="text-xs text-amber-600 hover:text-amber-700 font-medium transition-colors">
              Need help? Contact Admin
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Mobile Logo -->
  <div class="lg:hidden absolute top-6 left-1/2 transform -translate-x-1/2">
    <div class="flex items-center space-x-2">
      <i class="fas fa-cash-register text-amber-600 text-xl"></i>
      <span class="text-xl font-bold gradient-text">EssyCoff POS</span>
    </div>
  </div>

  <!-- Dynamic Coffee Beans -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const container = document.body;
      for (let i = 0; i < 6; i++) {
        const bean = document.createElement('div');
        bean.className = 'coffee-bean';
        const size = ['sm', 'base'][Math.floor(Math.random() * 2)];
        const color = 500 + Math.floor(Math.random() * 5) * 100;
        bean.innerHTML = `<i class="fas fa-coffee text-amber-${color} text-${size}"></i>`;
        bean.style.left = `${Math.random() * 90}%`;
        bean.style.top = `${Math.random() * 90}%`;
        bean.style.animationDelay = `${Math.random() * 5}s`;
        bean.style.animationDuration = `${12 + Math.random() * 10}s`;
        container.appendChild(bean);
      }
    });
  </script>
</body>

</html>
