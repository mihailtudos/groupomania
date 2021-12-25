<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class LikesHandler extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->likes = json_encode($request['likes']);
        $post->dislikes = json_encode($request['dislikes']);
        $post->save();
    }
}
