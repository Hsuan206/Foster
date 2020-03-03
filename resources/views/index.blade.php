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
                        <h2>Gi中寄養</h2>
                        <p>Gi Center with Pet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->
<!-- booking part start-->

<section class="booking_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="booking_menu">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                        <a class="nav-link active" id="hotel-tab" data-toggle="tab" href="#hotel" role="tab" aria-controls="hotel" aria-selected="true">寵物列表</a>
                        </li>
<!--
                        <li class="nav-item">
                        <a class="nav-link" id="tricket-tab" data-toggle="tab" href="#tricket" role="tab" aria-controls="tricket" aria-selected="false">時間表</a>
                        </li>
-->
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="booking_content">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="hotel" role="tabpanel" aria-labelledby="hotel-tab">
                            <div class="booking_form">
                                <form action="{{ asset('search') }}" method="post">
                                    @csrf
                                    <div class="form-row justify-content-center">
                                        <div class="form_colum mr-3">
                                            <select id="category" class="nc_select" name="category">
                                                <option value="0">所有種類的動物</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form_colum mr-3">
                                            <select id="city" class="nc_select" name="city">
                                                <option value="0">所有地區</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form_btn mr-3">
                                            <button class="genric-btn info radius large search" >查詢</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tricket" role="tabpanel" aria-labelledby="tricket-tab">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
                                <h3 data-category="{{ $pet->category_id }}" class="card-title text-center" style="font-weight:bold;">
                                @if($pet->category_id == 1)
                                    <i class="fa fa-dog" aria-hidden="true"></i> {{ $pet->name }}
                                @else
                                    <i class="fa fa-cat" aria-hidden="true"></i> {{ $pet->name }}
                                @endif
                                </h3>
                                <i class="fa fa-map-marker" aria-hidden="true" data-city="{{ $pet->city_id }}"> {{ \App\City::where('id', $pet->city_id)->value('name') }}</i>
                                <i class="fa fa-user" aria-hidden="true"> {{ $pet->age }}</i>      
                                <p class="card-text text-center mt-2 mb-2">{{ $pet->personality }}</p>
                                @if($user_id == $pet->user_id)
                                    <button data-id="{{ $pet->id }}"class="btn btn-primary foster-pet" disabled>我的寵物</button>
                                @elseif(\App\Care::where('user_id','=',$user_id)->where('pet_id','=', $pet->id)->exists())
                                    <button data-id="{{ $pet->id }}"class="btn btn-primary foster-pet" disabled>申請中</button>
                                @else
                                    <button data-id="{{ $pet->id }}"class="btn btn-primary foster-pet">當他的保母</button>
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
                  confirmButtonColor: '#38a4ff',
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
        $('select').on('change', function (e) {
//            var optionSelected = $("option:selected", this);
//            var valueSelected = this.value;
            console.log($('#category :selected').val())
            console.log($('#city :selected').val())
        });
//        $('.search').on('click', function() {
//            var category = $('#category :selected').val()
//            var city = $('#city :selected').val()
////            console.log(category,city)
////            $('div[data-city!='+city+']').hide()
//            $.ajax({
//              url: "{{ url('/search') }}",
//              headers: {
//                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//              },
//              data: {
//                category: category,
//                city: city
//              },
//              type: "POST",
//              success: function(response){
//                console.log("查詢中");
//                
//              }
//            });  
//        });
    });
    
</script>
@stop