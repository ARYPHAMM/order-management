@extends('app')
@section('content')

<div class="h--100vh">
    <div class=" h-100 w-100">
        <p class="category__title font-weight-bold text-center d-block m-0  text-uppercase bg-primary text-white ">
            Quản lý sản phẩm
        </p>
        <table class="table table-light">
            <thead>
                <tr class="d-md-flex d-none">
                    <th class="col-md-1 d-flex justify-content-center">STT</th>
                    <th class="col-md-2 d-flex justify-content-center">Hình ảnh</th>
                    <th class="col-md-2 d-flex justify-content-center">Tên sản phẩm</th>
                    <th class="col-md-2 d-flex justify-content-center">Danh mục</th>
                    <th class="col-md-1 d-flex justify-content-center">Tồn kho</th>
                    <th class="col-md-1 d-flex justify-content-center">Quy cách</th>
                    <th class="col-md-1 d-flex justify-content-center">Trạng thái</th>
                    <th class="col-md-1 d-flex justify-content-center">Sửa/xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $key => $r_item)
                <tr class="d-flex category__row">
                    <td class="col-md-1 justify-content-center d-flex">{{$key+1}}</td>
                    <td class="col-md-2 justify-content-center d-flex">
                        <img class="thumbnail items__thumbnail"
                        src="{{ file_exists(@$r_item->thumbnail) && !empty(@$r_item->thumbnail) ? asset(@$r_item->thumbnail) : config('app.url') . '/images/no-image.png' }}"
                        alt=""></td>
                        <td class="col-md-2 justify-content-center d-flex">{{$r_item->title}}</td>

                    <td class="col-md-2 justify-content-center d-flex">

                        @for ($i = 1; $i < 4; $i++)
                        @if(@$r_item->{'category_level_'.$i}->title != "")
                        Cấp {{$i}}: {{$r_item->{'category_level_'.$i}->title}}
                    <br>
                   
                    @endif
                        @endfor
 
                    </td>
                    <td class="col-md-1 justify-content-center d-flex">{{$r_item->quantity}}</td>
                    <td class="col-md-1 justify-content-center d-flex">{{__('lang.'.$r_item->specification)}}</td>
                    <td class="col-md-1 justify-content-center d-flex">{{$r_item->status == 1? 'Bật' : 'Tắt' }}</td>
                    <td class="col-md-1 justify-content-center d-flex">
                        <a href="{{route('product-edit',['id'=>$r_item->id])}}"><i class="fas fa-edit text-success   "></i></a>
                        <div class="pl-1 pr-1">

                        </div>
                        <a href="{{route('product-remove',['id'=>$r_item->id])}}"><i class="fas fa-trash text-danger   "></i></a>
                    </td>
                </tr>
                
                @endforeach
             

            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $items->links() }}
        </div>
        <a class="btn btn-success rounded-0 shadow-none" href="{{route('product-create')}}">
            Thêm mới
               </a>
    </div>
</div>
@endsection