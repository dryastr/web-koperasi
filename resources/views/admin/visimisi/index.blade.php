@extends('layouts.main')

@section('title', 'Daftar Visi Misi')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Daftar Visi Misi</h4>
                        @if (!$hasVisiMisi)
                            <a href="{{ route('visimisi.create') }}" class="btn btn-success">Tambah Visi Misi</a>
                        @endif
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Visi</th>
                                        <th>Misi</th>
                                        <th>Gambar</th>
                                        <th>Dibuat Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visiMisis as $visiMisi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $visiMisi->content_visi }}</td>
                                            <td>
                                                @php
                                                    $content = is_string($visiMisi->content)
                                                        ? json_decode($visiMisi->content, true)
                                                        : $visiMisi->content;
                                                @endphp
                                                @foreach ($content as $item)
                                                    <ul>
                                                        <li>{{ $item['description'] }}</li>
                                                    </ul>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($visiMisi->image_url)
                                                    <img src="{{ Storage::url($visiMisi->image_url) }}"
                                                        alt="Visi Misi Image" class="img-fluid" style="width: 100px">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $visiMisi->created_at->format('d M Y') }}</td>
                                            <td class="text-nowrap">
                                                <div class="dropdown dropup">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton-{{ $visiMisi->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton-{{ $visiMisi->id }}">
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ route('visimisi.edit', $visiMisi->id) }}">Ubah</a>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('visimisi.destroy', $visiMisi->id) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus Visi&Misi ini?')">
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
