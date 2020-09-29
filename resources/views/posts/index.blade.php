@extends('layouts.app')

@section('content')

<div class="container">



    <div style="display:inline-block;width:50%;float: left;">
        @foreach ($posts as $post)



        <div class="post row mb-4 pt-3">


            <div class="col-12 p-0">
                <a href="/profiles/{{$post->user->username}}" style="text-decoration:none;color:black;">
                    <div class="mb-3">

                        <img src="{{ asset('storage').'/'.$post->user->profile->image }}" style="width:30px"
                            class="rounded-circle mr-2 ml-3"> <strong class='mr-3 '>{{ $post->user->username }}</strong>
                        {{$post->created_at->format('d/m/y')}}


                    </div>
                </a>

                <a href="{{ route('posts.show',['post' => $post->id]) }}"><img
                        src="{{ asset('storage').'/'.$post->image }}" class='w-100' alt=""></a>
                <p class="mt-2" style="text-indent:10px">{{$post->caption}}</p>

                <form action="{{ route('posts.like') }}" id="form-js" class="ml-2" >
                    <div id="count-js">{{ $post->likes->count() }} Like(s)</div>
                    <input type="hidden" id="post-id-js" value="{{ $post->id }}">
                    <button class="btn btn-link btn-sm" type='submit'>

                        <i class="{{$post->heartAnimation()}}" id='heart'></i>

                    </button>
                    
                    
                    
                </form>

                <form action="{{ route('posts.comment') }}" id="form-comment" class="mt-2">
                    <input type="hidden" id="post-id-js" value="{{ $post->id }}">

                    <input type="text" style="width:85%;border:none" placeholder="Ajouter un commentaire..." id='input'>
                    <button class="btn btn-outline-primary btn-sm mb-1 ml-3 d-none  publish" type="submit" >Publier</button>

                </form>




            </div>



        </div>



        @endforeach

        <div class="col-12">

            <div class="row d-flex justify-content-left">

                {{$posts->links()}}


            </div>


        </div>

    </div>

    <div class="div_profile ">

        <div class="row">

            <div class="col-4">

                <a href="/profiles/{{$user->username}}" style="text-decoration:none;color:black;">


                    <img src="{{ $user->profile->getImage() }}" style="width:100px" class="rounded-circle  ml-3 mt-4">


                </a>

            </div>

            <div class="col-8 pt-4">

                <strong>{{ $user->username }}</strong>

                <p>{{ $user->name }}</p>


            </div>

        </div>

        <div class="row mt-3">
            <div class="w-100">


                <p class="ml-4">tout les profiles sur la platforme</p>



            </div>

        </div>
        @foreach($utilisateurs as $utilisateur)

        <div class="row pl-4 pb-1">


            <a href="/profiles/{{  $utilisateur->username  }}">

                <img src="{{ $utilisateur->profile->getImage() }}" style="width:30px" class="rounded-circle "> <strong
                    class='mt-5'>{{ $utilisateur->username }}</strong>

            </a>


        </div>

        @endforeach




    </div>



</div>

@endsection


@section('like-js')
<script src="{{ asset('js/like.js') }}"></script>
@endsection
