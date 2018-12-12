<header> {{-- app.bladeファイルでincludeで呼び出される　--}}
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                {{-- buttonは汎用的に使える押しボタン。inputと比べてボタン上のテキスト・画像を表示できる --}}
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span> {{-- spanは囲んだ範囲をひと固まりとしてスタイルシートを適用する。divはブロック要素で、spanはインライン要素。インラインは文章の一部として利用され開業されない --}}
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Microposts</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check()) {{-- ログインしているかどうか調べる。してる、してない、のみ判断　--}}　
                        <li>{!! link_to_route('users.index', 'Users') !!}</li> {{-- ルーティング名users.indexを指定、表示をUsersに指定 --}}
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="botton" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>   
                            <ul class="dropdown-menu">
                                <li>{!! link_to_route('users.show', 'My profile', ['id' => Auth::id()]) !!}</li>
                                {{-- ルーティング名users.show,表示My profile,URLに代入したいパラメーター値ログインユーザーのIDを取得し表示 ※Auth::id()==Auth::user()->id  --}}
                                <li>{!! link_to_route('users.favoritings', 'Favorites', ['id' => Auth::id()]) !!}</li>
                                <li role="separator" class="divider"></li>
                                <li>{!! link_to_route('logout.get','Logout') !!}</li>  {{-- ルーティング名logout.get、表示名Logout　--}}                        
                            </ul>
                        </li>
                    @else {{-- ログインしていない場合 --}}
                        {{--link_to_route 引数　ルーティング名、リンクにしたい文字列、(URLのパラメータに代入したい値、HTMLタグの属性を配列形式で指定) --}} 
                        <li>{!! link_to_route('signup.get', 'Signup') !!}</li>
                        <li>{!! link_to_route('login','Login') !!}</li>
                    @endif    
                </ul>
            </div>
        </div>
    </nav>
</header>