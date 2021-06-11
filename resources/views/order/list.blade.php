@extends('app')
@section('content')

<div class="h--100vh">
    <div class=" h-100 w-100">
        <p class="category__title font-weight-bold text-center d-block m-0  text-uppercase bg-primary text-white ">
            Quản lý hóa đơn
        </p>
        <table class="table table-light">
            <thead>
                <tr class="d-md-flex d-none">
                    <th class="col-md-1 d-flex justify-content-center">STT</th>
                    <th class="col-md-2 d-flex justify-content-center">Mã đơn</th>
                    <th class="col-md-3 d-flex justify-content-center">Tên khách hàng</th>
                    <th class="col-md-2 d-flex justify-content-center">Ngày giao</th>
                    <th class="col-md-1 d-flex justify-content-center">Trạng thái</th>

                    <th class="col-md-2 d-flex justify-content-center">Xem/Sửa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $key => $r_item)
                <tr class="d-flex category__row">
                    <th class="col-md-1 d-flex justify-content-center">{{$key+1}}</th>
                    <th class="col-md-2 d-flex justify-content-center">{{
                    $r_item->serial}}</th>
                    <th class="col-md-3 d-flex justify-content-center">
                        {{$r_item->customer->name}}
                    </th>
                    <th class="col-md-2 d-flex justify-content-center">
                        {{
                             date('d-m-Y',$r_item->delivery_date)
                        }}
                    </th>
                    <th class="col-md-1 d-flex justify-content-center">
                        <b class="status-{{$r_item->status}}">

                            {{__('lang.'.$r_item->status)}}
                        </b>
                    </th>
 
                    <th class="col-md-2 d-flex justify-content-center">
                        <a href="{{route('order-view',['id'=>$r_item->id])}}"><i class="fas fa-image    "></i></a>
                        <div class="pl-1 pr-1">

                        </div>
                        <a href="{{route('order-edit',['id'=>$r_item->id])}}"><i class="fas fa-edit text-success   "></i></a>
                        <div class="pl-1 pr-1">

                        </div>
                  
                    </th>
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