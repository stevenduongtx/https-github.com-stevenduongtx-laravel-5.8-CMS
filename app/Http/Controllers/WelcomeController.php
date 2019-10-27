<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){

//       $search = request()->query('search');
////        dd($search);
////        exit();
//       if($search){
//           $post = Post::where('title','LIKE',"%{$search}%")->simplePaginate(3);
//       }else{
//           $post = Post::simplePaginate(3);
//       }
        return view('welcome')
            ->with('posts',Post::searched()->simplePaginate(3))
            ->with('categories',Category::all())
            ->with('tags',Tag::all())
            ;
    }
}
