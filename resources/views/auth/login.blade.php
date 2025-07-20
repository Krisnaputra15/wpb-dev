<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="light" data-topbar-color="dark">

<head>
    <meta charset="utf-8" />
    <title>Log In | Brawijaya Job Fair</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('admin/css/style.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/icons.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('admin/js/config.js')}}"></script>
</head>

<body>
    <div>
        <div class="container">
            <div class="row">
                <div class="w-100">
                    <div class="w-50 mx-auto d-block card shadow-lg rounded my-5 overflow-hidden">
                        <div class="p-5">
                            <div class="text-center w-75 mx-auto auth-logo mb-4">
                                <a href="index.html" class="logo-dark">
                                    <span><img src="{{asset('images/wpb-logo-dark.png')}}" alt="" height="100px"></span>
                                </a>

                                <a href="index.html" class="logo-light">
                                    <span><img src="{{asset('images/wpb-logo-light.png')}}" alt="" height="100px"></span>
                                </a>
                            </div>

                            @if(session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <h1 class="h5 mb-1">Selamat Datang!</h1>

                            <p class="text-muted mb-4">Masukkan username dan password untuk mengakses halaman admin</p>

                            <form method="POST" action="{{route('auth.login.process')}}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input class="form-control" type="username" id="username" name="username" required
                                        placeholder="Enter your username">
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <a href="pages-recoverpw.html"
                                        class="text-muted float-end"><small></small></a>
                                    <label class="form-label" for="password">Password</label>
                                    <input class="form-control" type="password" name="password" required id="password"
                                        placeholder="Enter your password">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary w-100" type="submit"> Masuk </button>
                                </div>
                            </form>


                            {{-- <div class="text-center mt-4">
                                <h5 class="text-muted font-size-16">Sign in using</h5>

                                <ul class="list-inline mt-3 mb-0">
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);"
                                            class="social-list-item border border-primary text-primary"><i
                                                class="mdi mdi-facebook"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);"
                                            class="social-list-item border border-danger text-danger"><i
                                                class="mdi mdi-google"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);"
                                            class="social-list-item border border-info text-info"><i
                                                class="mdi mdi-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript: void(0);"
                                            class="social-list-item border border-secondary text-secondary"><i
                                                class="mdi mdi-github"></i></a>
                                    </li>
                                </ul>
                            </div> --}}
                            <!-- end row -->
                        </div> <!-- end .padding-5 -->
                    </div>
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- App js -->
    <script src="{{asset('admin/js/vendor.min.js')}}"></script>
    <script src="{{asset('admin/js/app.js')}}"></script>

</body>

</html>
