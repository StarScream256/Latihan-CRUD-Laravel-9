<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
  public function index(Request $request)
  {
  $show = Post::oldest()->get();
  return view('create-post', compact('show'));
  }

  public function main() 
  {
    return view ('index');
  }

  public function create() 
  {
    return view ('create-post');
  }

  public function store(Request $request) 
  {

    $validated = $request->validate([
      'image'       => 'required|image|mimes:png,jpg,jpeg',
      'title'       => 'required|unique:posts|max:255',
      'description' => 'required',
    ]);

    $image = $request->file('image');
    $image->storeAs('public/img', $image->hashName());

    Post::create([
      'image'       => $image->hashName(),
      'title'       => $validated['title'],
      'description' => $validated['description'],
    ]);
    return redirect('/post')->with('sucess', 'Berhasil menambah data');
  }
  public function delete($id)
  {
    $post = Post::find($id);
    $post->delete();
    return redirect('/post')->with('sucess', 'Data Berhasil Dihapus!');
  }
  public function edit(Request $request,$id)
  {
    $post   = Post::whereId($id)->first();
    return view('edit-post')->with('post', $post);
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'image'       => 'image|mimes:png,jpg,jpeg',
      'title'       => 'required|unique:posts,title,'.$id.'|max:255',
      'description' => 'required',
    ]);

    $post = Post::find($id);

    if($request->file('image') == "") {
    
      $post->update([
        'title'       => $validated['title'],
        'description' => $validated['description'],
    ]);

    } else {

      Storage::disk('local')->delete('public/img/'.$post->image);
        
      $image = $request->file('image');
      $image->storeAs('public/img', $image->hashName());

      $post->update([
          'image'       => $image->hashName(),
          'title'       => $validated['title'],
          'description' => $validated['description'],
      ]);

    }
    $post->save();

    return redirect('/post')->with('sucess', 'Data Berhasil Diubah!');
  }

  public function resetId()
  {
    Post::truncate();

    DB::statement('ALTER TABLE posts AUTO_INCREMENT = 1;');

    return redirect('/post')->with('success', 'Id pada tabel posts berhasil di-reset!');
  }

  public function orderDesc(Request $request)
  {
    $show = Post::latest()->get();
    return view('create-post', compact('show'));
  }

  public function orderAsc(Request $request)
  {
    $show = Post::oldest()->get();
    return view('create-post', compact('show'));
  }
}