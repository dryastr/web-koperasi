@extends('layouts.main')

@section('title', 'Edit Data Jumbotron')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data Jumbotron</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('jumbotron.update', $jumbotron->id) }}" method="POST" enctype="multipart/form-data"
                        class="form form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Nama</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="name" class="form-control" name="name"
                                        value="{{ $jumbotron->name }}" placeholder="Nama" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="title">Judul</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="title" class="form-control" name="title"
                                        value="{{ $jumbotron->title }}" placeholder="Judul" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="description">Deskripsi</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea id="description" class="form-control" name="description" placeholder="Deskripsi" rows="4" required>{{ $jumbotron->description }}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <label for="image">Gambar</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="file" id="image" class="form-control" name="image">
                                    <p>Gambar saat ini: <img src="{{ $jumbotron->image_url }}" alt="{{ $jumbotron->title }}"
                                            width="100"></p>
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
