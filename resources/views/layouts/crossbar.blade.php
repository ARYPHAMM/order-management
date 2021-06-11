<div class="crossbar">
    <div class="d-lg-none d-block">
        <button class="btn btn-dark border-0 rounded-0 shadow-none" onclick="$('#body').toggleClass('active')">
            <i class="fas fa-bars    "></i>
        </button>
    </div>
    <div class="position-relative">
        <button class="btn shadow-none rounded-0 border-0 userCurrent" type="button" data-toggle="collapse" data-target="#collapseAccount" aria-expanded="false" aria-controls="collapseAccount">
            <div class="d-flex align-items-center justify-content-end text-right">
                <img src="{{asset('upload/avatar.jpg')}}" alt=""> <b>{{Auth::user()->name}}</b> <i class="fas fa-chevron-down    "></i>
            </div>
        </button>
        <div class="collapse" id="collapseAccount">
            <ul>
                <li><a href="{{route('account-infor')}}">{{__('user.Infor_account')}}</a></li>
                <li><a href="{{route('change-password')}}">{{__('user.Change_password')}}</a></li>
                <li><a href="{{route('logout')}}">{{__('user.Logout')}}</a></li>
            </ul>
        </div>
    </div>
</div>