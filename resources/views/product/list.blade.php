@extends('app')
@section('content')

<div class="h--100vh">
    <div class=" h-100 w-100">
        <p class="category__title font-weight-bold text-center d-block m-0  text-uppercase bg-primary text-white ">
            Quản lý sản phẩm
        </p>
        <table class="table table-light">
            <thead>
                <tr class="d-lg-flex d-none col-lg-12">
                    <th class="col-md-1 d-flex justify-content-lg-center justify-content-between">STT</th>
                    <th class="col-md-2 d-flex justify-content-lg-center justify-content-between">Hình ảnh</th>
                    <th class="col-md-2 d-flex justify-content-lg-center justify-content-between">Tên sản phẩm</th>
                    <th class="col-md-2 d-flex justify-content-lg-center justify-content-between">Danh mục</th>
                    <th class="col-md-1 d-flex justify-content-lg-center justify-content-between">Tồn kho</th>
                    <th class="col-md-1 d-flex justify-content-lg-center justify-content-between">Quy cách</th>
                    <th class="col-md-1 d-flex justify-content-lg-center justify-content-between">Trạng thái</th>
                    <th class="col-md-1 d-flex justify-content-lg-center justify-content-between">Sửa/xóa</th>
                </tr>
            </thead>
            <tbody class="d-flex flex-row flex-wrap">
                @foreach ($items as $key => $r_item)
                <tr  class="d-flex category__row category__row--mobile col-lg-12 col-md-6 col-12">
                    <td class="col-lg-1 col-12 justify-content-lg-center justify-content-between d-lg-flex d-none ">{{$key+1}}</td>
                    <td class="col-lg-2 col-12  justify-content-center d-flex">
                        <img class="thumbnail items__thumbnail "
                        src="{{ file_exists(@$r_item->thumbnail) && !empty(@$r_item->thumbnail) ? asset(@$r_item->thumbnail) : config('app.url') . '/images/no-image.png' }}"
                        alt="">
                    </td>
                  <td class="col-lg-2 justify-content-center d-flex">
                    <b class="d-block d-lg-none  text-right pr-1 w-50">
                        Tên:
                    </b>
                   <span class="text-lg-center flex-grow-1">
                       {{$r_item->title}}
                    </span>
                    </td>

                    <td class="col-lg-2 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Danh mục:
                         </b>
                         <span class="text-lg-center flex-grow-1">

                        @for ($i = 1; $i < 4; $i++)
                        @if(@$r_item->{'category_level_'.$i}->title != "")
                        
                        Cấp {{$i}}: {{$r_item->{'category_level_'.$i}->title}}
                    <br>
                   
                    @endif
                        @endfor
                         </span>
 
                    </td>
                    <td class="col-lg-1 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Số lượng:
                         </b>
                         <span class="text-lg-center flex-grow-1">

                        {{$r_item->quantity}}
                         </span>
                    </td>
                    <td class="col-lg-1 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Quy cách: 
                        </b>
                        <span class="text-lg-center flex-grow-1">

                        {{__('lang.'.$r_item->specification)}}
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
                    <td class="col-lg-1 col-12  justify-content-center d-flex">
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