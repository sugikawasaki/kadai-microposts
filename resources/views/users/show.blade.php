@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $user->name }}</h3> {{--ユーザー名をパネルに表示する,ログインユーザーか、登録ユーザーかどちらか　--}}
                </div>
                <div class="panel-body">
                    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
            @include('user_follow.follow_button', ['user' => $user]) {{-- 第一引数：テンプレート指定、第二引数：たぶんここでの$userを、follow_buttonで$userで使える --}}
        </aside>
        <div class="col-xs-8">
            <ul class="nav nav-tabs nav-justified mb-3">  {{--タブ　--}}
                <li role="presentation" class="{{ Request::is('users/' . $user->id) ? 'active' : '' }}"><a href="{{ route('users.show', ['id' => $user->id]) }}">TimeLine <span class="badge">{{ $count_microposts }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followings') ? 'active' : '' }}"><a href="{{ route('users.followings', ['id' => $user->id]) }}">Followings <span class="badge">{{ $count_followings }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/followers') ? 'active' : '' }}"><a href="{{ route('users.followers', ['id' => $user->id]) }}">Followers <span class="badge">{{ $count_followers }}</span></a></li>
                <li role="presentation" class="{{ Request::is('users/*/favoritings') ? 'active' : '' }}"><a href="{{ route('users.favoritings', ['id' => $user->id]) }}">Favoritings <span class="badge">{{ $count_favoritings }}</span></a></li>
            </ul>
            {{-- ログインしているユーザーと、$user（MicropostsControllerのindexからきている）のidを比較して同じだったら以下に進む --}}
            @if (Auth::id() == $user->id)
                  {!! Form::open(['route' => 'microposts.store']) !!} {{-- フォームが始まる。入力内容はmicroposts.storeに保存される--}}
                      <div class="form-group">
                          {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '2']) !!}
                          {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!} {{--postと表示--}}
                      </div>
                  {!! Form::close() !!}
            @endif
            @if (count($microposts) > 0)
                @include('microposts.microposts', ['microposts' => $microposts])
            @endif
        </div>
    </div>
@endsection