@extends('app')
@section('content')
    <div class="container h--100vh">
        <div class="row justify-content-center align-items-center h-100 ">
            <div class="card col-md-6 col-12 rounded-0 ">
                <div class="card-header bg-primary text-white font-weight-bold text-uppercase">
                    {{ __('lang.' . (@$item->id != '' ? 'Update' : 'Create') . '_product') }}
                </div>
                <div class="card-body">

                    @if (session('notification'))
                        <div class="alert alert-{{ session('notification')['status'] }} text-center" role="alert">
                            <strong>{{ session('notification')['message'] }}</strong>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('product-update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ @$item->id }}">
                        <div class="form-group row justify-content-center flex-column align-items-center">

                            <label for="thumbnail" class="btn bg--default2 rounded-0 text-dark">
                                <img class="thumbnail item__thumbnail"
                                    src="{{ file_exists(@$item->thumbnail) && !empty(@$item->thumbnail) ? asset(@$item->thumbnail) : config('app.url') . '/images/no-image.png' }}"
                                    alt="">Tải hình đại diện
                            </label>
                            <input accept=".png,.jpg,.jpeg" type="file" class="form-control-file w-auto d-none"
                                name="thumbnail" id="thumbnail" placeholder="Select avatar" aria-describedby="fileHelpId">
                        </div>
                        @for ($i = 1; $i < 4; $i++)
                        <div class="form-group row">
                         <label for="category_id_{{$i}}" class="col-md-4 col-form-label text-md-right">Cấp danh mục {{$i}}
                         </label>
                         <div class="col-md-6">
                             <select class="form-control select-category" name="category_id_{{$i}}" id="category_id_{{$i}}" data-level={{$i}}>
                                 <option value="">Chọn</option>
                                 @foreach ($arr_level[$i] as $r_category)
                                 @if (@$item->id == '')
                                  <option {{$i == 1  ? '' : 'style=display:none;' }} {{$i != 1 ? 'data-parent='.$r_category->{'level_id_'.($i-1)} : ""}} value="{{$r_category->id}}" >{{$r_category->title}}</option>
                                  @else
                                  <option  {{$r_category->id == $item->{'category_id_'.$i}? 'selected' : ( ($i != 1 && $item->{'category_id_'.$i} == "") || ($item->{'category_id_'.$i} != '' && $r_category->{'level_id_'.($i-1)} != $item->{'category_id_'.($i-1)})  ?  'style=display:none;'  : '' ) }}     {{$i != 1 ? 'data-parent='.$r_category->{'level_id_'.($i-1)} : ""}} value="{{$r_category->id}}" >{{$r_category->title}}</option>
                                 @endif
                                 @endforeach
                             </select>
                             @error('category_id_'.$i)
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>
                        @endfor
                        <div class="form-group row">
                            <label for="title"
                                class="col-md-4 col-form-label text-md-right">{{ __('lang.Product_title') }}
                            </label>
                            <div class="col-md-6">
                                <input id="title" type="text"
                                    class="form-control shadow-none @error('title') is-invalid @enderror" name="title"
                                    required autocomplete="new-title" value="{{ @$item->title }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('lang.Price') }}
                            </label>
                            <div class="col-md-6">
                                <input id="price" type="number"
                                    class="form-control shadow-none @error('price') is-invalid @enderror" name="price"
                                     autocomplete="new-price" value="{{ @$item->price }}">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price_sale" class="col-md-4 col-form-label text-md-right">{{ __('lang.Price_sale') }}
                            </label>
                            <div class="col-md-6">
                                <input id="price_sale" type="number"
                                    class="form-control shadow-none @error('price_sale') is-invalid @enderror" name="price_sale"
                                     autocomplete="new-price_sale" value="{{ @$item->price_sale }}">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('lang.Quantity') }}
                            </label>
                            <div class="col-md-6">
                                <input id="quantity" type="number"
                                    class="form-control shadow-none @error('quantity') is-invalid @enderror" name="quantity"
                                     autocomplete="new-quantity" value="{{ @$item->quantity }}">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="specification" class="col-md-4 col-form-label text-md-right">{{ __('lang.Specification') }}
                            </label>
                            <div class="col-md-6">
                               
                                <select class="form-control" name="specification" id="specification">
                                  <option value="Bin" {{ @$item->specification == 'Bin' || @$item->id == '' ? 'selected' : '' }}>
                                    Thùng</option>
                                  <option value="Box" {{ @$item->specification == 'Box' && @$item->id != '' ? 'selected' : '' }}>
                                    Hộp</option>
                                  <option value="Piece" {{ @$item->specification == 'Piece' && @$item->id != '' ? 'selected' : '' }}>
                                    Cái</option>
                                  <option value="Pill" {{ @$item->specification == 'Pill' && @$item->id != '' ? 'selected' : '' }}>
                                    Viên</option>
                                </select>

                                @error('specification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                          <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('lang.Status') }}
                          </label>
                          <div class="col-md-6">

                              <select class="form-control" name="status" id="status">
                                  <option value="1" {{ @$item->status == 1 || @$item->id == '' ? 'selected' : '' }}>
                                      Bật</option>
                                  <option value="0" {{ @$item->status == 0 && @$item->id != '' ? 'selected' : '' }}>
                                      Tắt</option>

                              </select>

                              @error('status')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
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
        <script  type="text/javascript">
    var level = 4;
    $('.select-category').on('change', function () {
        var except_id = '' ;
        for (let index = 1; index <= parseInt($(this).data('level')); index++) {
            except_id += ':not(#category_id_'+index+')';
        }
        $('.select-category'+except_id+'').val('');
        $('.select-category'+except_id+' option:not(:first)').css('display','none');
        selectLevelId($(this).find(":selected").val());
    });
    var selectLevelId = (id)=>{
        $($('*[data-parent='+id+']')).each(function (index, element) {
           $(this).removeAttr('style');
        });
    }
    </script>
@endsection
