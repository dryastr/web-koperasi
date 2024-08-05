@extends('layouts.main')

@section('title', 'Tambah Berita')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Berita</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data"
                        class="form form-horizontal">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="title">Judul</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="title" class="form-control" name="title"
                                        placeholder="Judul Berita" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="description">Deskripsi</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Deskripsi Berita"
                                        required></textarea>
                                </div>

                                <div class="col-md-4">
                                    <label for="image">Gambar</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="file" id="image" class="form-control" name="image">
                                </div>

                                <div class="col-md-4">
                                    <label for="author">Penulis</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="author" class="form-control" name="author"
                                        value="{{ $user->name }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label for="published_date">Tanggal Publikasi</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="date" id="published_date" class="form-control" name="published_date">
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
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
