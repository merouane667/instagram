@extends('layouts.app')

@section('content')

<div class="container ">
    <div class="row pt-3 ">
        <div class="col-4 text-center">
        <img src="{{ $user->profile->getImage() }}" class="rounded-circle w-100" style='max-width:230px'>

        </div>


        <div class="col-8">

            <div class="d-flex">
                <div class='h4 mr-3 pt-2'>{{$user->name}}</div>

                <follow-button profile-id="{{ $user->profile->id }}" follows={{$follows}}></follow-button>

            </div>
            <div class="d-flex mt-3">

                <div class="mr-3"><strong>{{ $user->posts->count() }}</strong> publication(s)</div>
                <div class="mr-3"><strong>{{ $user->profile->followers->count() }}</strong> abonnés</div>
                <div class="mr-3"><strong>{{ $user->following->count() }}</strong> abonnements</div>
            
            </div>

            @can('update' , $user->profile)

            <a href="{{ route('profiles.edit',['user' => $user->username]) }}" class="btn btn-outline-secondary mt-3">Modifier mes informations</a>

            @endcan


            <div class="mt-3">
                <div><strong>{{$user->profile->title}}</strong></div>
                <div>{{$user->profile->description}}</div>
                <a href="{{$user->profile->url}}">{{$user->profile->url}}</a>
            
            </div>
        


        </div>
    </div>

    <div class="row mt-5">

        @foreach( $user->posts as $post)

        <div class="col-4 mt-4">

            <a href="{{ route('posts.show',['post' => $post->id]) }}">
            <img src="{{ asset('storage').'/'.$post->image }}" class='w-100' alt="">
            
            </a>
    
        </div>

        @endforeach





    </div>







</div>
@endsection
