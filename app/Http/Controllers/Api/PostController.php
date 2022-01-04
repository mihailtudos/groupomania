<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return Post[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['user', 'comments'])->latest()->get();

        foreach ($posts as $post) {
            $post->likes = json_decode($post->likes);
            $post->dislikes = json_decode($post->dislikes);
        }

        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'excerpt' => ['required', 'min:15', 'max: 160'],
        ]);

        $filePath = '';

        // ensure the request has a file before we attempt anything else.
        if ($request->has('image') and $request->image) {
            $request->validate([
                'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            ]);

            // Get image file
            $image = $request->file('image');

            //image name
            $name = time();

            // Define folder path
            $folder = '/uploads/posts/';

            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();

            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
        }


        $post = auth()->user()->posts()->create([
            'excerpt' => $validatedData['excerpt'],
            'image' => $filePath,
            'likes' => json_encode([]),
            'dislikes' => json_encode([]),
        ]);

        return response()->json($post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with(['user', 'comments'])->findOrFail($id);
        $post->likes = json_decode($post->likes);
        $post->dislikes = json_decode($post->dislikes);

        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function comments($id): \Illuminate\Http\JsonResponse
    {
        $comments = Comment::with('user')->where('post_id', $id)->get();
        return response()->json(['comments' => $comments]);
    }
}
