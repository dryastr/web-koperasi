@extends('layouts.main')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Service Baru</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data"
                        class="form form-horizontal">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="title">Judul</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="title" class="form-control" name="title"
                                        placeholder="Judul" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="desc">Deskripsi</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea id="desc" class="form-control" name="desc" placeholder="Deskripsi" rows="4"></textarea>
                                </div>

                                <div class="col-md-4">
                                    <label for="icon">Icon</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="file" id="icon" class="form-control" name="icon" required>
                                    <span style="font-size: 14px; margin-left:5px">*Link icon dapat diakses melalui <a
                                            href="https://www.flaticon.com/search?word=&type=uicon" target="_blank">Link
                                            Icon</a>, download dengan format <i>.png</i></span>
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
