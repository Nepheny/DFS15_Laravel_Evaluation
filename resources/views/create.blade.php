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
        <form action="{{ route('topics.store') }}" class="form" method="POST">
            @csrf
            <div class="topwrap">
                <div class="userinfo pull-left">

                </div>
                    <div class="posttext pull-left">
                        <div class="">
                            <div class="postreply">Poster un Topic</div>
                            <input name="name" id="reply" placeholder="Votre titre">{{ old('name') }}</textarea>
                        </div>

                        <div class="textwraper">
                            <textarea name="message" id="reply" placeholder="Votre message">{{ old('message') }}</textarea>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>                              
                <div class="postinfobot">
                    <div class="pull-right postreply">
                        <div class="pull-left"><button type="submit" class="btn btn-primary">Post Reply</button></div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div>
        <!-- POST -->

    </div>
               
@endsection