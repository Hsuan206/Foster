<!--::header part start::-->
<header class="main_menu">

    <div class="main_menu_iner">
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                        <a class="navbar-brand" href="/"> <img src="{{ asset('images/petpaw.png') }}" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-center"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                @if(Auth::check())
                                    <li class="nav-item dropdown" style="color: azure;">
                                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>    

                                        <div class="dropdown-menu"aria-labelledby="dropdown04">
                                        <form action="{{ asset('/logout') }}" method="post">
                                            @csrf
                                            <button class="dropdown-item" type="submit">登出</button>
                                        </form>
                                      </div>
                                    </li>
                                    <li><a class="nav-link" href="{{ asset('/care') }}">寄養紀錄</a></li>
                                    <li><a class="nav-link" href="{{ asset('/foster') }}">申請/託管紀錄</a></li>
                                @else
                                    <li><a class="nav-link" href="{{ asset('/auth/login') }}">登入</a></li>
                                    <li><a class="nav-link" href="{{ asset('/auth/register') }}">註冊</a></li>
                                @endif
                                    <li class="pl-3"><a id="care" class="mt-4 mb-4 genric-btn info circle" href="#">我要寄養</a></li>
                            </ul>
                        </div>
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header part end-->