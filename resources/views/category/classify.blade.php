@extends('app')
@section('content')
<div class="h--100vh">
    <div class=" h-100 w-100">
        <table class="table table-light">
            <thead>
                <tr class="d-md-flex d-none">
                    <th class="col-md-3 d-flex justify-content-center">STT</th>
                    <th class="col-md-3 d-flex justify-content-center">Tên danh mục</th>
                    <th class="col-md-1 d-flex justify-content-center">Cấp</th>
                    <th class="col-md-2 d-flex justify-content-center">Danh mục cha</th>
                    <th class="col-md-1 d-flex justify-content-center">Trạng thái</th>
                    <th class="col-md-2 d-flex justify-content-center">Sửa/xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $key => $r_item)
                <tr class="d-flex category__row">
                    <td class="col-md-3 justify-content-center d-flex">{{$key+1}}</td>
                    <td class="col-md-3 justify-content-center d-flex">{{$r_item->title}}</td>
                    <td class="col-md-1 justify-content-center d-flex">{{$r_item->level}}</td>
                    <td class="col-md-2 justify-content-center d-flex">
                        @for ($i = 1; $i < request()->level; $i++)
                        @if(@$r_item->{'categoryLevel'.$i}->title != "")
                        Cấp {{$i}}: {{$r_item->{'categoryLevel'.$i}->title}}
                    <br>
                   
                    @endif
                        @endfor
                     @if (request()->level == 1)
                         Đây là danh mục cấp 1
                     @endif
                    </td>
                    <td class="col-md-1 justify-content-center d-flex">{{$r_item->status == 1? 'Bật' : 'Tắt' }}</td>
                    <td class="col-md-2 justify-content-center d-flex">
                        <a href="{{route('category-classify-edit',['id'=>$r_item->id,'level'=>$r_item->level])}}"><i class="fas fa-edit text-success   "></i></a>
                        <div class="pl-1 pr-1">
                        </div>
                        <a href="{{route('category-remove',['id'=>$r_item->id])}}"><i class="fas fa-trash text-danger   "></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $items->links() }}
        </div>
    </div>
</div>
@endsection