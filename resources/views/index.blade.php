@extends('layouts.site')

@section('content')

@if (session('status'))
<div class="post">
    <h2 class="mb-4">{{ session('status') }}</h2>
</div>
@endif

<div class="col-lg-8 col-md-8">       
    @foreach ($topics as $topic)
        <!-- POST -->
        <div class="post">
            <div class="wrap-ut pull-left">
                <div class="userinfo pull-left">
                    <div class="avatar">
                        <img src="{{ asset('/images/avatar.jpg')}}" alt="">
                        <div class="status green">&nbsp;</div>
                    </div>
                </div>
                <div class="posttext pull-left">
                <h2><a href="{{ route('topics.show', ['topic' => $topic]) }}">{{ $topic->name }}</a></h2>
                    <p>{{ $topic->message }}</p>
                </div>

                @if(Auth::id() == $topic->user_id)
                <div class="clearfix">
                    <form action="{{ route('topics.edit', ['topic' => $topic]) }}" method="GET" class="form">
                        @csrf
                        <div class="pull-right"><button class="btn btn-default" type="submit">Modifier</button></div>
                    </form>
                    <form action="{{ route('topics.destroy', ['topic' => $topic]) }}" method="POST" class="form">
                        @csrf
                        @method("DELETE")
                        <div class="pull-right"><button class="btn btn-default" type="submit">Supprimer</button></div>
                    </form>
                </div>
                @endif

            </div>
            <div class="postinfo pull-left">
                <div class="comments">
                    <div class="commentbg">
                        {{ count($topic->comments) }}
                        <div class="mark"></div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- POST -->
        @endforeach
    </div>

@endsection