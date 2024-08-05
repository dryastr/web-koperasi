@extends('layouts.web.main')

@section('title', 'Berita | Koperasi')

@push('header-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
@endpush

@section('content')
    <div class="container">
        <div class="section">
            <div class="container-center">
                <div class="container-detail-news">
                    <img class="detail-news" src="{{ asset('storage/' . $berita->image_url) }}" alt="">
                </div>
                <div class="group-mark" style="margin-top: 15px">
                    <span class="span" style="margin-right: 15px">
                        <i class="bi bi-person"style="position: relative; top: -1.5px;"></i>
                        {{ $berita->author }}
                    </span>
                    <span>
                        <i class="bi bi-calendar" style="position: relative; top: -1.5px;"></i>
                        {{ $berita->published_date }}
                    </span>
                </div>
                <h1 class="text-left" style="font-size: 23px; margin-bottom: 15px;margin-top:15px">
                    {{ $berita->title }}
                </h1>
                <p style="font-size: 20px; margin-top: 0; word-break:break-word;">{{ $berita->description }}</p>
            </div>
        </div>
    </div>
@endsection
