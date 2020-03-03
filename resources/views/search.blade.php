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
                        <h2>搜尋結果</h2>
                        <p>種類：{{ $category }}</p>
                        <p>地區：{{ $city }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->
<!-- Header part end-->
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
                                <h3 data-category="{{ $pet->category_id }}" class="card-title text-center" style="font-weight:bold;"><i class="fa fa-dog" aria-hidden="true"></i> {{ $pet->name }}</h3>
                                <i class="fa fa-map-marker" aria-hidden="true" data-city="{{ $pet->city_id }}"> {{ \App\City::where('id', $pet->city_id)->value('name') }}</i>
                                <i class="fa fa-user" aria-hidden="true"> {{ $pet->age }}</i>      
                                <p class="card-text text-center mt-2 mb-2">{{ $pet->personality }}</p>
                                @if($user_id == $pet->user_id)
                                    <button data-id="{{ $pet->id }}"class="btn btn-primary foster-pet" disabled>我的寵物</button>
                                @elseif(\App\Care::where('user_id','=',$user_id)->where('pet_id','=', $pet->id)->exists())
                                    <button data-id="{{ $pet->id }}"class="btn btn-primary foster-pet" disabled>申請中</button>
                                @else
                                    <button data-id="{{ $pet->id }}"class="btn btn-primary foster-pet">當他的褓母</button>
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
    $(function() {
        // Gijgo datepicker
//        var today
//        today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
//        $("#date").datepicker({
//            minDate:today,
//            format: 'yyyy-mm-dd'
//            
//        });
        $('.foster-pet').on('click', function() {
            @if(Auth::check())
                id = $(this).data('id');
                Swal.fire({
                  title: '簡單描述照顧寵物經驗',
                  input: 'textarea',
                  inputAttributes: {
                    autocapitalize: 'off'
                  },
                  confirmButtonText: '確定',
                  showCancelButton: true,
                  cancelButtonText: '取消',
                  showCloseButton: true  
                }).then((result) => {
                  if (result.value) {
                      console.log(result.value)
                      $.ajax({
                          url: "{{ url('/') }}",
                          headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                          data: {
                            pet_id: id,
                            experience: result.value
                          },
                          type: "POST",
                          success: function(response){
                            console.log("成功");
                            // modal 顯示已新增
                            Swal.fire({
                              icon: 'success',
                              title: '成功申請中',
                              showConfirmButton: false,
                              timer: 800
                            }).then((result) => {   
                                window.location.reload();
                                });
                          }
                        });  
                  }
                })
            @else
                Swal.fire({
                  icon: 'error',
                  title: '沒有權限',
                  text: '請進行登入',
                  confirmButtonColor: '#8050fa',
                  confirmButtonText: '登入',
                  showCloseButton: true,
                  footer: '<a href="{{ asset('/auth/register') }}">還沒有帳號嗎?</a>'
                }).then((result) => {
                      console.log(result.value)
                      if (result.value) {
                        window.location.assign("{{ asset('/auth/login') }}");
                      }
                    })
//                
            @endif
        });
    });
    
</script>
@stop