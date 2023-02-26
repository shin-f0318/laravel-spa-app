<link rel="stylesheet" href={{ asset('css/header.css') }}>
<header>
    <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
        <div class="container">
            <a class="logo"><img src="{{ asset('img/spa_logo.png') }}" alt="ロゴ"></a>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', '湯屋なう') }}
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>
                

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class='nav-link' href="{{ url('serch') }}">湯屋なう登録</a>
                    </li>

                    <li class="nav-item">
                        <a class='nav-link' href="{{ url('map') }}">湯屋まっぷ</a>
                    </li>

                    <li class="nav-item">
                        <a class='nav-link' href="{{ url('create') }}">お問合せ</a>
                    </li>

                    <li class="nav-item">
                        <a class='nav-link' href="{{ url('index') }}">お問合せ一覧</a>
                    </li>
                    
                    {{-- 管理者のみ表示 --}}
                    <li class="nav-item dropdown">
                        @can('admin')
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre >管理者メニュー</a>

                            {{-- 管理者メニュー --}}
                            <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="navbarDropdown">
                                {{-- Userデータ --}}
                                <a class="dropdown-item" href="{{ route('user.index') }}">ユーザー</a>

                                {{-- Spaデータ --}}
                                <a class="dropdown-item" href="{{ route('spa.index') }}">湯屋</a>

                                {{-- Contactデータ --}}
                                <a class="dropdown-item" href="{{ route('contact.index') }}">お問合せ</a>

                                {{-- laravel-admin --}}
                                <a class="dropdown-item" href="{{ url('/admin/auth/login') }}">laravel-admin</a>
                            </div>
                        @endcan
                    </li>

                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>