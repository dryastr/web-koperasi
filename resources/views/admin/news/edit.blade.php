@extends('layouts.main')

@section('title', 'Edit Berita')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Berita</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data"
                        class="form form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="title">Judul</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="title" class="form-control" name="title"
                                        value="{{ old('title', $news->title) }}" placeholder="Judul Berita" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="description">Deskripsi</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Deskripsi Berita"
                                        required>{{ old('description', $news->description) }}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <label for="image">Gambar</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="file" id="image" class="form-control" name="image">
                                    @if ($news->image_url)
                                        <div class="mt-2">
                                            <p>Gambar saat ini:
                                                <img src="{{ asset('storage/' . $news->image_url) }}" alt="Current Image"
                                                    style="max-width: 200px;">
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-4">
                                    <label for="author">Penulis</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="author" class="form-control" name="author"
                                        value="{{ old('author', $news->author) }}" placeholder="Penulis Berita" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="published_date">Tanggal Publikasi</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="date" id="published_date" class="form-control" name="published_date"
                                        value="{{ old('published_date', $news->published_date) }}">
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Ubah</button>
                                    <a href="{{ route('news.index') }}"
                                        class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
