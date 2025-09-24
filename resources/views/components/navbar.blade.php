<header class="header">
    <nav class="nav-container">
        <div class="logo">e-modul</div>
        <ul class="nav-links">
            <li><a href="{{route("welcome")}}">Beranda</a></li>
            <li><a href="{{route("about")}}">Tentang</a></li>
            <li><a href="{{route("listModule")}}">List Modul</a></li>
        </ul>
        <div class="auth-buttons">
            @if(Auth::check())
                <div class="auth-center" style="display: flex; align-items: center; justify-content: center;">
                    <span class="user-name logo" style="padding-right: 25px">{{ Auth::user()->name }}</span>
                    &nbsp;
                    <form action="{{ route('logout') }}" method="POST" style="display:inline; margin-top: 4px;">
                        @csrf
                        <button type="submit" class="login-btn" style="padding: 10px">Logout</button>
                    </form>
                </div>
            @else
                <a href="{{route('login')}}" class="login-btn">Login</a>
            @endif
        </div>
    </nav>
</header>
