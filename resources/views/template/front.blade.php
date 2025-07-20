<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- favicon -->
      <link rel="icon" type="image/png" href="{{asset('home/images/favicon.png')}}">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{asset('home/vendors/bootstrap/css/bootstrap.min.css')}}" media="all">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/vendors/fontawesome/css/all.min.css')}}">
      <!-- jquery-ui css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/vendors/jquery-ui/jquery-ui.min.css')}}">
      <!-- modal video css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/vendors/modal-video/modal-video.min.css')}}">
      <!-- light box css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/vendors/lightbox/dist/css/lightbox.min.css')}}">
      <!-- slick slider css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/vendors/slick/slick.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('home/vendors/slick/slick-theme.css')}}">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/style.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">
      <title>@yield('title') | Brawijaya Career Expo </title>
   </head>
   <body class="home">
      <div id="siteLoader" class="site-loader">
         <div class="preloader-content">
            <img src="{{asset('home/images/loader1.gif')}}" alt="">
         </div>
      </div>
      <div id="page" class="full-page">
         <header id="masthead" class="site-header header-primary">
            <!-- header html start -->
            <div class="top-header">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-8 d-none d-lg-block">
                        <div class="header-contact-info">
                           <ul>
                              <li>
                                 <a href="#" target="_blank"><i class="fas fa-phone-alt"></i> (0341) 583787</a>
                              </li>
                              <li>
                                 <a href="mailto:jpc@ub.ac.id"><i class="fas fa-envelope" target="_blank"></i> jpc@ub.ac.id</a>
                              </li>
                              <li>
                                  <a href="https://maps.app.goo.gl/ugXxmXGoH9ATdtsR6" target="_blank"><i class="fas fa-map-marker-alt"></i> Gedung JPC/DPKA Universitas Brawijaya</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-lg-4 d-flex justify-content-lg-end justify-content-between">
                        <div class="header-social social-links">
                           <ul>
                              <li><a href="https://www.facebook.com/karier.ub/" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                              <li><a href="https://x.com/karir_ub/" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                              <li><a href="https://www.instagram.com/karir_ub/?hl=en" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                              <li><a href="https://www.linkedin.com/company/dpka-ub?originalSubdomain=id" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="bottom-header">
               <div class="container d-flex justify-content-between align-items-center">
                  <div class="site-identity">
                     <h1 class="site-title">
                        <a href="index.html">
                           <img class="white-logo" src="{{asset('images/wpb-logo-light.png')}}" alt="logo">
                           <img class="black-logo" src="{{asset('images/wpb-logo-dark.png')}}" alt="logo">
                        </a>
                     </h1>
                  </div>
                  <div class="main-navigation d-none d-lg-block">
                     <nav id="navigation" class="navigation">
                        <ul>
                           <li class="menu-item">
                                <a href="{{route('home')}}">Home</a>
                           </li>
                           <li class="menu-item">
                                <a href="{{route('agenda')}}">Agenda</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('news')}}">Berita</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('faq')}}">FAQ</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('gallery')}}">Galeri</a>
                            </li>
                        </ul>
                     </nav>
                  </div>
                  <div class="header-btn">
                     <a href="{{route('auth.login.view')}}" class="button-primary">Login</a>
                  </div>
               </div>
            </div>
            <div class="mobile-menu-container"></div>
         </header>
         <main id="content" class="site-main">
            @yield('content')
         </main>
         <footer id="colophon" class="site-footer footer-primary">
            <div class="top-footer">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-4 col-md-6">
                        <aside class="widget widget_text">
                           <h3 class="widget-title">
                              Tentang Brawijaya Career Expo
                           </h3>
                           <div class="textwidget widget-text">
                              Brawijaya Career Expo adalah acara yang diselenggarakan oleh Universitas Brawijaya (UB) untuk mempersiapkan mahasiswa dalam menghadapi dunia kerja.
                           </div>
                        </aside>
                     </div>
                     <div class="col-lg-4 col-md-6">
                        <aside class="widget widget_text">
                           <h3 class="widget-title">informasi kontak</h3>
                           <div class="textwidget widget-text">
                              Hubungi kontak berikut untuk mendapatkan informasi lebih lanjut.
                              <ul>
                                 <li>
                                    <a href="#">
                                       <i class="fas fa-phone-alt"></i>
                                       (0341) 583787
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#">
                                       <i class="fas fa-envelope"></i>
                                       jpc@ub.ac.id
                                    </a>
                                 </li>
                                 <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    Universitas Brawijaya, Gedung JPC/DPKA, Jl. Veteran, Ketawanggede, Lowokwaru, Kota Malang
                                 </li>
                              </ul>
                           </div>
                        </aside>
                     </div>
                     <div class="col-lg-4 col-md-6">
                        <aside class="widget widget_recent_post">
                           <h3 class="widget-title">Pranala Terkait</h3>
                           <ul>
                                <li class="mb-0 py-2">
                                    <h5>
                                    <a href="https://www.ub.ac.id/en/" target="_blank">UB Official</a>
                                    </h5>
                                </li>
                                <li class="mb-0 py-2">
                                    <h5>
                                        <a href="https://dpka.ub.ac.id/id/" target="_blank">DPKA UB</a>
                                    </h5>
                                </li>
                                <li class="mb-0 py-2">
                                    <h5>
                                       <a href="https://prasetya.ub.ac.id" target="_blank">Prasetya UB</a>
                                    </h5>
                                </li>
                                <li class="mb-0 py-2">
                                    <h5>
                                       <a href="https://ub-care.ub.ac.id" target="_blank">UB Care</a>
                                    </h5>
                                </li>
                           </ul>
                        </aside>
                     </div>
                  </div>
               </div>
            </div>
            <div class="buttom-footer">
               <div class="container">
                  <div class="row align-items-center d-flex justify-content-center">
                     <div class="col-md-5 text-center">
                        <h4 class="text-center text-light">Managed with 🤍 by DPKA UB</h4>
                     </div>
                  </div>
               </div>
            </div>
         </footer>
         <a id="backTotop" href="#" class="to-top-icon">
            <i class="fas fa-chevron-up"></i>
         </a>
         <!-- custom search field html -->
            <div class="header-search-form">
               <div class="container">
                  <div class="header-search-container">
                     <form class="search-form" role="search" method="get" >
                        <input type="text" name="s" placeholder="Enter your text...">
                     </form>
                     <a href="#" class="search-close">
                        <i class="fas fa-times"></i>
                     </a>
                  </div>
               </div>
            </div>
         <!-- header html end -->
      </div>

      <!-- JavaScript -->
      <script src="{{asset('home/js/jquery.js')}}"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
      <script src="{{asset('home/vendors/bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('home/vendors/jquery-ui/jquery-ui.min.js')}}"></script>
      <script src="{{asset('home/vendors/countdown-date-loop-counter/loopcounter.js')}}"></script>
      <script src="{{asset('home/js/jquery.counterup.js')}}"></script>
      <script src="{{asset('home/vendors/modal-video/jquery-modal-video.min.js')}}"></script>
      <script src="{{asset('home/vendors/masonry/masonry.pkgd.min.js')}}"></script>
      <script src="{{asset('home/vendors/lightbox/dist/js/lightbox.min.js')}}"></script>
      <script src="{{asset('home/vendors/slick/slick.min.js')}}"></script>
      <script src="{{asset('home/js/jquery.slicknav.js')}}"></script>
      <script src="{{asset('home/js/custom.min.js')}}"></script>

      @stack('script')
   </body>
</html>
