<?php


namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $formData = $request->validated();
        //creo slug
        $slug = Str::slug($formData['title'], '-');
        //aggiungo lo slug a form data
        $formData['slug'] = $slug;

        //id della persona loggata che salva il post
        $userId = Auth::id();
        //aggiungo id utente a form data
        $formData['user_id'] = $userId;

        if ($request->hasFile('image')) {
            $img_path = Storage::put('uploads', $formData['image']);
            $formData['image'] = $img_path;
        }

        $post = Post::create($formData);
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $formData = $request->validated();
        //CREATE SLUG
        $slug = Str::slug($formData['title'], '-');
        //add slug to formData
        $formData['slug'] = $slug;

        //aggiungiamo l'id dell'utente proprietario del post
        $formData['user_id'] = $post->user_id;

        $post->update($formData);
        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return to_route('admin.posts.index')->with('message', "$post->title eliminato con successo");
    }
}
// il bottone per cancellare devo metterlo in un piccolo form
