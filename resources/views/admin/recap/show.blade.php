@extends('template.admin')

@section('title')
    Rekapitulasi
@endsection

@push('style')
@endpush

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="py-3 py-lg-4">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="page-title mb-0">Detail Rekapitulasi</h3>
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

        <div class="row" id="receiverList-row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row gap-2 mb-3">
                            <div class="d-flex flex-column gap-2">
                                <h5>Nama Agenda</h5>
                                <h5>Nama Perusahaan</h5>
                                <h5>Status Transaksi</h5>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <h5>: {{$transaction['agenda_name']}}</h5>
                                <h5>: {{$transaction['company_name']}}</h5>
                                <h5>: {{ucwords($transaction['status'])}}</h5>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4 mb-3">
                            <h4 class="card-title my-auto">Link Rekapitulasi Pelamar</h4>
                        </div>
                        <div class="accordion" id="pelamar-accordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header border border-2 rounded" id="pelamar-heading">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pelamar-collapse"
                                        aria-expanded="false" aria-controls="pelamar-collapse">
                                        Lihat Rekapitulasi
                                    </button>
                                </h2>
                                <div id="pelamar-collapse" class="accordion-collapse collapse" aria-labelledby="pelamar-heading"
                                    data-bs-parent="#pelamar-accordion">
                                    <div class="accordion-body px-1">
                                        @if($transaction['applicant_recap_link'] == null)
                                        <h4 class="text-center">Tidak ada link rekapitulasi pelamar</h4>
                                        @else
                                            <ol class="list-group list-group-numbered">
                                                @foreach ($transaction['applicant_recap_link'] as $link)
                                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">
                                                                <a href="{{$link}}" target="_blank" class="text-primary">{{$link}} <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                            <h4 class="card-title my-auto">Link Dokumentasi</h4>
                        </div>
                        <div class="accordion" id="dokumentasi-accordion">
                            <div class="accordion-item border-0">
                                <h2 class="accordion-header border border-2 rounded" id="heading-dokumentasi">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dokumentasi-collapse"
                                        aria-expanded="false" aria-controls="dokumentasi-collapse">
                                          Lihat Link Dokumentasi
                                    </button>
                                </h2>
                                <div id="dokumentasi-collapse" class="accordion-collapse collapse" aria-labelledby="heading-dokumentasi"
                                    data-bs-parent="#dokumentasi-accordion">
                                    <div class="accordion-body px-1">
                                        @if($transaction['documentation_link'] == null)
                                        <h4 class="text-center">Tidak ada link dokumentasi agenda</h4>
                                        @else
                                            <ol class="list-group list-group-numbered">
                                                @foreach ($transaction['documentation_link'] as $link)
                                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">
                                                                <a href="{{$link}}" target="_blank" class="text-primary">{{$link}} <i class="fa-solid fa-up-right-from-square ms-2"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-3">
                            @if(auth()->user()->role == 'humas')
                                <button class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#documentation_link-modal">Ubah Link Dokumentasi</button>
                                <div id="documentation_link-modal" class="modal modal-lg fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Ubah Link Dokumentasi Tersimpan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="px-3" id="documentation_link-form" method="POST" action="{{route('recap.update', [$transaction['id']])}}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="mb-3" data-type="article" id="documentation_link-container">
                                                        <label for="documentation_link" class="form-label">Link Dokumentasi <small class="text-danger">*</small></label>
                                                        @if ($transaction['documentation_link'] == null)
                                                            <div class="link-container row align-items-center mb-1">
                                                                <div class="col-md-10">
                                                                    <input class="form-control" type="text" id="documentation_link" name="documentation_link[]"
                                                                        placeholder="Masukkan link GDrive dokumentasi selama acara" required>
                                                                </div>
                                                                <div class="col-md-2 text-start">
                                                                    <button type="button" class="btn btn-block w-100 add-link-btn btn-success fw-bold">+</button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            @foreach ($transaction['documentation_link'] as $key => $link)
                                                                    <div class="link-container{{$key > 0 ? '-generated' : ''}} row align-items-center mb-1">
                                                                        <div class="col-md-10">
                                                                            <input class="form-control" type="text" id="documentation_link" name="documentation_link[]"
                                                                                placeholder="Masukkan link GDrive dokumentasi selama acara" value="{{$link}}" required>
                                                                        </div>
                                                                        <div class="col-md-2 text-start {{$key > 0 ? 'd-flex justify-content-between' : ''}}">
                                                                            <button type="button" class="btn {{$key > 0 ? 'w-45' : 'btn-block w-100'}} add-link-btn btn-success fw-bold">+</button>
                                                                            @if ($key > 0)
                                                                                <button type="button" class="btn btn-danger fw-bold w-45 remove-link-btn">-</button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                            @endforeach
                                                        @endif
                                                        <small class="text-danger error" id="video_linkError"></small>
                                                    </div>

                                                    <div class="mb-3 text-center">
                                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            @endif
                            @if(auth()->user()->role == 'perwakilan-perusahaan')
                                <button class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#applicant_recap_link-modal">Ubah Link Rekapitulasi Pelamar</button>
                                <div id="applicant_recap_link-modal" class="modal modal-lg fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Ubah Link Rekapitulasi Pelamar Tersimpan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="px-3" id="applicant_recap_link-form" method="POST" action="{{route('recap.update', [$transaction['id']])}}">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="mb-3" data-type="article" id="applicant_recap_link-container">
                                                        <label for="applicant_recap_link" class="form-label">Link Rekapitulasi Pelamar <small class="text-danger">*</small></label>
                                                        @if ($transaction['applicant_recap_link'] == null)
                                                            <div class="link-container row align-items-center mb-1">
                                                                <div class="col-md-10">
                                                                    <input class="form-control" type="text" id="applicant_recap_link" name="applicant_recap_link[]"
                                                                        placeholder="Masukkan link GDrive rekapitulasi pelamar selama acara" required>
                                                                </div>
                                                                <div class="col-md-2 text-start">
                                                                    <button type="button" class="btn btn-block w-100 add-link-btn btn-success fw-bold">+</button>
                                                                </div>
                                                            </div>
                                                        @else
                                                            @foreach ($transaction['applicant_recap_link'] as $key => $link)
                                                                    <div class="link-container{{$key > 0 ? '-generated' : ''}} row align-items-center mb-1">
                                                                        <div class="col-md-10">
                                                                            <input class="form-control" type="text" id="applicant_recap_link" name="applicant_recap_link[]"
                                                                                placeholder="Masukkan link GDrive rekapitulasi pelamar selama acara" value="{{$link}}" required>
                                                                        </div>
                                                                        <div class="col-md-2 text-start {{$key > 0 ? 'd-flex justify-content-between' : ''}}">
                                                                            <button type="button" class="btn {{$key > 0 ? 'w-45' : 'btn-block w-100'}} add-link-btn btn-success fw-bold">+</button>
                                                                            @if ($key > 0)
                                                                                <button type="button" class="btn btn-danger fw-bold w-45 remove-link-btn">-</button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                            @endforeach
                                                        @endif
                                                        <small class="text-danger error" id="video_linkError"></small>
                                                    </div>

                                                    <div class="mb-3 text-center">
                                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                                    </div>

                                                </form>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            @endif
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>

    </div> <!-- container -->
