@extends('template.front')

@section('title')
{{$news->title}}
@endsection

@section('content')
<!-- Inner Banner html start-->
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{asset($news->cover)}}');">
       <div class="container">
          <div class="inner-banner-content">
             <h1 class="inner-title">{{$news->title}}</h1>
             <div class="entry-meta">
                <span class="byline">
                   <a href="#">DPKA UB</a>
                </span>
                <span class="posted-on">
                   <a href="#">{{$news->created_at->locale('id_ID')->isoFormat('D MMMM Y')}}</a>
                </span>
             </div>
          </div>
       </div>
    </div>
    <div class="inner-shape"></div>
 </section>
 <!-- Inner Banner html end-->
 <div class="single-post-section">
    <div class="single-post-inner">
       <div class="container">
          <div class="row">
             <div class="col-lg-8 primary right-sidebar">
                <!-- single blog post html start -->
                {{-- <figure class="feature-image">
                   <img src="{{asset($news->cover)}}" alt="">
                </figure> --}}
                <article class="single-content-wrap">
                   {!! $news->description !!}
                </article>
                <div class="post-socail-wrap mt-5">
                    <h4>Bagikan berita ini melalui</h4>
                    <div class="social-icon-wrap">
                        <div class="social-icon social-facebook">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.detail',[$news->slug])) }}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                        </div>
                        <div class="social-icon social-google">
                            <a href="https://plus.google.com/share?url={{ urlencode(route('news.detail',[$news->slug])) }}" target="_blank">
                                <i class="fab fa-google-plus-g"></i>
                                <span>Google</span>
                            </a>
                        </div>
                        <div class="social-icon social-pinterest">
                            <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(route('news.detail',[$news->slug])) }}" target="_blank">
                                <i class="fab fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </div>
                        <div class="social-icon social-linkedin">
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('news.detail',[$news->slug])) }}" target="_blank">
                                <i class="fab fa-linkedin"></i>
                                <span>Linkedin</span>
                            </a>
                        </div>
                        <div class="social-icon social-twitter">
                            <a href="https://twitter.com/share?url={{ urlencode(route('news.detail',[$news->slug])) }}&text={{ urlencode($news->title) }}" target="_blank">
                                <i class="fab fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- post comment html -->
                <!-- blog post item html end -->
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
                                               <a>{{$news->created_at->locale('id_ID')->isoFormat('D MMMM Y')}}</a>
                                           </span>
                                       </div>
                                   </div>
                               </a>
                           </li>
                        @endforeach
                     </ul>
                   </aside>
                   <aside class="widget widget_social">
                      <h3 class="widget-title">Social share</h3>
                      <div class="social-icon-wrap">
                        <div class="social-icon social-facebook">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('news.detail', $news->slug)) }}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                        </div>
                        <div class="social-icon social-pinterest">
                            <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(route('news.detail', $news->slug)) }}" target="_blank">
                                <i class="fab fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </div>
                        <div class="social-icon social-whatsapp">
                            <a href="https://wa.me/?text={{ urlencode(route('news.detail', $news->slug)) }}" target="_blank">
                                <i class="fab fa-whatsapp"></i>
                                <span>WhatsApp</span>
                            </a>
                        </div>
                        <div class="social-icon social-linkedin">
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('news.detail', $news->slug)) }}" target="_blank">
                                <i class="fab fa-linkedin"></i>
                                <span>Linkedin</span>
                            </a>
                        </div>
                        <div class="social-icon social-twitter">
                            <a href="https://twitter.com/share?url={{ urlencode(route('news.detail', $news->slug)) }}&text={{ urlencode($news->title) }}" target="_blank">
                                <i class="fab fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                        </div>
                        <div class="social-icon social-google">
                            <a href="https://plus.google.com/share?url={{ urlencode(route('news.detail', $news->slug)) }}" target="_blank">
                                <i class="fab fa-google-plus-g"></i>
                                <span>Google</span>
                            </a>
                        </div>
                    </div>
                   </aside>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
