@extends('app')
@section('content')
<div class="h--100vh">
    <div class=" h-100 w-100">
        <p class="category__title font-weight-bold text-center d-block m-0  text-uppercase bg-primary text-white ">
            Quản lý danh mục
        </p>
        <table class="table table-light">
            <thead>
                <tr class="d-lg-flex d-none col-lg-12">
                    <th class="col-md-3 d-flex justify-content-lg-center justify-content-between">STT</th>
                    <th class="col-md-3 d-flex justify-content-lg-center justify-content-between">Tên danh mục</th>
                    <th class="col-md-2 d-flex justify-content-lg-center justify-content-between">Cấp</th>
                    <th class="col-md-2 d-flex justify-content-lg-center justify-content-between">Trạng thái</th>
                    <th class="col-md-2 d-flex justify-content-lg-center justify-content-between">Sửa/xóa</th>
                </tr>
            </thead>
            <tbody class="d-flex flex-row flex-wrap">
                @foreach ($items as $key => $r_item)
                <tr class="d-flex category__row category__row--mobile col-lg-12 col-md-6 col-12">
                    <td class="col-lg-3 col-12 justify-content-lg-center justify-content-between d-lg-flex d-none">
                        <span>
                            {{$key+1}}
                        </span>
                    </td>
                    <td class="col-lg-3 col-12 justify-content-lg-center justify-content-between d-flex ">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Tên:
                        </b>
                       <span class="text-lg-center flex-grow-1">
                           {{$r_item->title}}
                        </span>
                    </td>
                    <td class="col-lg-2 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                           Cấp:
                        </b>
                       <span class="text-lg-center flex-grow-1">
                           {{$r_item->level}}
                        </span>
                    </td>
                    <td class="col-lg-2 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Trạng thái:
                         </b>
                       <span class="text-lg-center flex-grow-1">
                            {{$r_item->status == 1? 'Bật' : 'Tắt' }}
                         </span>
                      
                    </td>
                    <td class="col-lg-2 col-12 justify-content-center d-flex">
                        <a href="{{route('category-edit',['id'=>$r_item->id])}}"><i class=" fas fa-edit text-success   "></i></a>
                        <div class="pl-1 pr-1">
                        </div>
                        <a href="{{route('category-remove',['id'=>$r_item->id])}}"><i class="fas fa-trash text-danger   "></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-lg-center justify-content-between">
            {{ $items->links() }}
        </div>
        <div class="d-flex justify-content-center justify-content-lg-start flex-row flex-wrap">
        <a class="btn m-1 btn-success rounded-0 shadow-none" href="{{route('category-create')}}">
            Thêm mới
         </a>
        <a class="btn m-1 btn-success rounded-0 shadow-none" href="{{route('category-classify',['level'=>1])}}">
            Danh mục cấp 1
         </a>
        <a class="btn m-1 btn-success rounded-0 shadow-none" href="{{route('category-classify',['level'=>2])}}">
            Danh mục cấp 2
         </a>
        <a class="btn m-1 btn-success rounded-0 shadow-none" href="{{route('category-classify',['level'=>3])}}">
            Danh mục cấp 3
        </a>
    </div>

    </div>
</div>
@endsection