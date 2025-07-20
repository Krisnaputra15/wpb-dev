@extends('template.front')

@section('title')
FAQ
@endsection

@section('content')
<!-- Inner Banner html start-->
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url({{asset($bg->cover)}});">
       <div class="container">
          <div class="inner-banner-content">
             <h1 class="inner-title">FAQ</h1>
          </div>
       </div>
    </div>
    <div class="inner-shape"></div>
 </section>
 <!-- Inner Banner html end-->
 <!-- faq html start -->
 <div class="faq-page-section">
    <div class="container">
       <div class="faq-page-container">
          <div class="row">
             <div class="col-lg-12">
                <div class="faq-content-wrap">
                   <div class="section-heading">
                        <h5 class="dash-style">PERTANYAAN</h5>
                        <h2>PALING SERING DITANYAKAN</h2>
                        <p>
                            Temukan jawaban atas pertanyaan seputar Brawijaya Career Expo! Dari cara pendaftaran, daftar perusahaan peserta, hingga tips sukses mengikuti acara, semua informasi penting tersedia di sini untuk membantumu mempersiapkan diri dengan lebih baik.
                        </p>
                   </div>
                   <div class="accordion" id="accordionOne">
                      @foreach ($faqs as $key => $faq)
                        <div class="card">
                            <div class="card-header" id="heading-{{$key}}">
                                <h4 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-{{$key}}" aria-expanded="true" aria-controls="collapse-{{$key}}">
                                    {{ $faq->title}}
                                    </button>
                                </h4>
                            </div>
                            <div id="collapse-{{$key}}" class="collapse" aria-labelledby="heading-{{$key}}" data-parent="#accordionOne">
                                <div class="card-body">
                                    {{ $faq->description}}
                                </div>
                            </div>
                        </div>
                      @endforeach
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <!-- faq html end -->
@endsection
