<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'post_id' => ['required', 'exists:posts,id'],
            'content' => ['required', 'string', 'min:5'],
        ]);

        $comment = Comment::create([
            'user_id' => $data['user_id'],
            'post_id' => $data['post_id'],
            'content' => $data['content']
        ]);

        $comment = Comment::with('user')->where('id', $comment->id)->get();

        return response()->json([
            'comment' => $comment[0]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'min:5']
        ]);
        if (auth()->user()->id == $comment['user_id']) {
            $comment->update([
               'content' => $data['content'],
            ]);
            return response()->noContent();
        }
        return response(null, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|int
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id === auth()->user()->id) {
            $comment->delete();
            return response()->noContent();
        }
        return response(null,404);
    }
}
