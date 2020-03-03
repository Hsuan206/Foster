@extends('layouts.layout')
@section('css')
<!-- slick CSS -->
<link rel="stylesheet" href="{{ asset('martine/css/slick.css') }}">
<!-- style CSS -->
<link rel="stylesheet" href="{{ asset('martine/css/style.css') }}">
<!-- Login css -->
<link rel="stylesheet" href="{{ asset('martine/css/login.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('martine/Auth/css/util.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('martine/Auth/css/main.css') }}">
<style>
    .care-form {
        border-radius: 30px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        background: #fff;
    }
    h1 {
        background-color: cornflowerblue;
        color: white;
        font-size: 12px;
        padding: 14px 0 10px 49px;
        letter-spacing: 1px;
        margin-left: -52px;
        margin-right: 10vh;
        margin-top: 5vh;
    }
    .input100 {
        padding-left: 60px;
    }
    .custom-file-label::after {
        content: "瀏覽";
    }
    .nice-select{
        width: 100%;   
    }
    section {
        background-color: azure;
    }
    .login100-form-btn {
        background-color: cornflowerblue;
    }
</style>
@stop


@section('content')
<section class="top_place section_padding">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-4 col-md-2"></div>
            <div class="col-lg-4 col-md-8 care-form"> 
                <h1>填寫寄養申請</h1>
                <form class="p-l-55 p-r-55 p-t-60" method="POST" action="{{ asset('apply') }}" enctype="multipart/form-data">
                    @csrf
<!--                    <input type="hidden" name="_token" value="N5ns13SS5j8pQ72y6uwBcWrCYodUMLuAIgCF8BXz">                               -->
                    <div class="row justify-content-between">
                        <div class="wrap-input100 validate-input" data-validate="請輸入寵物名稱">
                            <input id="name" class="input100" type="text" name="name" placeholder="寵物名稱">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="請輸入毛色">
                            <input id="color" class="input100" type="text" name="color" placeholder="毛色">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-paw" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="請輸入年齡">
                            <input id="age" class="input100" type="text" name="age" placeholder="年齡">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="請輸入個性">
                            <input id="personality" class="input100" type="text" name="personality" placeholder="簡短描述個性">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-sun" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>    
                    <div class="row justify-content-center">
                    
                        <div class="col-lg-6 col-md-6 text-center">
                            <select id="category" name="category" class="nc_select" style="width: 50%;">
                            <option value="0">動物類型</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 col-md-6 text-center">
                            <select id="city" name="city" class="nc_select">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="file-upload mt-2">
<!--
                    <div class="image-upload-wrap">
                        <input class="custom-file file-upload-input" type='file' onchange="readURL(this);" accept="image/*" name="img" required="請選擇一張圖片" />
                        <div class="drag-text">
                            <label>刪除或選擇照片</label>
                        </div>
                    </div>
-->
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile" onchange="readURL(this);" accept="image/*" name="img" required="請選擇一張圖片">
                      <label class="custom-file-label" for="customFile">請選擇一張照片</label>
                    </div>
<!--
                    <div class="file-upload-content">
                        <img class="file-upload-image" src="#" alt="your image" />
                        <div class="image-title-wrap">
-->
<!--                        <button type="button" onclick="removeUpload()" class="remove-image"><span class="image-title"></span>&nbsp;<i class='fas fa-trash-alt' style='font-size:24px'></i></button>-->
<!--
                        </div>
                    </div>
-->
                    </div>
                    <div class="container-login100-form-btn p-t-80 p-b-40">
                        <button id="apply" class="login100-form-btn">
                            申請
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-2"></div>
        </div>
    </div>
</section>
@endsection


@section('js')
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!--===============================================================================================-->
<script src="{{ asset('martine/Auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('martine/Auth/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('martine/Auth/vendor/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('martine/Auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('martine/Auth/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('martine/Auth/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('martine/Auth/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('martine/Auth/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
<script src="{{ asset('martine/Auth/js/main.js') }}"></script>
<script>

// 圖片上傳
var img;
function readURL(input) {
 	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function(e) {
//	    	$('.image-upload-wrap').hide();
//	    	$('.file-upload-image').attr('src', e.target.result);
//	    	$('.file-upload-content').show();
            Swal.fire({
              imageUrl: e.target.result,
              imageWidth: 400,
              imageHeight: 300,
            })
//			$('.image-title').html(input.files[0].name);
            $(".custom-file-label").html(input.files[0].name);
    	};
        img = input.files[0];
    	reader.readAsDataURL(input.files[0]);
  	} else {
    	removeUpload();
  	}
}

function removeUpload() {
//  	$('.file-upload-input').replaceWith($('.file-upload-input').clone());
//  	$('.image-title').hide();
//  	$('.image-upload-wrap').show();
      	$('.custom-file-input').replaceWith($('.custom-file-input').clone());
//        $(".custom-file-label").html('請選擇一張照片');
}

//$('.image-upload-wrap').bind('dragover', function () {
//	$('.image-upload-wrap').addClass('image-dropping');
//});
//
//$('.image-upload-wrap').bind('dragleave', function () {
//	$('.image-upload-wrap').removeClass('image-dropping');
//});
// 
$('.custom-file').bind('dragover', function () {
	$('.custom-file').addClass('image-dropping');
});

$('.custom-file').bind('dragleave', function () {
	$('.custom-file').removeClass('image-dropping');
});
//$.ajaxSetup({
//  headers: {
//    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//  }
//});
    // 新增文章
//$(document).on("click","#apply",function(){ 
//    $.ajax({
//        url: "{{ url('/apply') }}",
//        headers: {
//        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//        },
//        data: {
//            name: $('#name').val(),
//            color: $('#color').val(),
//            age: $('#age').val(),
//            personality: $('#personality').val(),
//            category: $('#category :selected').val(),
//            city: $('#city :selected').val(),
//            img: $('input[type=file]').files[0],
//        },
//        type: "POST",
//        success: function(response){
//            console.log("成功");
//            // modal 顯示已新增
//            Swal.fire({
//                icon: 'success',
//                title: '留言已新增',
//                showConfirmButton: false,
//                timer: 800
//            }).then((result) => {
//                window.location.reload();
//                });
//        }
//    });  
//});

</script>

@stop