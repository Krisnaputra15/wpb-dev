@extends('template.front')

@section('title')
    Galeri
@endsection

@section('content')
    <section class="inner-banner-wrap">
        <div class="inner-baner-container" style="background-image: url({{$bg->cover}});">
            <div class="container">
                <div class="inner-banner-content">
                    <h1 class="inner-title">Galeri</h1>
                </div>
            </div>
        </div>
        <div class="inner-shape"></div>
    </section>
    <!-- Inner Banner html end-->
    <!-- gallery section html start -->
    <div class="gallery-section">
        <div class="container">
            <div class="gallery-outer-wrap">
                <div class="gallery-inner-wrap gallery-container grid">
                    @foreach ($gallery as $item)
                        <div class="single-gallery grid-item">
                            <figure class="gallery-img">
                                <img src="{{asset('storage/'.$item->cover)}}" alt="">
                                <div class="gallery-title">
                                    <h3>
                                        <a href="{{route('gallery', [$item->slug])}}" data-lightbox="lightbox-set">
                                            {{$item->title}}
                                        </a>
                                    </h3>
                                </div>
                            </figure>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
