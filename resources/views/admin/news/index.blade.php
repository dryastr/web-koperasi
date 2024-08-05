@extends('layouts.main')

@section('title', 'Daftar Berita')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Daftar Berita</h4>
                        <a href="{{ route('news.create') }}" class="btn btn-success">Tambah Berita</a>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Penulis</th>
                                        <th>Tanggal Publikasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($news as $index => $newsItem)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $newsItem->title }}</td>
                                            <td>{{ Str::limit($newsItem->description, 50) }}</td>
                                            <td>
                                                @if ($newsItem->image_url)
                                                    <img src="{{ asset('storage/' . $newsItem->image_url) }}"
                                                        alt="Gambar Berita" style="width: 100px;">
                                                @else
                                                    Tidak ada gambar
                                                @endif
                                            </td>
                                            <td>{{ $newsItem->author }}</td>
                                            <td>{{ $newsItem->published_date }}</td>
                                            <td class="text-nowrap">
                                                <div class="dropdown dropup">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton-{{ $newsItem->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton-{{ $newsItem->id }}">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('news-detail.show', $newsItem->id) }}">Detail</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('news.edit', $newsItem->id) }}">Ubah</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('news.destroy', $newsItem->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
