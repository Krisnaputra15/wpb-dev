@extends('template.front')

@section('title')
Agenda
@endsection

@section('content')
<!-- Inner Banner html start-->
<section class="inner-banner-wrap">
    <div class="inner-baner-container" style="background-image: url({{asset($bg->cover)}});">
       <div class="container">
          <div class="inner-banner-content">
             <h1 class="inner-title">Agenda</h1>
          </div>
       </div>
    </div>
    <div class="inner-shape"></div>
 </section>
 <!-- Inner Banner html end-->
 <!-- destination field html end -->
 <section class="destination-section destination-page">
    <div class="container">
       <div class="destination-inner destination-three-column">
          <div class="row">
            @foreach ($agendas as $agenda)
                <div class="col-sm-6 col-lg-4">
                    <div class="desti-item overlay-desti-item">
                        <figure class="desti-image">
                            <img src="{{asset('storage/'.$agenda->cover)}}" alt="">
                        </figure>
                        @if ($agenda->start_date < date('Y-m-d'))
                            <div class="meta-cat bg-meta-cat">
                                <a href="#">SELESAI</a>
                            </div>
                        @endif
                        @if ($agenda->start_date = date('Y-m-d'))
                            <div class="meta-cat bg-meta-cat">
                                <a href="#">BERLANGSUNG</a>
                            </div>
                        @endif
                        @if ($agenda->start_date > date('Y-m-d'))
                            <div class="meta-cat bg-meta-cat">
                                <a href="#">BELUM DIMULAI</a>
                            </div>
                        @endif
                        <div class="desti-content">
                            <h3>
                                <a href="{{route('agenda.detail', [$agenda->slug])}}">{{$agenda->name}}</a>
                            </h3>
                            <h4 class="text-white">{{$agenda->start_date->locale('id_ID')->isoFormat('D MMMM Y')}}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
          </div>
       </div>
    </div>
 </section>
 <!-- destination section html start -->
@endsection
