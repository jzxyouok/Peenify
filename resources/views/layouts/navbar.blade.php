<style>
    .navbar-default {
        background-color: #FFFFFF;
    }
</style>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/home') }}">
                Peenify
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">&nbsp;
                <li><a href="{{ route('categories.index') }}">分類</a></li>
                <li><a href="{{ route('products.index') }}">探索產品</a></li>
                <li><a href="{{ route('collections.index') }}">探索收藏集</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">登入</a></li>
                    <li><a href="{{ url('auth/facebook') }}">Facebook 登入</a></li>
                    <li><a href="{{ url('/register') }}">註冊</a></li>
                @else
                    <li><a href="{{ route('users.collections', auth()->user()->id) }}">建立收藏集</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <img style="width: 20px;height: 20px; border-radius: 20px 20px"
                                 src="{{ (auth()->user()->avatar) ? image_path('avatars.users', auth()->user()->avatar):'holder.js/20x20' }}">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('users.bookmarks', auth()->user()->id) }}">書籤</a></li>
                            <li><a href="{{ route('users.emojis', auth()->user()->id) }}">評分紀錄</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('users.favorites.products', auth()->user()->id) }}">你最愛的產品</a>
                            </li>
                            <li>
                                <a href="{{ route('users.favorites.collections', auth()->user()->id) }}">你最愛的收藏集</a>
                            </li>
                            <li>
                                <a href="{{ route('subscribes.subscribers', ['type' => 'user', 'id' => auth()->user()->id]) }}">跟隨者</a>
                            </li>
                            <li>
                                <a href="{{ route('subscribes.subscribed', ['type' => 'user', 'id' => auth()->user()->id]) }}">正在訂閱</a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('users.show', auth()->user()->id) }}">個人頁面</a>
                            </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        登出
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>