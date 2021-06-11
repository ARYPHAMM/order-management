@extends('app')
@section('content')
    <div class="container h--100vh">
        <div class="row justify-content-center align-items-center h-100">
            <div class="card col-md-6 col-12">
                <div class="card-header bg-primary text-white font-weight-bold text-uppercase">
                    {{ __('lang.' . (@$item->id != '' ? 'Update' : 'Create') . '_order') }}
                </div>
                <div class="card-body">
                    @if (session('notification'))
                        <div class="alert alert-{{ session('notification')['status'] }} text-center" role="alert">
                            <strong>{{ session('notification')['message'] }}</strong>
                        </div>
                    @endif
                    <form class="d-flex flex-column" method="POST" action="{{ route('order-update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="search_customer" class="col-md-4 col-form-label text-md-right">Khách hàng
                            </label>
                            <div class="col-md-6 position-relative">
                                <input type="text" class="form-control shadow-none w-100" id="search_customer"
                                    placeholder="Nhập họ tên hoặc số điện thoại">
                                <input id="customer_id" type="hidden"
                                    class="form-control shadow-none @error('customer_id') is-invalid @enderror"
                                    name="customer_id" required autocomplete="new-customer_id"
                                    value="{{ @$item->customer_id }}">
                                <p class="customer__popup--create text-center m-0 d-none">
                                    <span class="w-100 d-block">
                                        Không tìm thấy dữ liệu
                                    </span>
                                    <button type="button" data-toggle="modal" data-target="#modalAddCustomer"
                                        class="btn btn-success rounded-0">
                                        Thêm khách hàng mới
                                    </button>
                                </p>
                                @error('customer_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address_request"
                                class="col-md-4 col-form-label text-md-right">{{ __('lang.Delivery_address') }}
                            </label>
                            <div class="col-md-6">
                                <p class="m-0">
                                    Sử dụng địa chỉ hiện có của khách hàng
                                </p>
                                <input type="checkbox" name="address_customer" id="address_customer" value="0">
                                <textarea required name="address" id="address_request"
                                    class="form-control shadow-none w-100 "></textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="search_product"
                                class="col-md-4 col-form-label text-md-right">{{ __('lang.Product') }}
                            </label>
                            <div class="col-md-6">
                                <input type="text" class="form-control shadow-none w-100" id="search_product"
                                    placeholder="Nhập tên sản phẩm">
                                <div id="order__list">

                                </div>
                                <div >
                                 <b>Tổng tiền: </b><span id="order-price">0đ</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="search_product"
                                class="col-md-4 col-form-label text-md-right">{{ __('lang.Delivery_date') }}
                            </label>
                            <div class="col-md-6">
                                <input min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" type="date" name="delivery_date" id="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('lang.' . (@$item->id != '' ? 'Update' : 'Create') . '') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal add customer start --}}
    <div class="modal fade" id="modalAddCustomer" tabindex="-1" role="dialog" aria-labelledby="modalAddCustomerLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddCustomerLabel">
                        Thêm khách hàng mới
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="modal__notification text-danger font-weight-bold d-none">
                    </p>
                    <input required type="text" name="name" id="name" class="toggle__addUser form-control mt-1 p-1 "
                        placeholder="Nhập tên khách hàng">
                    <input required type="text" name="tel" id="tel" class="toggle__addUser form-control mt-1 p-1 "
                        placeholder="Nhập số điện khách hàng">
                    <textarea required name="address" id="address" class="toggle__addUser form-control mt-1 p-1 " cols="30"
                        rows="10" placeholder="Nhập đỉa chỉ"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        onclick="callAddCustomer($('#modalAddCustomer #name').val(),$('#modalAddCustomer #tel').val(),$('#modalAddCustomer #address').val())"
                        class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal add customer end --}}
    {{-- modal add product start --}}
    {{-- <div class="modal fade" id="modalAddProduct" tabindex="-1" role="dialog" aria-labelledby="modalAddProductLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddProductLabel">
                        Thêm sản phẩm cho hóa đơn
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="modal__notification text-danger font-weight-bold d-none">
                    </p>
                    <label for="product-quantity-input">
                        <p class="m-0"> <b>Tên sản phẩm:</b> <span id="product-title"></span></p>
                        <p class="m-0"> <b>Tồn kho:</b> <span id="product-quantity"></span> </p>
                        <input type="hidden" id="product-id" val="">
                    </label>
                    <div>
                        <button onclick="$(this).next('input').val(    ($(this).next('input').val()-1) == 0?1 : ($(this).next('input').val()-1)   )  " class="btn rounded-0 shadow-none">
                            <i class="fas fa-minus    "></i>
                        </button>
                        <input type="number" value="1" min="1" max="10" id="product-quantity-input">
                        <button onclick="$(this).prev('input').val(    (parseInt($(this).prev('input').val()) +1 ) > parseInt($(this).prev('input').attr('max') )?$(this).prev('input').attr('max') : ( parseInt($(this).prev('input').val())+1)   )" class="btn rounded-0 shadow-none">
                          <i class="fas fa-plus    "></i>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        onclick="callAddProduct()"
                        class="btn btn-primary">Thêm</button>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- modal add product end --}}
    <script>
        // checkbox address customer start
        $('#address_customer').change(function(e) {
            if ($(this).is(":checked")) {
                $(this).val('1');
                $('#address_request').attr('readonly', true);
            } else {
                $(this).val('0');
                $('#address_request').attr('readonly', false);
            }
        });
        // checkbox address customer end
        // search and selected customer start
        $(function() {
            // Single Select
            $("#search_customer").autocomplete({
                classes: {
                    "ui-autocomplete": "list-customer"
                },
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: '{{ route('call-ajax-customer') }}',
                        type: 'post',
                        dataType: "json",
                        data: {
                            name: request.term,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(data) {
                            // console.log(data['result']);
                            if (data['result'].length > 0) {
                                $('.customer__popup--create').addClass('d-none');
                                response(data['result']);
                            } else {
                                $("ul.list-customer").hide();
                                $('.customer__popup--create').removeClass('d-none');
                            }
                        }
                    });
                },
                select: function(event, ui) {
                    // $('#search_customer').val(ui.item.title,positionIdCurrent,); // display the selected text
                    // console.log($(this).data('layout'));
                    selectedCustomer(ui.item.id, ui.item.name, '#customer_id', '#search_customer');
                    $("ul.list-customer").hide();
                    return false;
                    // console.log(ui.item.url)
                    // // redirect to url
                    // window.location = ui.item.url
                },
                close: function(event, ui) {
                    if (!$("ul.list-customer").is(":visible")) {
                        $("ul.list-customer").show();
                    }
                },
                create: function() {
                    $(this).data('ui-autocomplete')._renderItem = function(ul, item) {
                        elem = $('<li class="category_item_title">')
                            .append('<a href="javascript:void(0)">' + item.name + ' - Địa chỉ: ' +
                                item.address + '</a>')
                            .append('</li>')
                            .appendTo(ul);
                        return elem;
                    };
                },
            });
            $('#search_customer').keyup(function() {
                if ($('#search_customer').val() === '') {
                    $("ul.list-customer").hide();
                    $(".customer__popup--create").addClass('d-none');
                    selectedCustomer('', '', '#customer_id', '#search_customer');
                }
            });
        });

        function selectedCustomer(id, name, input_id, input_name) {
            $(input_id).val(id);
            $(input_name).val(name);
        }
        // search and selected customer end
        // add new customer start
        var callAddCustomer = (name, tel, address) => {
            $.ajax({
                type: "post",
                url: '{{ route('call-ajax-add-customer') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: name,
                    tel: tel,
                    address: address,
                },
                dataType: "json",
                success: function(response) {
                    if (parseInt(response['status']) == 1) {
                        $('#modalAddCustomer').modal('hide');
                        $('#modalAddCustomer .modal__notification').addClass('d-none').text('');
                        $('#customer_id').val(response['result']['id']);
                        $('#search_customer').val(response['result']['name']);
                        alert(response['notification']['messages']);
                    } else {
                        $('#modalAddCustomer .modal__notification').removeClass('d-none').text(response[
                            'notification']['messages']);
                    }
                }
            });
        }
        // add new customer end
        //search and seletecd product start
        $(function() {
            // Single Select
            $("#search_product").autocomplete({
                classes: {
                    "ui-autocomplete": "list-product"
                },
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: '{{ route('call-ajax-product') }}',
                        type: 'post',
                        dataType: "json",
                        data: {
                            title: request.term,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(data) {
                            response(data['result']);
                        }
                    });
                },
                select: function(event, ui) {
                    // $('#search_product').val(ui.item.title,positionIdCurrent,); // display the selected text
                    // console.log($(this).data('layout'));
                    // selectedproduct(ui.item.id, ui.item.name, '#product_id', '#search_product');
                    $("ul.list-product").hide();
                    return false;
                    // console.log(ui.item.url)
                    // // redirect to url
                    // window.location = ui.item.url
                },
                close: function(event, ui) {
                    if (!$("ul.list-product").is(":visible")) {
                        $("ul.list-product").show();
                    }
                },
                create: function() {
                    $(this).data('ui-autocomplete')._renderItem = function(ul, item) {
                        elem = $('<li class="category_item_title">')
                            .append('<a onclick="addProductItem(\'' + item.id + '\',\'' + item
                                .title +
                                '\',\'' + item.quantity + '\',\'' + item.price_sale + '\')"  href="javascript:void(0)">' + item
                                .title + ', Tồn kho: ' + item.quantity + '</a>')
                            .append('</li>')
                            .appendTo(ul);
                        return elem;
                    };
                },
            });
            $('#search_product').keyup(function() {
                if ($('#search_product').val() === '') {
                    $("ul.list-product").hide();
                    // $(".product__popup--create").addClass('d-none');
                    // selectedproduct('', '', '#product_id', '#search_product');
                }
            });
        });

        function addProductItem(id, title, quantity,price) {
        
            if (quantity > 0 && $("#product-id-"+id).length == 0) {
                $('#order__list').append(
                    `            <div class="order__item text-success d-flex align-items-center">
                                              <input type="hidden"  data-quantity="1" data-price="`+price+`" id="product-id-`+id+`" name="product-id[]"  value='{"id":`+id+`,"quantity":`+1+`}'>
                                             <div class="w-75">
                                              <div>
                                                <span class="w-100 d-block">
                                                  <i class="fas fa-check "></i>  `+title+`
                                                </span>
                                                <div class="w-100 d-block text-center">
                                                    <button type="button" onclick="$(this).next('input').val(    ($(this).next('input').val()-1) == 0?1 : ($(this).next('input').val()-1)   );updateProductQuantity(`+id+`);  " class="btn rounded-0 shadow-none">
                                                        <i class="fas fa-minus    "></i>
                                                    </button>
                                                    <input class="text-center" id="product-quantity-`+id+`" type="number" value="1" min="1" max="`+quantity+`">
                                                    <button type="button" onclick="$(this).prev('input').val((parseInt($(this).prev('input').val()) +1 ) > parseInt($(this).prev('input').attr('max') )?$(this).prev('input').attr('max') : ( parseInt($(this).prev('input').val())+1)   );updateProductQuantity(`+id+`); " class="btn rounded-0 shadow-none">
                                                        <i class="fas fa-plus    "></i>
                                                    </button>
                                                </div>
                                                <div>
                                                  <span id="product-price-`+id+`">`+((Number(price).toLocaleString('en-US')) + 'đ')+`</span>
                                                 </div>
                                         
                                              </div>
                                             </div>
                                             <div class="w-25 ">
                                                 <button onclick="removeProductQuantity(`+id+`)" class="btn shadow-none text-danger float-right font-weight-bold">
                                                   <i class="fas fa-times    "></i>
                                                    </button>
                 
                                             </div>
                                          </div>`
                );
                priceOrder();
            } else {
                alert("Sản phẩm đã hết hàng hoặc đã tồn tại trong đơn hàng");
            }

        }
        //search and seletecd product end
        function updateProductQuantity(id) {
           $("#product-id-"+id).val('{"id": '+id+',"quantity": '+$("#product-quantity-"+id).val()+' }');
           $("#product-id-"+id).data('quantity',$("#product-quantity-"+id).val());
           $("#product-price-"+id).html(Number($("#product-quantity-"+id).val()*$("#product-id-"+id).data('price') ).toLocaleString('en-US') + 'đ');
           priceOrder();
        }
        function priceOrder(){
            var total = 0;
            $("[name='product-id[]']").each(function (index, element) {
                total += $(this).data('quantity') * $(this).data('price');
           });
           if($("[name='product-id[]']").length > 0){

           $('#order-price').text(Number(total).toLocaleString('en-US') + 'đ');
           }else{
            $('#order-price').text('0đ');

           }
        }
        function removeProductQuantity(id) {
           $("#product-id-"+id).parent().remove();
           priceOrder();
        }
    </script>
@endsection
