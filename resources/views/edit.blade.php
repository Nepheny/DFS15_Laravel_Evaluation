@extends('layouts.site')

@section('content')

    <div class="col-lg-8 col-md-8">

        <!-- POST -->
        <div class="post beforepagination">                             
            <div class="postinfobot">
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- POST -->

        <div class="post">
            @if($errors->any())
                <h2 class="mb-4">Erreur</h2>
                @foreach ($errors->all() as $error)
                    <span class="subheading">{{ $error }}</span>
                @endforeach
            @endif
        </div>

        <!-- POST -->
        <div class="post">
            <form action="{{ route('topics.update', ['topic' => $topic]) }}" class="form" method="POST">
                @csrf
                @method("PUT")
                <div class="topwrap">
                    <div class="userinfo pull-left">

                    </div>
                    <div class="posttext pull-left">
                        <div class="">
                            <input name="name" id="reply" placeholder="Votre titre" value="{{ $topic->name }}"></textarea>
                        </div>
                        <div class="clearfix"></div>
                        <div class="textwraper">
                            <textarea name="message" id="reply" placeholder="Votre message" >{{ $topic->message }}</textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>                              
                <div class="postinfobot">
                    <div class="pull-right postreply">
                        <div class="pull-left"><button type="submit" class="btn btn-primary">Mettre a jour</button></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <!-- POST -->

    </div>
               
@endsection