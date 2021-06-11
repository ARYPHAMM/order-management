@extends('app')

@section('content')
    <div class="container h--100vh">
        <div class="row justify-content-center align-items-center h-100 ">
            <div class="card col-md-6 col-12">
                <div class="card-header bg-primary text-white font-weight-bold text-uppercase">
                    Thông tin đơn hàng
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-12">
                           <b>
                               Mã đơn hàng
                               </b>
                        </div>
                        <div class="col-md-9 col-12">
                            {{ @$item->serial }}
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-12">
                       <b>     
                            Họ tên khách hàng
                        </b>
                        </div>
                        <div class="col-md-9">
                            {{ @$item->customer->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-12">
                           <b>
                            Địa chỉ
 </b>
                        </div>
                        <div class="col-md-9">
                            {{ @$item->customer->address }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 col-12">
                        <b>    
                          Ngày giao
                         </b>
                        </div>
                        <div class="col-md-9">
                            {{ @date('d-m-Y',$item->delivery_date) }} 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-12">
<b>
                          Trạng thái đơn hàng
                           </b>
                        </div>
                        <div class="col-md-9 status-{{@$item->status}}">
                            <b>

                                {{ __('lang.'.@$item->status) }}
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            
                            <b>
                                Chi tiết
                            </b>
                        </div>
                        <div class="col-12 ">
                          @foreach ($item->orderDetail() as $r_item)
                              <div class="order__detail--item shadow-sm mb-1">
                                <div class="d-flex flex-wrap">
                                    <div class="col-4 col-12 d-flex">
                                        <b class="pr-3">Tên sản phẩm </b>
                                        <p>
                                            {{$r_item->product->title}}
                                        </p>
                                    </div>
                                    <div class="col-4 col-12 d-flex">
                                        <b class="pr-3">Số lượng </b>
                                        <p>
                                            {{$r_item->quantity}}
                                        </p>
                                    </div>
                                    <div class="col-4 col-12 d-flex">
                                        <b class="pr-3">Giá </b>
                                        <p>
                                            {{number_format($r_item->price,0).'đ'}}
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="col-12 d-flex justify-content-end">
                                        <span class="pr-3">Thành Tiền </span>
                                        <p class="text-danger">
                                           {{number_format($r_item->price*$r_item->quantity,0).'đ' }}
                                        </p>
                                    </div>
            
                                </div>
                              </div>
                          @endforeach
                        </div>
                    </div>
                    <div class="row">
             
                        <div class="col-12 d-flex justify-content-end">
                          <b class="pr-2"> Tổng tiền </b>  {{ $item->totalPrice() }} <span class="text-danger">
                                (chưa VAT)
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
