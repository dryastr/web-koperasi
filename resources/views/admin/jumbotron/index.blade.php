@extends('layouts.main')

@section('title', 'Daftar Jumbotron')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Daftar Jumbotron</h4>
                        <a href="{{ route('jumbotron.create') }}" class="btn btn-success">Tambah Jumbotron</a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Dibuat Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jumbotrons as $jumbotron)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $jumbotron->name }}</td>
                                            <td>{{ $jumbotron->title }}</td>
                                            <td>{{ Str::limit($jumbotron->description, 50) }}</td>
                                            <td>
                                                @if ($jumbotron->image_url)
                                                    <img src="{{ url($jumbotron->image_url) }}"
                                                        alt="{{ $jumbotron->judul }}" class="img-fluid"
                                                        style="width: 100px">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $jumbotron->created_at->format('d M Y') }}</td>
                                            <td class="text-nowrap">
                                                <div class="dropdown dropup">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton-{{ $jumbotron->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton-{{ $jumbotron->id }}">
                                                        <li><a class="dropdown-item"
                                                                href="http://127.0.0.1:8000/#home">Detail</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('jumbotron.edit', $jumbotron->id) }}">Ubah</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('jumbotron.destroy', $jumbotron->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus Jumbotron ini?')">
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
