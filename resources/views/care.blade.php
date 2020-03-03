@extends('layouts.layout')
@section('css')

<style>

</style>
@stop


@section('content')
<!-- breadcrumb start-->
<section class="breadcrumb breadcrumb_bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb_iner">
                    <div class="breadcrumb_iner_item text-center">
                        <h2>寄養紀錄</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->
<section class="top_place section_padding">
    <div class="container">
        @foreach($pets->chunk(3) as $chunk)
            <div class="row">
                @foreach($chunk as $pet)
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card text-center">
                            <div class="embed-responsive embed-responsive-4by3">
                                <img class="card-img-top embed-responsive-item" src="{{ asset('pet_img/'.$pet->img_url) }}" alt="Card image cap">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title text-center" style="font-weight:bold;"><i class="fa fa-dog" aria-hidden="true"></i> {{ $pet->name }}</h3>
                                <i class="fa fa-map-marker" aria-hidden="true"> {{ \App\City::where('id', $pet->city_id)->value('name') }}</i>
                                <i class="fa fa-user" aria-hidden="true"> {{ $pet->age }}</i>      
                                <p class="card-text text-center mt-2 mb-2">{{ $pet->personality }}</p>
                                <a href="{{ asset('applicant/'.$pet->id) }}" class="btn btn-primary">查看申請者</a>
                            </div>
                            <div class="card-footer text-muted">
                                發布日期：{{ substr($pet->created_at, 0, 10) }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</section>
@endsection


@section('js')
<script>

</script>
@stop