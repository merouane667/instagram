<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\User;
use App\Like;
use App\Comment;
use Illuminate\http\JsonResponse;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $utilisateurs= User::orderBy('id', 'ASC')->whereNotIn('username', [auth()->user()->username])->paginate(3);
        $user = auth()->user();
        $users = auth()->user()->following->pluck('user_id'); //on recupert un tableau qui contient les user_id dont l'utilisateur est abonnee
        $posts = Post::whereIn('user_id' , $users)->orderBy('created_at' , 'DESC')->paginate(8);//on recupert les posts qui appartiennent au utilisateur dont je suis abonnee

        return view('posts.index' , compact(['posts','user','utilisateurs']));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => ['required','string'],
            'image' => ['required','image']

        ]);
        
        $imagePath = request('image')->store('uploads','public');

        $image = Image::make(public_path("/storage/{$imagePath}"))->fit(1200, 1200);

        $image->save();

        auth()->user()->posts()->create([

            'caption' => $data['caption'],
            'image' => $imagePath 


        ]);
   

        return redirect()->route('profiles.show' , ['user' => auth()->user(),'animation']);
       
    }


    public function show(Post $post)
    {
        $user= auth()->user()->username ;
        $comments = Comment::where('post_id' , $post->id)->orderBy('created_at' , 'DESC')->paginate(17);


        return view('posts.show' , compact(['post','user','comments']));

    }

    public function destroy(User $user,$id)
    {
        $user = auth()->user();
        $utilisateurs= User::orderBy('id', 'ASC')->whereNotIn('username', [auth()->user()->username])->paginate(3);
        $users = auth()->user()->following->pluck('user_id'); 
        $posts = Post::whereIn('user_id' , $users)->orderBy('created_at' , 'DESC')->paginate(8);


        $post_supp=Post::find($id);
        $this->authorize('delete' , $post_supp );
        $post_supp->delete();
        return view('posts.index' , compact(['posts','user','utilisateurs']));


    }

    
    public function like(): JsonResponse
    {
        $post = Post::find(request()->id);

        if ($post->isLikedByLoggedInUser()) {
            $res = Like::where([
                'user_id' => auth()->user()->id,
                'post_id' => request()->id
            ])->delete();

            if ($res) {
                return response()->json([
                    'count' => Post::find(request()->id)->likes->count()
                ]);
            }

        } else {
            $like = new Like();

            $like->user_id = auth()->user()->id;
            $like->post_id = request()->id;

            $like->save();

            return response()->json([
                'count' => Post::find(request()->id)->likes->count()
            ]);
        }
    }



    public function comment()
    {
        $post = Post::find(request()->id);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->post_id = request()->id;
        $comment->comment = request()->comment;

        $comment->save();

        return response()->json([
            'count' => Post::find(request()->id)->comments->count()
        ]);

        
    }
    public function delete_comment($comment_id)
    {
        $comment = Comment::find($comment_id);
        $this->authorize('delete_comment' , $comment );
        $comment->delete();

        $post = $comment->post;
        $user= auth()->user()->username ;
        $comments = Comment::where('post_id' , $post->id)->orderBy('created_at' , 'DESC')->paginate(17);


        return view('posts.show' , compact(['post','user','comments']));

    }
}
