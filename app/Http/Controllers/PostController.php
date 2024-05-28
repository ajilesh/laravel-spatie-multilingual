<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = Post::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('title', function($row) {
                    return $row->getTranslation('title', app()->getLocale());
                })
                ->addColumn('content', function($row) {
                    return $row->getTranslation('content', app()->getLocale());
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="'.route('posts.edit',$row->id).'" class="edit btn btn-primary btn-sm">'.__('message.edit').'</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        foreach ($request->input('translations') as $locale => $translation) {
            $post->setTranslation('title', $locale, $translation['title']);
            $post->setTranslation('content', $locale, $translation['content']);
        }
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        foreach ($request->input('translations') as $locale => $translation) {
            $post->setTranslation('title', $locale, $translation['title']);
            $post->setTranslation('content', $locale, $translation['content']);
        }
        $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
