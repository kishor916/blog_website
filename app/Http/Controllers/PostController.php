<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

      Post::create($incommingFields);
    }
    
}
