@extends('layout.app')

@section('title')
Tambah post
@endsection

@push('addons-css')
    
@endpush

@section('content')
<div class="card mt-5">
  <div class="card-body">
    <form action="{{ route('tambah-post') }}" method="POST" class="" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" class="w-25 border border-secondary form-control @error('title') is-invalid @enderror" id="judul" name="title">
        @error('title')
        <div id="" class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="description" class="w-50 border border-secondary form-control @error('description') is-invalid @enderror"></textarea>
        @error('description')
        <div id="" class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label class="font-weight-bold">GAMBAR</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
    
        <!-- error message untuk title -->
        @error('description')
        <div id="" class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header">Data Post
    <a href="{{url('/reset-id')}}" class="btn btn-danger">Reset</a>
    <a href="{{url('/order-desc')}}" class="btn btn-primary">Terbaru</a>
    <a href="{{url('/order-asc')}}" class="btn btn-primary">Terlama</a>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Judul</th>
          <th scope="col">Deskripsi</th>
          <th scope="col">Gambar</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($show as $item)
        <tr>
          <th scope="row">{{ $item->id }}</th>
          <td>{{ $item->title }}</td>
          <td>{{ $item->description }}</td>
          <td>
            <img src="{{ Storage::url('public/img/').$item->image }}" alt=""
            style="width:100px;"></td>
          <td>
            <a href="{{url('/hapus')}}/{{$item->id}}" class="btn btn-danger">Hapus</a>
            <a href="{{url('/edit-post')}}/{{$item->id}}" class="btn btn-primary">Edit</a>
        </tr>
        @empty
            {{ 'no data' }}
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection

@push('addons-js')
    
@endpush

