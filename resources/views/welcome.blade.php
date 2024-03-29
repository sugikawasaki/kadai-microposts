@extends('layouts.app') {{-- layoutsフォルダのappファイルを親レイアウトとして継承する --}}

@section('content') {{-- appファイルのyield部分にセクションをはめ込む。  --}}
    @if (Auth::check())
        <div class="row">
            <aside class="col-xs-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $user->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                    </div>
                </div>
            </aside>
            <div class="col-xs-8">
                @if (count($microposts) > 0)
                    @include('microposts.microposts', ['microposts' => $microposts])
                @endif
            </div>
        </div>
    @else
        <div class="center jumbotron">>
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                {!! link_to_route('signup.get','Sign up now!' , null, ['class' => 'btn btn-lg btn-primary']) !!} 
                {{--link_to_route 引数　ルーティング名、リンクにしたい文字列、URLのパラメータに代入したい値、HTMLタグの属性を配列形式で指定 --}} 
            </div>
        </div
    @endif
@endsection