@extends('app')
@section('content')
<div class="h--100vh">
    <div class=" h-100 w-100">
        <table class="table table-light">
            <thead>
                <tr class="d-lg-flex d-none col-lg-12">
                    <th class="col-md-3 d-flex justify-content-lg-center justify-content-between">STT</th>
                    <th class="col-md-3 d-flex justify-content-lg-center justify-content-between">Tên danh mục</th>
                    <th class="col-md-1 d-flex justify-content-lg-center justify-content-between">Cấp</th>
                    <th class="col-md-2 d-flex justify-content-lg-center justify-content-between">Danh mục cha</th>
                    <th class="col-md-1 d-flex justify-content-lg-center justify-content-between">Trạng thái</th>
                    <th class="col-md-2 d-flex justify-content-lg-center justify-content-between">Sửa/xóa</th>
                </tr>
            </thead>
            <tbody class="d-flex flex-row flex-wrap">
                @foreach ($items as $key => $r_item)
                <tr class="d-flex category__row category__row--mobile col-lg-12 col-md-6 col-12">
                    <td class="col-lg-3 col-12 justify-content-lg-center justify-content-between d-lg-flex d-none">{{$key+1}}</td>
                    <td class="col-lg-3 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Tên:
                        </b>
                       <span class="text-lg-center flex-grow-1">
                           {{$r_item->title}}
                        </span>
                    </td>
                    <td class="col-lg-1 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Cấp:
                         </b>
                        <span class="text-lg-center flex-grow-1">
                            {{$r_item->level}}
                         </span>
                    </td>
                    <td class="col-lg-2 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                           Danh mục cha
                         </b>
                         <span class="text-lg-center flex-grow-1">

                        @for ($i = 1; $i < request()->level; $i++)
                        @if(@$r_item->{'categoryLevel'.$i}->title != "")
                        Cấp {{$i}}: {{$r_item->{'categoryLevel'.$i}->title}}
                    <br>
                   
                    @endif
                        @endfor
                     @if (request()->level == 1)
                         Đây là danh mục cấp 1
                     @endif
                         </span>
                    </td>
                    <td class="col-lg-1 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Trạng thái:
                         </b>
                       <span class="text-lg-center flex-grow-1">
                            {{$r_item->status == 1? 'Bật' : 'Tắt' }}
                         </span>
                    </td>
                    <td class="col-lg-2 col-12  justify-content-center d-flex">
                        <a href="{{route('category-classify-edit',['id'=>$r_item->id,'level'=>$r_item->level])}}"><i class="fas fa-edit text-success   "></i></a>
                        <div class="pl-1 pr-1">
                        </div>
                        <a href="{{route('category-remove',['id'=>$r_item->id])}}"><i class="fas fa-trash text-danger   "></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $items->links() }}
        </div>
        <a class="btn m-1 btn-success rounded-0 shadow-none" href="{{redirect()->getUrlGenerator()->previous()}}">
            <i class="fas fa-undo-alt    ">
                Trở lại
            </i>
        </a>
    </div>
</div>
@endsection