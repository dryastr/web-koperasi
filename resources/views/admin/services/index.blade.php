@extends('layouts.main')

@section('title', 'Daftar Services')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Daftar Services</h4>
                        <a href="{{ route('services.create') }}" class="btn btn-success">Tambah Services</a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Deskripsi</th>
                                        <th>Icon</th>
                                        <th>Created At</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ekskulls as $ekskull)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ekskull->title }}</td>
                                            <td>{{ $ekskull->desc }}</td>
                                            <td><img src="{{ asset($ekskull->icon) }}" alt="Icon"
                                                    style="max-height: 30px;"></td>
                                            <td>{{ $ekskull->created_at }}</td>
                                            <td class="text-nowrap">
                                                <div class="dropdown dropup">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton-{{ $loop->index }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton-{{ $loop->index }}">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('services.edit', $ekskull->id) }}">Ubah</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('services.destroy', $ekskull->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus Services ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item">Hapus</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
