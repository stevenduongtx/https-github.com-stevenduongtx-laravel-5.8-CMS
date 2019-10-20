<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request\Posts;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['verifyCategoriesCount'])->only(['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
       // dd($request->all());
        //Upload the image to storage
        $image = $request->image->store('posts');
        //dd($request->image->store('posts'));
        //create the post
       $post=Post::create([
           'title'=>$request->title,
           'content' => $request->content,
           'description' => $request->description,
           'category_id'=>$request->category,
           'image' => $image
       ]);

       if($request->tags){
           $post->tags()->attach($request->tags);
       }
        //flash message

        session()->flash('success','Post created successfully');

        //redirect user
        return redirect(route('posts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {

        $data=$request->only([
            'title','description','content','published_at','category'
        ]);
        if($request->hasFile('image'))
        {
            $image=$request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
            $data['category_id']= $request->category;
        }
        //dd($data);
        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        $post->update($data);
       // dd($post->category_id);


        session()->flash('success','Post updated successfully');
        return redirect(route('posts.index')) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();
        if($post->trashed())
        {
            $post->deleteImage();
            $post->forceDelete();
        }else
        {
            $post->delete();
        }

        session()->flash('success','Post deleted successfully');

        return redirect(route('posts.index'));

    }

    /**
     * Display all the trashed posts
     *
     *
     *
     */
    public function trashed()
    {

        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed);

    }

    public function restore($id){
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        session()->flash('success','Post restored successfully');

        return redirect()->back();

    }


}
