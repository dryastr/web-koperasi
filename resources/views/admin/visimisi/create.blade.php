@extends('layouts.main')

@section('title', isset($visimisi) ? 'Edit Data Visi Misi' : 'Tambah Data Visi Misi')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ isset($visimisi) ? 'Edit Data Visi Misi' : 'Tambah Data Visi Misi' }}</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ isset($visimisi) ? route('visimisi.update', $visimisi->id) : route('visimisi.store') }}"
                        method="POST" enctype="multipart/form-data" class="form form-horizontal">
                        @csrf
                        @if (isset($visimisi))
                            @method('PUT')
                        @endif
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="content_visi">Visi</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    {{-- <input type="text" id="content_visi" class="form-control" name="content_visi"
                                        value="{{ old('content_visi', isset($visimisi) ? $visimisi->content_visi : '') }}"
                                        placeholder="Visi" required> --}}
                                        <textarea name="content_visi" class="form-control" rows="3" placeholder="Visi Misi"
                                                    required></textarea>
                                </div>

                                <div class="col-md-4">
                                    <label for="content">Misi</label>
                                </div>
                                <div class="col-md-8 form-group" id="content-container">
                                    @if (isset($visimisi) && $visimisi->content)
                                        @foreach (json_decode($visimisi->content, true) as $index => $item)
                                            <div class="content-item mb-3">
                                                {{-- <input type="text" name="content[{{ $index }}][title]"
                                                    class="form-control" value="{{ $item['title'] }}" placeholder="Title"
                                                    required> --}}
                                                <textarea name="content[{{ $index }}][description]" class="form-control" rows="3" placeholder="Misi"
                                                    required>{{ $item['description'] }}</textarea>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm mt-1 remove-content">Remove</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="content-item mb-3">
                                            {{-- <input type="text" name="content[0][title]" class="form-control"
                                                placeholder="Title"> --}}
                                            <textarea name="content[0][description]" class="form-control" rows="3" placeholder="Misi"></textarea>
                                            <button type="button"
                                                class="btn btn-danger btn-sm mt-1 remove-content">Hapus</button>
                                        </div>
                                    @endif
                                    <button type="button" class="btn btn-primary btn-sm mb-3" id="add-content">Tambah Misi</button>
                                </div>

                                <div class="col-md-4">
                                    <label for="image">Gambar</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="file" id="image" class="form-control" name="image">
                                    @if (isset($visimisi) && $visimisi->image_url)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $visimisi->image_url) }}" alt="Current Image"
                                                style="max-width: 200px;">
                                        </div>
                                    @endif
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let contentIndex = {{ isset($visimisi) ? count(json_decode($visimisi->content, true)) : 1 }};

            document.getElementById('add-content').addEventListener('click', function() {
                let contentContainer = document.getElementById('content-container');
                let contentItem = document.createElement('div');
                contentItem.className = 'content-item mb-3';
                contentItem.innerHTML = `
                    <textarea name="content[${contentIndex}][description]" class="form-control" rows="3" placeholder="Misi"></textarea>
                    <button type="button" class="btn btn-danger btn-sm mt-1 remove-content">Remove</button>
                `;
                contentContainer.appendChild(contentItem);
                contentIndex++;
            });

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-content')) {
                    event.target.closest('.content-item').remove();
                }
            });
        });
    </script>
@endpush