@endsection

@push('script')
<script>
    const link_name = @json(auth()->user()->role == 'humas' ? 'documentation_link' : 'applicant_recap_link');
    const label = {
        'documentation_link' : 'link GDrive dokumentasi',
        'applicant_recap_link' : 'link GDrive rekapitulasi pelamar'
    }
    $(document).ready(function () {
        $('#'+link_name+'-container').on('click','.add-link-btn',function() {
            $('#'+link_name+'-container').append(`<div class="link-container-generated mb-1 row align-items-center">
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" id="${link_name}" name="${link_name}[]"
                                                            placeholder="Masukkan ${label[link_name]} selama acara" required>
                                                </div>
                                                <div class="col-md-2 text-start d-flex justify-content-between">
                                                    <button type="button" class="btn btn-success fw-bold w-45 add-link-btn">+</button>
                                                    <button type="button" class="btn btn-danger fw-bold w-45 remove-link-btn">-</button>
                                                </div>
                                            </div>`);
        });
        $('#'+link_name+'-container').on('click', '.remove-link-btn', function() {
            $(this).closest('.link-container-generated').remove();
        });

        $(`#${link_name}-form button[type="submit"]`).on('click', function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Loading',
                text: 'Data sedang diproses',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $(`#${link_name}-form`).submit();
        });
    })
</script>
@endpush
