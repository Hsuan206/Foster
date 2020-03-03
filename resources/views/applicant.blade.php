@extends('layouts.layout')
@section('css')

<style>
    .card {
        border-radius: 30px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
        background: #fff;
    }
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
                        <h2>申請人</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb start-->
<section class="top_place section_padding">
    <div class="container">
        @foreach($users->chunk(2) as $chunk)
        <div class="row">
            @foreach($chunk as $user)
                <div class="col-lg-6 col-md-12 mb-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h3 class="card-title text-center" style="font-weight:bold;"><i class="fa fa-user" aria-hidden="true"></i> {{ $user->name }}</h3>
                            <i class="fa fa-envelope" aria-hidden="true"> {{ $user->email }}</i>   
                            <i class="fa fa-phone" aria-hidden="true"> {{ $user->phone }}</i> 
                            <p class="card-text text-center mt-2 mb-2">{{ $user->experience }}</p>
                            @if($user->is_foster == 1)
                                <button data-id="{{ $user->id }}" class="btn btn-primary care-pet foster" disabled>委託者</button>
                            @elseif($user->is_foster == 0)
                                <button data-id="{{ $user->id }}" data-pet="{{ $user->pet_id }}" class="btn btn-primary care-pet">委託</button>
                            @else
                                <button data-id="{{ $user->id }}" class="btn btn-primary care-pet" disabled>申請者</button>
                            @endif
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

    $('.care-pet').on('click', function() {
        var id = $(this).data("id")
        var pet_id = $(this).data("pet")
        var url = "{{ route('applicant', 'id') }}";
        url = url.replace('id',pet_id);

        console.log(pet_id);
        $.ajax({
          url: url,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            id: id,
          },
          type: "PATCH",
          success: function(response){
            console.log("成功");
            // modal 顯示已更新
            Swal.fire({
              icon: 'success',
              title: '寵物已委託',
              showConfirmButton: false,
              timer: 800
            }).then((result) => {
                window.location.reload();
                });


          }
        });
    });
        
</script>
@stop