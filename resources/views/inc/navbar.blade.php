<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Busterblocks') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @if(Illuminate\Support\Facades\Auth::guard('admin')->check())
                    <li class="nav-item">
                        <a href="/products" class="nav-link">Product Manager</a>
                    </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                {{-- Basket --}}
                <li class="nav-item">
                    
                    @if (session()->get('basket'))
                        {{-- Performs count on basket items --}}
                        @php $items = 0 @endphp
                        @foreach(session()->get('basket') as $item)
                            @php
                                if (!is_float($item) && !is_int($item)){
                                    $items += $item['quantity'];
                                }
                                
                            @endphp
                        @endforeach
                        <a class="nav-link" href="/basket">{{$items}} Items in Basket</a>
                    @else
                        <a class="nav-link" href="/basket">0 Items in Basket</a>
                    @endif
                </li>

                <!-- Authentication Links -->
                @guest
                {{-- If not logged in --}}
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
                    {{-- If logged in --}}
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        @auth('web')
                            {{ Auth::user()->name }}
                        @else
                            {{ Auth::guard('admin')->user()->name }}
                        @endauth
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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