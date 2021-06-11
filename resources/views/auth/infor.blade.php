@extends('app')
@section('content')

    <div class="account__information w--100vw h--100vh justify-content-center align-items-center d-flex ">
        <div class="d-flex col-lg-6 col-12 justify-content-center">
            <div class="card text-dark w-75 ">
                <div class="account__avatar">
                    <img class="card-img-top" src="{{asset('upload/avatar.jpg')}}" alt="">
                </div>
              <div class="card-body account__attribute">
                <h5 class="card-title"><b>Username: </b> {{Auth::user()->name}}</h5>
                <h5 class="card-title"><b>Email:</b> {{Auth::user()->email}}</h5>
                <p class="card-text p-0 m-0">Ngày tạo: {{Auth::user()->created_at->format('d/m/Y')}}</p>
                <p class="card-text p-0 m-0">Thay đổi lần cuối: {{Auth::user()->updated_at->format('d/m/Y')}}</p>
                <a class="btn btn-link w-100 shadow-none" href="{{route('change-password')}}">Đổi mật khẩu</a>
              </div>
            </div>
        </div>
    </div>
@endsection
