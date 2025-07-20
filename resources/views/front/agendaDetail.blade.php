@extends('template.front')

@section('title')
{{$agenda->name}}
@endsection

@section('content')
<!-- Inner Banner html start-->
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url('{{asset("storage/".$agenda->cover)}}');">
       <div class="container">
          <div class="inner-banner-content">
             <h1 class="inner-title">{{$agenda->name}}</h1>
             <div class="entry-meta">
                <span class="posted-on">
                   <a href="#">{{$agenda->start_date->locale('id_ID')->isoFormat('D MMMM Y')}}</a>
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
             <div class="col-12 primary right-sidebar">
                <!-- single blog post html start -->
                {{-- <figure class="feature-image">
                   <img src="{{asset($agenda->cover)}}" alt="">
                </figure> --}}
                <article class="single-content-wrap">
                   {!! $agenda->description !!}
                </article>
                <div class="post-socail-wrap mt-5">
                    <h4>Bagikan agenda ini melalui</h4>
                    <div class="social-icon-wrap">
                        <div class="social-icon social-facebook">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('agenda.detail',[$agenda->slug])) }}" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                                <span>Facebook</span>
                            </a>
                        </div>
                        <div class="social-icon social-google">
                            <a href="https://plus.google.com/share?url={{ urlencode(route('agenda.detail',[$agenda->slug])) }}" target="_blank">
                                <i class="fab fa-google-plus-g"></i>
                                <span>Google</span>
                            </a>
                        </div>
                        <div class="social-icon social-pinterest">
                            <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(route('agenda.detail',[$agenda->slug])) }}" target="_blank">
                                <i class="fab fa-pinterest"></i>
                                <span>Pinterest</span>
                            </a>
                        </div>
                        <div class="social-icon social-linkedin">
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('agenda.detail',[$agenda->slug])) }}" target="_blank">
                                <i class="fab fa-linkedin"></i>
                                <span>Linkedin</span>
                            </a>
                        </div>
                        <div class="social-icon social-twitter">
                            <a href="https://twitter.com/share?url={{ urlencode(route('agenda.detail',[$agenda->slug])) }}&text={{ urlencode($agenda->title) }}" target="_blank">
                                <i class="fab fa-twitter"></i>
                                <span>Twitter</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- post comment html -->
                <!-- blog post item html end -->
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
