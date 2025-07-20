@extends('template.admin')

@section('title')
    Pesan Promosi
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/libs/simplemde/simplemde.min.css') }}">
@endpush

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title mb-0">Kelola Pesan Promosi</h4>
                </div>
                {{-- <div class="col-lg-6">
               <div class="d-none d-lg-block">
                <ol class="breadcrumb m-0 float-end">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Scoxe</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
               </div>
            </div> --}}
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" id="update-form" method="POST"
                            action="{{ route('promotionMessage.update', [$setting->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="message_choice" class="mb-2">Tipe pesan</label>
                                <select name="message_choice" id="message_choice" class="form-select">
                                    <option value="" selected hidden disabled>Pilih tipe pesan</option>
                                    <option value="wa">Whatsapp</option>
                                    <option value="email">Email</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div id="message_template_container">
                                    <label for="" class="mb-2">Template pesan email</label>
                                    <textarea name="message_template" id="message_template" class="editor mb-2" placeholder="Tulis pesan promosi">{!! $setting->message_template !!}</textarea>
                                </div>
                                <div id="wa_message_template_container">
                                    <label for="" class="mb-2">Template pesan whatsapp</label>
                                    <textarea name="wa_message_template" id="wa_message_template" placeholder="Tulis pesan promosi">{{$setting->wa_message_template}}</textarea>
                                </div>
                            </div>
                            @error('message_template')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <div class="my-3 text-center d-flex flex-row justify-content-center gap-2">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                                <a href="{{ route('promotionMessage.sendView') }}" class="btn btn-success">Kirim Pesan</a>
                            </div>

                        </form>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div> <!-- container -->
@endsection

@push('script')
    <script src="{{ asset('admin/libs/simplemde/simplemde.min.js') }}"></script>
    <script>
        function hideTextarea() {
            $('#message_template_container').css({
                visibility: 'hidden',
                height: 0,
                overflow: 'hidden'
            });
            $('#wa_message_template_container').css({
                visibility: 'hidden',
                height: 0,
                overflow: 'hidden'
            });
        }

        hideTextarea();

        $(document).ready(function() {
            var simplemde = new SimpleMDE({
                element: $("#wa_message_template")[0]
            });

            $('#message_choice').change(function() {
                if ($(this).val() == 'wa') {
                    console.log(1)
                    $('#wa_message_template_container').css({
                        visibility: 'visible',
                        height: 'auto'
                    });
                    $('#message_template_container').css({
                        visibility: 'hidden',
                        height: 0,
                        overflow: 'hidden'
                    });
                } else {
                    $('#wa_message_template_container').css({
                        visibility: 'hidden',
                        height: 0,
                        overflow: 'hidden'
                    });
                    $('#message_template_container').css({
                        visibility: 'visible',
                        height: 'auto'
                    });
                }
            });
        })
    </script>
@endpush
