@extends('layouts.layout')
@section('css')

<style>
    .foster:disabled {
        background-color: red;
        border-color: red;
    }
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
                        <h2>申請/託管紀錄</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->
<section class="top_place section_padding">
    <div class="container">
<!--
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="section_tittle text-center">
                    <h2>Top Places to visit</h2>
                    <p>Waters make fish every without firmament saw had. Morning air subdue. Our. Air very one. Whales grass is fish whales winged.</p>
                </div>
            </div>
        </div>
-->
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
                                @if($pet->is_foster == 1)
                                    <button data-id="{{ $pet->id }}"class="btn btn-primary foster-pet foster" disabled>您託管的孩子</button>
                                @elseif($pet->is_foster == 0)
                                    <button data-id="{{ $pet->id }}" class="btn btn-primary care-pet cancel-foster">取消申請</button>
                                @else
                                    <button data-id="{{ $pet->id }}" class="btn btn-primary care-pet" disabled>已被託管</button>
                                @endif
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
    // 刪除文章
    $(".cancel-foster").on("click",function(){ 
        id = $(this).data("id");
        console.log(id);
        Swal.fire({
          title: '取消申請',
          text: "你確定要取消申請嗎 ?",
          icon: 'warning',
          confirmButtonText: '確定',
          showCancelButton: true,
          cancelButtonText: '取消',
          showCloseButton: true 
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "{{ url('foster') }}",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                id: id,
              },
              type: "DELETE",
              success: function(response){
                console.log("成功");
                // modal 顯示已刪除
                Swal.fire({
                  icon: 'success',
                  title: '已取消申請',
                  showConfirmButton: false,
                  timer: 800
                }).then((result) => {
                    window.location.reload();
                    });

              }
            });
            
          }
        })


    });
</script>
@stop