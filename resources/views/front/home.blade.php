@extends('template.front')

@section('title')
Home
@endsection

@section('content')
<!-- Home slider html start -->
<section class="home-slider-section">
    <div class="home-slider">
        <div class="home-banner-items">
            <div class="banner-inner-wrap"
                @if (!empty($galleryLatest))
                    style="background-image: url({{asset($galleryLatest[0]->cover)}});"
                @else
                    style="background-image: url({{asset('images/default-bg.jpg')}});"
                @endif
            ></div>
               <div class="banner-content-wrap">
                  <div class="container">
                     <div class="banner-content text-center">
                        <h2 class="banner-title">Mulai Karirmu dari Sini!</h2>
                        <p>Brawijaya Career Expo adalah kesempatan emas bagi para pencari kerja, fresh graduate, dan profesional muda untuk menemukan peluang karir terbaik dari berbagai perusahaan terkemuka.</p>
                        <a href="#" class="button-primary">CONTINUE READING</a>
                     </div>
                  </div>
               </div>
            <div class="overlay"></div>
         </div>
       <div class="home-banner-items">
          <div class="banner-inner-wrap"
            @if (!empty($galleryLatest))
                style="background-image: url({{asset($galleryLatest[0]->cover)}});"
            @else
                style="background-image: url({{asset('images/default-bg.jpg')}});"
            @endif
          ></div>
             <div class="banner-content-wrap">
                <div class="container">
                   <div class="banner-content text-center">
                      <h2 class="banner-title">Mulai Karirmu dari Sini!</h2>
                      <p>Brawijaya Career Expo menghadirkan beragam industri, mulai dari teknologi, perbankan, manufaktur, hingga startup inovatif yang siap membuka pintu bagi talenta berbakat seperti Anda!</p>
                      <a href="#" class="button-primary">CONTINUE READING</a>
                   </div>
                </div>
             </div>
          <div class="overlay"></div>
       </div>
    </div>
 </section>
 <!-- slider html start -->
 <!-- Home search field html start -->
 <div class="trip-search-section shape-search-section">
    <div class="slider-shape"></div>
    <div class="container">
       <div class="trip-search-inner white-bg d-flex w-100">
          <div class="input-group" style="width: 40% !important">
             <label> Tanggal Awal* </label>
             <i class="far fa-calendar"></i>
             <input class="input-date-picker" type="text" name="s" placeholder="MM / DD / YY" autocomplete="off" readonly="readonly">
          </div>
          <div class="input-group" style="width: 40% !important">
             <label> Tanggal Akhir* </label>
             <i class="far fa-calendar"></i>
             <input class="input-date-picker" type="text" name="s" placeholder="MM / DD / YY" autocomplete="off" readonly="readonly">
          </div>
          <div class="input-group" style="width: 20% !important">
             <label class="screen-reader-text"> Cari Agenda </label>
             <input type="submit" name="travel-search" value="Cari Agenda">
          </div>
       </div>
    </div>
 </div>
 <!-- Home activity section html start -->
 <section class="activity-section">
    <div class="container">
       <div class="section-heading text-center">
          <div class="row">
             <div class="col-lg-8 offset-lg-2">
                <h5 class="dash-style">Kenapa harus ikut Brawijaya Career Expo?</h5>
                <h2>BERAGAM KEGIATAN DALAM SATU ACARA </h2>
                <p>Dengan banyaknya kegiatan yang tersedia, kamu bisa langsung bertemu dengan recruiter perusahaan ternama, mengikuti sesi wawancara di tempat, serta mendapatkan wawasan berharga dari seminar dan workshop eksklusif. Ini adalah kesempatan terbaik untuk memperluas jaringan profesional dan menemukan karir impianmu dalam satu acara!</p>
             </div>
          </div>
       </div>
       <div class="activity-inner row d-flex flex-row justify-content-center">
          <div class="col-lg-2 col-md-4 col-sm-6">
             <div class="activity-item">
                <div class="activity-icon">
                   <a href="#">
                      <img src="{{asset('home/images/icon6.png')}}" alt="">
                   </a>
                </div>
                <div class="activity-content">
                   <h4>
                      <a href="#">Pameran Karir</a>
                   </h4>
                </div>
             </div>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
             <div class="activity-item">
                <div class="activity-icon">
                   <a href="#">
                      <img src="{{asset('home/images/icon10.png')}}" alt="">
                   </a>
                </div>
                <div class="activity-content">
                   <h4>
                      <a href="#">Beasiswa Studi</a>
                   </h4>
                </div>
             </div>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
             <div class="activity-item">
                <div class="activity-icon">
                   <a href="#">
                      <img src="{{asset('home/images/icon9.png')}}" alt="">
                   </a>
                </div>
                <div class="activity-content">
                   <h4>
                      <a href="#">Seminar Karir</a>
                   </h4>
                </div>
             </div>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
             <div class="activity-item">
                <div class="activity-icon">
                   <a href="#">
                      <img src="{{asset('home/images/icon8.png')}}" alt="">
                   </a>
                </div>
                <div class="activity-content">
                   <h4>
                      <a href="#">Konsultasi Karir</a>
                   </h4>
                </div>
             </div>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
             <div class="activity-item">
                <div class="activity-icon">
                   <a href="#">
                      <img src="{{asset('home/images/icon7.png')}}" alt="">
                   </a>
                </div>
                <div class="activity-content">
                   <h4>
                      <a href="#">Bazaar</a>
                   </h4>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <!-- activity html end -->
 <!-- search search field html end -->
 <section class="destination-section">
    <div class="container">
       <div class="section-heading">
          <div class="row align-items-end">
             <div class="col-lg-7">
                <h5 class="dash-style">AGENDA</h5>
                <h2>AGENDA TERBARU</h2>
             </div>
             <div class="col-lg-5">
                <div class="section-disc">
                    Brawijaya Career Expo hadir dengan agenda terbaru yang semakin menarik dan bermanfaat bagi para pencari kerja.
                </div>
             </div>
          </div>
       </div>
       <div class="destination-inner destination-three-column">
          <div class="row">
             <div class="col-12">
                <div class="row d-flex justify-content-center">
                   @foreach ($latestAgenda as $agenda)
                   <div class="col-sm-3">
                        <div class="desti-item overlay-desti-item">
                        <figure class="desti-image">
                            <img src="{{asset($agenda['cover'])}}" alt="">
                        </figure>
                        <div class="desti-content">
                            <h3>
                                <a href="{{route('agenda.detail', [$agenda['slug']])}}">{{$agenda['name']}}</a>
                            </h3>
                            <div class="d-flex flex-row justify-content-center">
                                <a href="{{route('agenda.detail', [$agenda['slug']])}}" class="button-primary">Lihat Detail</a>
                            </div>
                        </div>
                        </div>
                    </div>
                   @endforeach
                </div>
             </div>
          <div class="btn-wrap text-center">
             <a href="#" class="button-primary">LIHAT LEBIH BANYAK</a>
          </div>
       </div>
    </div>
 </section>
 <!-- Home blog section html start -->
 <section class="blog-section pt-0">
     <div class="container">
        <div class="section-heading text-center">
           <div class="row">
              <div class="col-lg-8 offset-lg-2">
                 <h5 class="dash-style">BERITA TERBARU</h5>
                 <h2>BERITA TERBARU</h2>
                 <p>Cek berita terbaru mengenai Brawijaya Career Expo dan DPKA agar tidak ketinggalan informasi mengenai lowongan pekerjaan</p>
              </div>
           </div>
        </div>
        <div class="row d-flex justify-content-center">
           @foreach ($latestNews as $news)
           <div class="col-md-6 col-lg-4">
                <article class="post h-100">
                    <figure class="feature-image">
                        <a href="{{route('news.detail',[$news['slug']])}}">
                            <img src="{{asset($news['cover'])}}" class="cover" alt="">
                        </a>
                    </figure>
                    <div class="entry-content h-100">
                        <h3>
                            <a href="{{route('news.detail',[$news['slug']])}}">{{$news['title']}}</a>
                        </h3>
                        <div class="entry-meta">
                            <span class="byline">
                                <a href="#">Oleh DPKA UB</a>
                            </span>
                            <span class="posted-on">
                                <a href="{{route('news.detail',[$news['slug']])}}">{{$news['created_at']->locale('id_ID')->isoFormat('D MMMM Y')}}</a>
                            </span>
                        </div>
                    </div>
                </article>
            </div>
           @endforeach
        </div>
        <div class="btn-wrap text-center d-flex justify-content-center">
            <a href="{{route('news')}}" class="button-primary">LIHAT LEBIH BANYAK</a>
         </div>
     </div>
  </section>
   <!-- blog html end -->
 <!-- Home special section html start -->
 <section class="best-section">
    <div class="container">
       <div class="row">
          <div class="col-lg-5">
             <div class="section-heading">
                <h5 class="dash-style">GALERI TERBARU</h5>
                <h2>DOKUMENTASI </h2>
                <p>Lihat momen terbaik dari Brawijaya Career Expo! Dari antusiasme para peserta hingga interaksi langsung dengan perusahaan ternama, semua terekam dalam dokumentasi eksklusif kami. </p>
             </div>
             @if (count($galleryLatest) > 0)
                <figure class="gallery-img">
                    <img src="{{asset($galleryLatest[0]->cover)}}" alt="">
                </figure>
             @endif
          </div>
          <div class="col-lg-7">
             <div class="row">
                @if (count($galleryLatest) > 2)
                <div class="col-sm-6">
                   <figure class="gallery-img">
                      <img src="{{asset($galleryLatest[1]->cover)}}" alt="">
                   </figure>
                </div>
                @endif
                @if (count($galleryLatest) > 3)
                <div class="col-sm-6">
                   <figure class="gallery-img">
                      <img src="{{asset($galleryLatest[2]->cover)}}" alt="">
                   </figure>
                </div>
                @endif
             </div>
             @if (count($galleryLatest) > 2)
             <div class="row">
                <div class="col-12">
                   <figure class="gallery-img">
                      <img src="{{asset($galleryLatest[3]->cover)}}" alt="">
                   </figure>
                </div>
             </div>
             @endif
          </div>
       </div>
    </div>
 </section>
 <!-- best html end -->
@endsection
