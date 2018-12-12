{{--ログインid と移動先のユーザーidが違う場合--}}
{{-- @if (Auth::id() != $user->id)--}}
    {{-- ユーザーファイルのis_favorite()にmicropostidを代入 --}}
    
    @if (Auth::user()->is_favorite($micropost->id))
        {!! Form::open(['route' => ['micropost.unfavorite', $micropost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unfavorite', ['class' => "btn btn-success btn-xs"]) !!}
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => ['micropost.favorite', $micropost->id]]) !!}
        {!! Form::submit('Favorite', ['class' => "btn btn-default btn-xs"]) !!}
        {!! Form::close() !!}
    @endif
{{--@endif--}}
