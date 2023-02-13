<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function showCreateForm(){
        return view('create-post');
    }

    public function storeNewPost(Request $request){
      $incommingFields= $request->validate([
            'title'=>'required',
            'body'=>'required'
      ]);
      $incommingFields['title']=strip_tags($incommingFields['title']);//strip_tage is used to remove unwanted html or php codes from the string.
      $incommingFields['body']=strip_tags($incommingFields['body']);
      
      $incommingFields['user_id'] = auth()->id(); //dianamic user id value

      
      
      $newPost = Post::create($incommingFields);
      return redirect("/post/{$newPost->id}")->with('success','new post created');
    }

    public function showSinglePost(Post $post){//type hinting(matching the post variable to the post variable from the route) laravel wil automaticly query the table for us this this case.
        $post['body']=Str::markdown($post->body);//using buitin markdown function
        return view('single-post',['post'=>$post]);
    }

    public function delete(Post $post){
        if (auth()->user()->cant('delete',$post)) {
            //idk why the fuck is vs code not getting cant() function
            return 'you can not delete this post';
        }
     
        try {
           $post->delete();
        } catch (Exception $e) {
           return redirect('/profile/'. auth()->user()->username)->with("error","post delete failed");
        }
     
        return redirect('/profile/'. auth()->user()->username)->with("success","post successfully deleted");
    }
}
