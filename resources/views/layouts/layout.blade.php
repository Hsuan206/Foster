<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Martine</title>
    <link rel="icon" href="{{ asset('martine/img/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('martine/css/bootstrap.min.css') }}"> <!-- 註解掉 /*# sourceMappingURL=bootstrap.min.css.map */-->
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ asset('martine/css/animate.css') }}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ asset('martine/css/owl.carousel.min.css') }}">
    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ asset('martine/css/themify-icons.css') }}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('martine/css/flaticon.css') }}">
    <!-- fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('martine/fontawesome/css/all.min.css') }}">
    <!-- magnific CSS -->
    <link rel="stylesheet" href="{{ asset('martine/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('martine/css/gijgo.min.css') }}">
    <!-- niceselect CSS -->
    <link rel="stylesheet" href="{{ asset('martine/css/nice-select.css') }}">
    <!-- slick CSS -->
    <link rel="stylesheet" href="{{ asset('martine/css/slick.css') }}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{ asset('martine/css/style.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <style>
        .footer-area-custom {
            background-color: #162b45;
            padding: 50px 0px 0px;
            position: relative;
        }
        .embed-responsive .card-img-top {
            object-fit: cover;
        }
        .breadcrumb_bg {
            background-image: url(" {{ asset('images/background.png') }}");
        }
    </style>
    @yield('css')
</head>
<body>
    
    @include('layouts.navbar')
    @yield('content')
    @include('layouts.footer')

    {{-- JavaScripts --}}
     <!-- jquery plugins here-->
    <script src="{{ asset('martine/js/jquery-1.12.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('martine/js/popper.min.js') }}"></script> <!-- //# sourceMappingURL=popper.min.js.map -->
    <!-- bootstrap js -->
    <script src="{{ asset('martine/js/bootstrap.min.js') }}"></script> <!--//# sourceMappingURL=bootstrap.min.js.map-->
    <!-- magnific js -->
    <script src="{{ asset('martine/js/jquery.magnific-popup.js') }}"></script>
    <!-- swiper js -->
    <script src="{{ asset('martine/js/owl.carousel.min.js') }}"></script>
    <!-- masonry js -->
    <script src="{{ asset('martine/js/masonry.pkgd.js') }}"></script>
    <!-- masonry js -->
    <script src="{{ asset('martine/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('martine/js/gijgo.min.js') }}"></script>
    <!-- contact js -->
    <script src="{{ asset('martine/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('martine/js/jquery.form.js') }}"></script>
    <script src="{{ asset('martine/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('martine/js/mail-script.js') }}"></script>
<!--    <script src="js/contact.js"></script>-->
    <!-- custom js -->
    <script src="{{ asset('martine/js/custom.js') }}"></script>
    <!-- Sweetalert2, modal/dialog plugin -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<!--
    <script src="{{ asset('martine/kendo/js/kendo.all.min.js') }}"></script>
    <script src="{{ asset('martine/kendo/js/kendo.messages.zh-TW.js') }}"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
-->
    <script>
        $('#care').on('click', function () {

            @if(Auth::check())
                $('#care').attr('href',"{{ asset('/apply') }}");
                console.log("已經登入")
            @else
                Swal.fire({
                  icon: 'error',
                  title: '沒有權限',
                  text: '請登入進行新增',
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
    </script>
    @yield('js')
</body>
</html>
