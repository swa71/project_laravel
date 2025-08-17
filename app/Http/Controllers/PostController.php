<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Affiche tous les posts dans la page admin
    public function index()
    {
       $posts = Post::latest()->paginate(6);
    return view('admin.index', compact('posts'));
    }

    // Affiche les posts dans la page welcome
    public function welcome()
    {
        $posts = Post::latest()->get();
        return view('welcome', compact('posts'));
    }

    // Formulaire de création
    public function create()
    {
        return view('admin.create');
    }

    // Enregistre un nouveau post
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagesPaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagesPaths[] = $image->store('posts', 'public');
            }
        }

        Post::create([
            'title'   => $request->title,
            'content' => $request->content,
            'images'  => $imagesPaths,
        ]);

        return redirect()->route('posts.admin')->with('success', 'Post ajouté avec images');
    }

    // Formulaire de modification
    public function edit(Post $post)
    {
        return view('admin.edit', compact('post'));
    }

    // Mise à jour du post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagesPaths = $post->images ?? [];

        if ($request->hasFile('images')) {
            // Supprimer les anciennes images
            foreach ($imagesPaths as $old) {
                Storage::delete('public/' . $old);
            }
            $imagesPaths = [];

            foreach ($request->file('images') as $image) {
                $imagesPaths[] = $image->store('posts', 'public');
            }
        }

        $post->update([
            'title'   => $request->title,
            'content' => $request->content,
            'images'  => $imagesPaths,
        ]);

        return redirect()->route('posts.admin')->with('success', 'Post mis à jour');
    }

    // Affiche les posts dans la page principale
    public function showPosts()
    {
        $posts = Post::latest()->get();
        return view('main', compact('posts'));
    }

    // Suppression d’un post
    public function destroy(Post $post)
    {
        if ($post->images) {
            foreach ($post->images as $img) {
                Storage::delete('public/' . $img);
            }
        }

        $post->delete();
        return redirect()->route('posts.admin')->with('success', 'Post supprimé');
    }
}
