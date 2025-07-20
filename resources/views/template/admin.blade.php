<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="light" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Brawijaya Job Fair</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}">

    <link href="{{asset('admin/libs/morris.js/morris.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('admin/css/style.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/icons.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Sweet Alert-->
    <link href="{{asset('admin/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

    {{-- toastr --}}
    <link href="{{asset('vendor/flasher/toastr.min.css')}}" rel="stylesheet" type="text/css">

    <!-- select2 -->
    <link href="{{asset('admin/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/libs/selectize/css/selectize.bootstrap3.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('style.css')}}">
    <script src="{{asset('admin/js/config.js')}}"></script>
    <script src="{{asset('admin/libs/aframe/aframe.min.js')}}"></script>
    @stack('style')
</head>

<body>
    @php
        $user = auth()->user();
    @endphp
    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
        <div class="main-menu">
            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="index.html" class="logo-light">
                    <img src="{{asset('images/wpb-logo-light.png')}}" alt="logo" class="logo-lg" height="100">
                    <img src="{{asset('images/wpb-logo-light.png')}}" alt="small logo" class="logo-sm" height="100">
                </a>

                <!-- Brand Logo Dark -->
                <a href="index.html" class="logo-dark">
                    <img src="{{asset('images/wpb-logo-dark.png')}}" alt="dark logo" class="logo-lg" height="100">
                    <img src="{{asset('images/wpb-logo-dark.png')}}" alt="small logo" class="logo-sm" height="100">
                </a>
            </div>

            <!--- Menu -->
            <div data-simplebar>
                <ul class="app-menu">
                    <li class="menu-item">
                        <a href="{{route('dashboard')}}" class="menu-link waves-effect">
                            <span class="menu-icon"><i data-lucide="home "></i></span>
                            <span class="menu-text"> Dashboard </span>
                        </a>
                    </li>
                    @if(auth()->user()->role == 'administrator')
                        <li class="menu-item">
                            <a href="{{route('account.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="user "></i></span>
                                <span class="menu-text"> Akun </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('registrationInput.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="file-text "></i></span>
                                <span class="menu-text"> Form Data Perusahaan </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('booth.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="archive "></i></span>
                                <span class="menu-text"> Booth </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('layout.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="square "></i></span>
                                <span class="menu-text"> Layout </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('setting.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="settings "></i></span>
                                <span class="menu-text"> Pengaturan </span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->role == 'humas')
                        <li class="menu-item">
                            <a href="{{route('companyContact.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="users "></i></span>
                                <span class="menu-text"> Kontak Perusahaan </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('promotionMessage.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="mail "></i></span>
                                <span class="menu-text"> Pesan Promosi </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('agenda.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="calendar"></i></span>
                                <span class="menu-text"> Agenda </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('boothTransaction.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="dollar-sign "></i></span>
                                <span class="menu-text"> Transaksi Booth </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('recap.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="file-text "></i></span>
                                <span class="menu-text"> Rekapitulasi Kegiatan </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('content.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="file-text"></i></span>
                                <span class="menu-text"> Konten </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('setting.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="settings "></i></span>
                                <span class="menu-text"> Pengaturan </span>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->role == 'perwakilan-perusahaan')
                        <li class="menu-item">
                            <a href="{{route('profile.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="user"></i></span>
                                <span class="menu-text"> Profil </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('boothOrder.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="credit-card"></i></span>
                                <span class="menu-text"> Pemesanan Booth </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('boothTransaction.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="dollar-sign"></i></span>
                                <span class="menu-text"> Transaksi Booth </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('recap.index')}}" class="menu-link waves-effect">
                                <span class="menu-icon"><i data-lucide="file-text "></i></span>
                                <span class="menu-text"> Rekapitulasi Kegiatan </span>
                            </a>
                        </li>
                    @endif

                    {{-- <li class="menu-title">Menu</li> --}}


                </ul>

                {{-- <div class="help-box">
                    <h5 class="text-muted font-size-15 mb-3">For Help &amp; Support</h5>
                    <p class="font-size-13"><span class="font-weight-bold">Email:</span> <br> info@domain.com</p>
                    <p class="mb-0 font-size-13"><span class="font-weight-bold">Call:</span> <br> (+123) 123 456 789</p>
                </div> --}}
            </div>
        </div>



        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
            <div class="navbar-custom">
                <div class="topbar">
                    <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

                        <!-- Brand Logo -->
                        <div class="logo-box">
                            <!-- Brand Logo Light -->
                            <a href="index.html" class="logo-light">
                                <img src="{{asset('images/wpb-logo-light.png')}}" alt="logo" class="logo-lg" height="32">
                                <img src="{{asset('images/wpb-logo-light.png')}}" alt="small logo" class="logo-sm" height="32">
                            </a>

                            <!-- Brand Logo Dark -->
                            <a href="index.html" class="logo-dark">
                                <img src="{{asset('images/wpb-logo-dark.png')}}" alt="dark logo" class="logo-lg" height="32">
                                <img src="{{asset('images/wpb-logo-dark.png')}}" alt="small logo" class="logo-sm" height="32">
                            </a>
                        </div>

                        <!-- Sidebar Menu Toggle Button -->
                        <button class="button-toggle-menu waves-effect waves-light rounded-circle">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </div>

                    <ul class="topbar-menu d-flex align-items-center gap-2">

                        <li class="d-none d-md-inline-block">
                            <a class="nav-link waves-effect waves-light" href="#" data-bs-toggle="fullscreen">
                                <i class="mdi mdi-fullscreen font-size-24"></i>
                            </a>
                        </li>

                        <li class="nav-link waves-effect waves-light" id="theme-mode">
                            <i class="bx bx-moon font-size-24"></i>
                        </li>

                        <li class="dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                                href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <div class="border border-1 rounded-circle p-1">
                                    <i class="font-size-20" data-lucide="user"></i>
                                </div>
                                {{-- <img src="admin/images/users/avatar-3.jpg" alt="user-image" class="rounded-circle"> --}}
                                <span class="ms-1 d-none d-md-inline-block">
                                    {{$user->username}} <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Selamat datang !</h6>
                                </div>

                                <!-- item-->
                                <a href="{{route('profile.index')}}" class="dropdown-item notify-item">
                                    <i data-lucide="user" class="font-size-16 me-2"></i>
                                    <span>Akun Saya</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="{{route('auth.logout')}}" class="dropdown-item notify-item">
                                    <i data-lucide="log-out" class="font-size-16 me-2"></i>
                                    <span>Logout</span>
                                </a>

                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- ========== Topbar End ========== -->

            <div class="px-3">

            @yield('content')

            </div> <!-- content -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- App js -->
    <script src="{{asset('admin/js/vendor.min.js')}}"></script>
    <script src="{{asset('admin/js/app.js')}}"></script>

    <!-- Jquery Sparkline Chart  -->
    <script src="{{asset('admin/libs/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Jquery-knob Chart Js-->
    <script src="{{asset('admin/libs/jquery-knob/jquery.knob.min.js')}}"></script>

    <script src="https://kit.fontawesome.com/0cf4c39c1c.js" crossorigin="anonymous"></script>

    {{-- toastr --}}
    <script src="{{asset('vendor/flasher/toastr.min.js')}}"></script>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    <!-- Morris Chart Js-->
    <script src="{{asset('admin/libs/morris.js/morris.min.js')}}"></script>

    <script src="{{asset('admin/libs/raphael/raphael.min.js')}}"></script>

    <!-- Dashboard init-->
    <script src="{{asset('admin/js/pages/dashboard.js')}}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{asset('admin/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>

    <!-- Tinymce -->
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

    <!-- select2 -->
    <script src="{{asset('admin/libs/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('app.js')}}"></script>

    @stack('script')
</body>

</html>
