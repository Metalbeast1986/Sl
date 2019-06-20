<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Comment;

use Auth;

/*use Session;
*/
class CommentController extends Controller
{
    public function show(Comment $comment)
    {
        $this->authorize('show', $comment);

        return view('comments.show', compact('comment'));
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'body'=>'required',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->body = $request->input('body');
        $comment->save();

        return redirect()->route(
            'comments.show',
            $comment->id
        )->with(
                'flash_message',
                'Article, '. $comment->body.' updated'
            );
    }

    public function create()
    {
        $this->authorize('create', Comment::class);
        $comment = new Comment;

        return view('comments.create');
    }

    public function store(Request $request)
    {
        $validated=request()->validate([
            'body'=> ['required', 'min:3'],
        ]);
        $comment =  Comment::create($validated + ['user_id' => auth()->id()]);
        
        //Display a successful message upon save
        return redirect()->route('comments.index')
                ->with('flash_message', 'Article,
                 '. $comment->body.' created');
    }

    public function index()
    {
        $comments = Comment::where('user_id', auth()->id()) //show only authenticated user's comments
        ->orderby('id', 'desc')
        ->paginate(5); //show only 5 items at a time in descending order

        return view('comments.index', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        
        return redirect()->route('comments.index')
        ->with(
            'flash_message',
            'Comment successfully deleted'
        );
    }
}
