@extends('app')
@section('content')
    
<div class="container h--100vh">
    <div class="row justify-content-center align-items-center h-100 w-100">
        <div class="card w-75">
            <div class="card-header bg-primary text-white font-weight-bold text-uppercase">
                {{ __('lang.' . (@$item->id != '' ? 'Update' : 'Create') . '_category') }} {{@$item->title}}
            </div>
            <div class="card-body">

                @if (session('notification'))
                    <div class="alert alert-{{ session('notification')['status'] }} text-center" role="alert">

                        <strong>{{ session('notification')['message'] }}</strong>

                    </div>
                @endif
                <form method="POST" action="{{ route('category-classify-update',['level'=>request()->level]) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ @$item->id }}">
             
                   @for ($i = 1; $i < request()->level; $i++)
                   <div class="form-group row">
                    <label for="level_id_{{$i}}" class="col-md-4 col-form-label text-md-right">Cấp danh mục {{$i}}
                    </label>
                    <div class="col-md-6">
                        <select class="form-control" name="level_id_{{$i}}" id="level_id_{{$i}}" data-level={{$i}}>
                            <option value="">Chọn</option>
                            @foreach ($arr_level[$i] as $r_category)
                              <option {{$r_category->{'level_id_'.($i-1)} == $item->{'level_id_'.($i-1)}? '' : 'style=display:none;' }} {{$i != 1 ? 'data-parent='.$r_category->{'level_id_'.($i-1)} : ''}} value="{{$r_category->id}}" {{$item->{'level_id_'.$i} == $r_category->id? 'selected' : ''}} >{{$r_category->title}}</option>
                            @endforeach
                        </select>
                        @error('level_id_'.$i)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                   @endfor
                   
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
    var level = {{request()->level}};
    $('select').on('change', function () {
        var except_id = '' ;
        for (let index = 1; index <= parseInt($(this).data('level')); index++) {
            except_id += ':not(#level_id_'+index+')';
        }
        $('select'+except_id+'').val('');
        $('select'+except_id+' option:not(:first)').css('display','none');
        selectLevelId($(this).find(":selected").val());
    });
    var selectLevelId = (id)=>{
        $($('*[data-parent='+id+']')).each(function (index, element) {
           $(this).removeAttr('style');
        });
    }
    </script>
@endsection
