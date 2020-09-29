@extends('layouts.app')

@section('content')

<div class="container">


    <div class="row">
        <div class="col-8">

            <img src="{{ asset('storage').'/'.$post->image}}" class="w-100 " style="height: 650px">

        </div>

        <div class="col-4">

        <a href="/profiles/{{$post->user->username}}" style="text-decoration:none;color:black;">
                    <div class="mb-3">

                        <img src="{{ asset('storage').'/'.$post->user->profile->image }}" style="width:30px" class="rounded-circle " > <strong class='mr-3 '>{{ $post->user->username }}</strong> {{$post->created_at->format('d/m/y')}}


                    </div>
                </a>
            <p>{{$post->caption}}<p>

            @can('delete' , $post)

            <a href="{{ route('post.delete',['user' => $user, 'post' => $post->id]) }}" class="delete">supprimer le post</a>
            @endcan

                <hr >

            <ul class="ul-comment" style="list-style:none">
                @foreach ($comments as $comment)
                <li>
                    <img src="{{ asset('storage').'/'. $comment->user->profile->image }}" style="width:25px" class="rounded-circle mb-1">
                    {{$comment->comment}}

                    @can('delete_comment' , $comment)
                        <a href="{{ route('posts.delete_comment',[ 'comment_id' => $comment->id]) }}" style="position: absolute; right:0; color:red">supprimer </a>
                    @endcan

                </li>
                @endforeach
            </ul>
    
            <div  id='like-comment'>


                <form action="{{ route('posts.like') }}" id="form-js" class="ml-2" >
                    <div id="count-js">{{ $post->likes->count() }} Like(s)</div>
                    <input type="hidden" id="post-id-js" value="{{ $post->id }}">
                    <button class="btn btn-link btn-sm" type='submit'>

                        <i class="{{$post->heartAnimation()}}" id='heart'></i>

                    </button>
                </form>

                
                <form action="{{ route('posts.comment') }}" id="form-comment" >
                    <input type="hidden" id="post-id-js" value="{{ $post->id }}">

                    <input type="text" style="width:70%;border:none" placeholder="Ajouter un commentaire..." id='input'>
                    <button class="btn btn-outline-primary btn-sm mb-1 ml-3 d-none  publish" type="submit" >Publier</button>

                </form>

            </div>


        </div>


    </div>


</div>

@endsection