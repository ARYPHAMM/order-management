@extends('app')
@section('content')

<div class="h--100vh">
    <div class=" h-100 w-100">
        <p class="category__title font-weight-bold text-center d-block m-0  text-uppercase bg-primary text-white ">
            Quản lý hóa đơn
        </p>
        <table class="table table-light">
            <thead>
                <tr class="d-lg-flex d-none col-lg-12">
                    <th class="col-lg-1 d-flex justify-content-lg-center justify-content-between">STT</th>
                    <th class="col-lg-2 d-flex justify-content-lg-center justify-content-between">Mã đơn</th>
                    <th class="col-lg-3 d-flex justify-content-lg-center justify-content-between">Tên khách hàng</th>
                    <th class="col-lg-2 d-flex justify-content-lg-center justify-content-between">Ngày giao</th>
                    <th class="col-lg-1 d-flex justify-content-lg-center justify-content-between">Trạng thái</th>

                    <th class="col-lg-2 d-flex justify-content-lg-center justify-content-between">Xem/Sửa</th>
                </tr>
            </thead>
            <tbody class="d-flex flex-row flex-wrap">
                @foreach ($items as $key => $r_item)
                <tr class="d-flex category__row category__row--mobile col-lg-12 col-md-6 col-12">
                    <td class="col-lg-1 col-12 justify-content-lg-center justify-content-between d-lg-flex d-none">
                        <span>
                        {{$key+1}}
                    </span>
                </th>
                    <th class="col-lg-2 col-12 justify-content-lg-center justify-content-between d-flex">
                    
                     <b class="d-block d-lg-none  text-right pr-1 w-50">
                        Mã đơn:
                    </b>
                   <span class="text-lg-center flex-grow-1">
                       {{$r_item->serial}}
                    </span>
                    
                
                </th>
                    <th class="col-lg-3 col-12 justify-content-lg-center justify-content-between d-flex">
                        
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Khách hàng:
                         </b>
                        <span class="text-lg-center flex-grow-1">
                            {{$r_item->customer->name}}
                         </span>
 
                    </th>
                    <th class="col-lg-2 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Ngày giao:
                         </b>
                        <span class="text-lg-center flex-grow-1">
                            {{
                                date('d-m-Y',$r_item->delivery_date)
                           }}
                         </span>
                    </th>
                    <th class="col-lg-1 col-12 justify-content-lg-center justify-content-between d-flex">
                        <b class="d-block d-lg-none  text-right pr-1 w-50">
                            Trạng thái:
                         </b>

                                                <span class="text-lg-center flex-grow-1 status-{{$r_item->status}}">


                            {{__('lang.'.$r_item->status)}}
                                                 </span>

                    </th>
 
                    <th class="col-lg-2 col-12 d-flex justify-content-center">
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
        <a class="btn btn-success rounded-0 shadow-none" href="{{route('order-create')}}">
            Thêm mới
               </a>
    </div>
</div>
@endsection