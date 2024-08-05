@extends('layouts.web.main')

@section('title', 'Koperasi')

@push('header-styles')
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.2/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        /* Option 2: Import via CSS */
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");
        @import url('https://cdn-uicons.flaticon.com/2.4.2/uicons-regular-rounded/css/uicons-regular-rounded.css');
        @media (max-width:450px) {
            .custom-event-card {
                margin-bottom: 15px
            }
        }

        .swiper-container {
            width: 100%;
            height: 100vh;
        }

        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            color: white;
            text-align: center;
        }

        .hero-banner img {
            max-width: 100%;
            height: auto;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: white;
        }
    </style>
@endpush

@section('content')
    <section class="hero swiper-container" id="home" aria-label="hero">
        <div class="swiper-wrapper">
            @foreach ($jumbotrons as $jumbotron)
                <div class="swiper-slide"
                    style="background-image: url('{{ url($jumbotron->image_url) }}'); background-size: cover; background-position: center;">
                    <div class="container h-100 d-flex justify-content-center align-items-center">
                        <div class="hero-content text-center">
                            @if ($jumbotron->title || $jumbotron->description)
                                <p class="section-subtitle">{{ $jumbotron->name }}</p>
                                @if ($jumbotron->title)
                                    <h2 class="h1 hero-title" style="font-size: 55px">{{ $jumbotron->title }}</h2>
                                @endif
                                @if ($jumbotron->description)
                                    <p class="hero-text">{{ $jumbotron->description }}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add Pagination -->
        {{-- <div class="swiper-pagination"></div> --}}

        <!-- Add Navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </section>

    <section class="category" aria-label="category" style="position: relative; top: -55px; z-index: 5;">
        <div class="container">
            <ul class="grid-list">
                @foreach ($ekskulls as $ekskull)
                    <li>
                        <div class="category-card">

                            <div class="card-icon">
                                <img src="{{ $ekskull->icon }}" class="img-fluid" alt="Icon" style="width: 25px">
                            </div>

                            <div>
                                <h3 class="h3 card-title">
                                    <span>{{ $ekskull->title }}</span>
                                </h3>

                                <span class="card-meta">{{ $ekskull->desc }}</span>
                            </div>

                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="section about" id="visimisi" aria-label="about">
        <div class="container">
            @foreach ($visiMisis as $visiMisi)
                <figure class="about-banner">

                    <img src="{{ Storage::url($visiMisi->image_url) }}" width="450" height="590" loading="lazy"
                        alt="about banner" class="w-100 about-img"
                        style="width: 100%; height: 100%; object-fit: cover; object-position: center;">

                </figure>

                <div class="about-content">
                    <h2 class="h2 section-title">Visi & Misi</h2>

                    <ul class="about-list">
                        <li class="about-item">
                            <div>
                                <h3 class="h3 item-title">Visi</h3>

                                <p class="item-text">
                                    {{ $visiMisi->content_visi }}
                                </p>
                            </div>
                        </li>

                        <li class="about-item">
                            <div>
                                <h3 class="h3 item-title">Misi</h3>
                                @php
                                    $content = is_string($visiMisi->content)
                                        ? json_decode($visiMisi->content, true)
                                        : $visiMisi->content;
                                @endphp
                                <ul style="margin-left: 20px;">
                                    @foreach ($content as $item)
                                        <li style="list-style-type: disc;">{{ $item['description'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <a href="#contactus" class="btn btn-primary">
                        <span class="span">Ketahui Lebih Detail</span>
                        <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                    </a>
            @endforeach

        </div>

        </div>
    </section>

    <section class="section event" id="news" aria-label="event">
        <div class="container">

            <div class="">
                <p class="section-subtitle">Berita Terkini</p>
                <h2 class="h2 section-title" style="margin-block-end: 0">Seputar Berita Koperasi</h2>
                <a class="link-detail" href="{{ route('all-news.all') }}" style="margin-block-end: 30px">Lihat
                    Semua</a>
            </div>

            <ul class="grid-list">
                @foreach ($news->take(3) as $berita)
                    <li>
                        <div class="event-card custom-event-card" style="">
                            <figure class="card-banner">
                                <img src="{{ asset('storage/' . $berita->image_url) }}" width="370" height="250"
                                    loading="lazy" alt="Innovation & Technological Entrepreneurship Team" class="img-cover">
                            </figure>
                            <time class="badge" datetime="2022-12-04">{{ $berita->published_date }}</time>
                            <div class="card-content" style="padding-top: 10px">
                                <span class="span" style="padding-top:15px"><i class="bi bi-person"
                                        style="position: relative; top: -1.5px;"></i> {{ $berita->author }}</span>
                                <h3 class="h3" style="margin-bottom: 0">
                                    <a href="{{ route('news-detail.show', $berita->id) }}"
                                        class="card-title pb-0">{{ strlen($berita->title) > 35 ? substr($berita->title, 0, 35) . '...' : $berita->title }}</a>
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

    <section class="section newsletter" aria-label="newsletter" id="contactus"
        style="background-image: url('./assets-web/images/newsletter-bg.jpg')">
        <div class="container">
            <p class="section-subtitle">Kontak Kami</p>
            <h2 class="h2 section-title">Mari Terhubung Melalui Kontak Kami</h2>

            <form action="{{ route('contactus.store') }}" method="POST" class="newsletter-form">
                @csrf

                <div class="input-wrapper">
                    <input type="email" name="email" aria-label="email"
                        placeholder="Masukkan Email Anda Agar Terhubung Dengan Kami" required class="email-field"
                        value=" @if (session('success')) {{ session('success') }} @endif">
                    <ion-icon name="mail-open-outline" aria-hidden="true"></ion-icon>
                </div>

                <button type="submit" class="btn btn-primary">
                    <span class="span">Hubungi Kami</span>
                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                </button>
            </form>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var swiper = new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>
@endpush
