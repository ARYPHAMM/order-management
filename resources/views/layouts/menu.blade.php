<ul class="list-group menu__main">
    <li class="list-group-item ">
        <a href="  " class="d-block text-center menu__main--title">
            Administrator
        </a>
    </li>
    @foreach (config('app.menu') as $key => $r_menu)
        <li class="list-group-item ">
            @if ($r_menu['main'] == true)
                <a href="">
                    {{ $r_menu['title'] }}
                </a>
          
            @else
                <a   class="d-flex justify-content-between align-items-center" href="javascript:void(0)"
                    data-toggle="collapse" data-target="#{{ $key }}" aria-expanded=" {{@(session()->get('remember_menu'))== $key ? 'true' : 'false'}}"
                    aria-controls="{{ $key }}"> {{ $r_menu['title'] }}
                    <i class="fas fa-chevron-down   1 "></i>
                </a>
              
                @if (is_array($r_menu['list-con']) && !empty($r_menu['list-con']))
              
                    <ul class="list-group-child collapse {{@(session()->get('remember_menu'))== $key ? 'show' : ''}}" id="{{ $key }}">
                        @foreach ($r_menu['list-con'] as $key_1 => $r_menu_child)
                        <li  class="list-group-item-child ">
                            <a onclick="ajaxRememberMenu('{{ $key }}','{{config('app.url')}}/{{$r_menu_child['con']}}/{{$r_menu_child['act']}}');" href="javascript:void(0)">
                                {{$r_menu_child['title']}}
                            </a>
                        </li>
                        @php
                    @endphp
                        @endforeach
                    </ul>
                @endif

            @endif

        </li>
    @endforeach
<script>
const admin_call_ajax = "{{ route('call-ajax') }}";

function ajaxRememberMenu(key,url) {
    $.ajax({
        type: "post",
        url: admin_call_ajax,
        data: {
            _token: '{{ csrf_token() }}',
            key: key,
    
        },
        dataType: "json",
        success: function(response) {
            window.location = url;          
            // let status = false;
            // if (response.status == 1) {
            //     status = $(this).find('input').is(":checked");
            //     $(this).find('input').attr('checked', status ? false : true);
            // } else {
            //     alert("Lỗi phát sinh vui lòng thử lại!");
            // }
        },
        error: function () {
            alert("Vui lòng kiểm tra lại đường truyền!");
        }
    });
}

</script>
    {{-- <li class="list-group-item disabled">Disabled item</li> --}}
</ul>
