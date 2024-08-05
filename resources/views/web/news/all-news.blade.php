@extends('layouts.web.main')

@section('title', 'Berita | Koperasi')

@push('header-styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
@endpush

@section('content')
    <section class="section event" id="event" aria-label="event">
        <div class="container">

            <div class="">
                <p class="section-subtitle">Berita Terkini</p>
                <h2 class="h2 section-title">Seputar Berita Koperasi</h2>
            </div>

            <ul class="grid-list">
                @foreach ($news as $berita)
                    <li>
                        <div class="event-card custom-event-card" style="margin-bottom: 15px">
                            <figure class="card-banner">
                                <img src="{{ asset('storage/' . $berita->image_url) }}" width="370" height="250"
                                    loading="lazy" alt="Innovation & Technological Entrepreneurship Team" class="img-cover">
                            </figure>
                            <time class="badge" datetime="2022-12-04">{{ $berita->published_date }}</time>
                            <div class="card-content" style="padding-top: 10px">
                                <span class="span" style="padding-top:15px"><i class="bi bi-person"
                                        style="position: relative; top: -1.5px;"></i> {{ $berita->author }}</span>
                                <h3 class="h3" style="margin-bottom: 0">
                                    <a href="#" class="card-title pb-0">{{ $berita->title }}</a>
                                </h3>
                                <p class="wrap-text">
                                    {{ strlen($berita->description) > 80 ? substr($berita->description, 0, 80) . '...' : $berita->description }}
                                </p>
                                <a href="{{ route('news-detail.show', $berita->id) }}" class="btn-link"
                                    style="margin-top: 10px">
                                    <span class="span">Lihat Detail</span>
                                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                                </a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

        </div>
    </section>
@endsection
