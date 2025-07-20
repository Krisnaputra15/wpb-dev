@extends('template.front')

@section('title')
Berita
@endsection

@section('content')
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url({{$bg->cover}});">
       <div class="container">
          <div class="inner-banner-content">
             <h1 class="inner-title">Berita</h1>
          </div>
       </div>
    </div>
    <div class="inner-shape"></div>
 </section>
 <!-- Inner Banner html end-->
 <div class="archive-section blog-archive">
    <div class="archive-inner">
       <div class="container">
          <div class="row">
             <div class="col-lg-8 primary right-sidebar">
                <!-- blog post item html start -->
                <div class="row">
                   @foreach ($news as $key => $data)
                   <div class="grid-item col-md-6 col-6">
                        <article class="post h-100">
                            <figure class="feature-image">
                                <a href="{{route('news.detail', [$data->id])}}">
                                    <img src="{{asset($data->cover)}}" class="cover" alt="">
                                </a>
                            </figure>
                            <div class="entry-content h-auto">
                                <h3>
                                    <a href="{{route('news.detail', [$data->slug])}}">{{$data->title}}</a>
                                </h3>
                                <div class="entry-meta">
                                    <span class="byline">
                                        <a href="#">Oleh DPKA UB</a>
                                    </span>
                                    <span class="posted-on">
                                        <a href="#">{{$data->created_at->locale('id_ID')->isoFormat('D MMMM Y')}}</a>
                                    </span>
                                </div>
                                <div class="preview">
                                    {!!explode('</p>',$data->description)[0]!!}</p>
                                </div>
                                <a href="{{route('news.detail', [$data->slug])}}" class="button-text">LANJUTKAN MEMBACA..</a>
                            </div>
                        </article>
                    </div>
                   @endforeach
                </div>
                <!-- blog post item html end -->
                <!-- pagination html start-->
                <div class="post-navigation-wrap">
                    {{$news->links()}}
                </div>
                <!-- pagination html start-->
             </div>
             <div class="col-lg-4 secondary">
                <div class="sidebar">
                   <aside class="widget widget_latest_post widget-post-thumb">
                      <h3 class="widget-title">Berita Terbaru</h3>
                      <ul>
                         @foreach ($latestNews as $news)
                            <li>
                                <a href="{{route('news.detail', [$news->slug])}}">
                                    <figure class="post-thumb">
                                        <a href="{{route('news.detail', [$news->slug])}}"><img src="{{asset($news->cover)}}" alt=""></a>
                                    </figure>
                                    <div class="post-content">
                                        <h5>
                                            <a href="{{route('news.detail', [$news->slug])}}">{{$news->title}}</a>
                                        </h5>
                                        <div class="entry-meta">
                                            <span class="posted-on">
                                                <a href="#">{{$data->created_at->locale('id_ID')->isoFormat('D MMMM Y')}}</a>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                         @endforeach
                      </ul>
                   </aside>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection

@push('script')
<script>
    $('.preview').each(function() {
        var firstP = $(this).find('p:first').addClass('text-truncate');
        console.log(firstP.text());  // Log the text of the first <p> element
    });
</script>
@endpush

