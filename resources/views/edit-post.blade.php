@extends('layout.app')

@section('title')
Edit post
@endsection

@push('addons-css')
@endpush

@section('content')
<div class="card mt-5">
  <div class="card-body">
    <p>ID data : {{ $post->id }}</p>
    <form action="{{url('/update')}}/{{$post->id}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="judul" name="title" value="{{ $post->title }}">
        @error('title')
          <div id="" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="description" class="form-control" value="" @error('description') is-invalid @enderror>{{ $post->description }}</textarea>
        @error('title')
          <div id="" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="form-group">
        <label class="font-weight-bold">Gambar</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
        @error('description')
          <div id="" class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="">
        <img src="{{ Storage::url('public/img/').$post->image }}" alt=""
        style="width:100px;">
      </div>
      <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
  </div>
</div>

@endsection

@push('addons-js')
@endpush

