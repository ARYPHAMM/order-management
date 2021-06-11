@extends('app')

@section('content')
    <div class="container h--100vh">
        <div class="row justify-content-center align-items-center h-100 w-100">
            <form  onsubmit="return  confirm('Bạn đã kiểm tra kỹ hết chưa? đơn hàng sẽ được cập nhật!');" class="w-100" method="POST" action="{{ route('order-update') }}" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id" value="{{$item->id}}">
            <div class="card w-75">
                <div class="card-header bg-primary text-white font-weight-bold text-uppercase">
                   Cập nhật đơn hàng
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                           <b>
                               Mã đơn hàng
                           </b>
                        </div>
                        <div class="col-md-9">
                            {{ @$item->serial }}
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                       <b>     
                            Họ tên khách hàng
                        </b>
                        </div>
                        <div class="col-md-9">
                            {{ $item->customer->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                           <b>
                            Địa chỉ
                           </b>
                        </div>
                        <div class="col-md-9">
                            {{ $item->customer->address }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                        <b>    
                          Ngày giao
                         </b>
                        </div>
                        <div class="col-md-9">
                            {{ date('d-m-Y',$item->delivery_date) }} 
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
                                <div class="d-flex">
                                    <div class="col-4 d-flex">
                                        <b class="pr-3">Tên sản phẩm </b>
                                        <p>
                                            {{$r_item->product->title}}
                                        </p>
                                    </div>
                                    <div class="col-6 d-flex">
                                        <b class="pr-1">Số lượng </b>
                                        <div class="w-auto d-block text-center">
                                            <button type="button" onclick="$(this).next('input').val(    ($(this).next('input').val()-1) == 0?1 : ($(this).next('input').val()-1)   );  " class="btn rounded-0 shadow-none">
                                                <i class="fas fa-minus    "></i>
                                            </button>
                                            <input class="text-center" name="order-product-{{$r_item->id}}" id="product-quantity-{{$r_item->id}}" type="number" value="{{$r_item->quantity}}" min="1" max="{{$r_item->product->quantity}}">
                                            <button type="button" onclick="$(this).prev('input').val(  parseInt($(this).prev('input').val())+1  >  parseInt($(this).prev('input').attr('max')) ? $(this).prev('input').attr('max') : ( parseInt($(this).prev('input').val())+1)   ); " class="btn rounded-0 shadow-none">
                                                <i class="fas fa-plus    "></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-2 d-flex">
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
                    @if ($item->status =='cancel' || $item->status =='success')
                    <div class="row">
                        <div class="col-md-3">
<b>
                          Trạng thái đơn hàng
                           </b>
                        </div>
                        <div class="col-md-9 status-{{$item->status}}">
                            <b>

                                {{ __('lang.'.$item->status) }}
                            </b>
                        </div>
                    </div>
                     @else
                        <div class="row d-flex align-items-center">

                            <div class="col-md-12 d-flex justify-content-center ">
                                <b class="pr-2">
                                    Trạng thái đơn hàng
                                     </b>
                                   <select class="form-control w-auto" name="status" id="status">
                                       <option {{$item->status == "success"? 'selected' : ''}} value="success"> {{__('lang.success')}} </option>
                                       <option {{$item->status == "wait"? 'selected' : ''}} value="wait">  {{__('lang.wait')}}</option>
                                       <option {{$item->status == "cancel"? 'selected' : ''}} value="cancel">   {{__('lang.cancel')}}</option>
                                   </select>
                               </div>
                            </div>
                            <div class="row justify-content-center mt-3">
                                <button type="submit" class="btn btn-success ">
                                    Cập nhật
                                </button>
                            </div>
    
                        </div>
                    @endif
                    
                </div>
            </form>
            </div>
        </div>
    </div>
@endsection
