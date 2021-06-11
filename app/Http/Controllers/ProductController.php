<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 


class ProductController extends Controller
{
    public function list(Request $request)
    {
        $items = Product::paginate(10);
        return view('product.list',['items' => $items]);
    }
    public function edit($id)
    {

        $arr_level = array();
        for ($i=1; $i < 4; $i++) { 
            $arr_level[$i] = Category::where('level', $i)->get();
        }
        if(Product::find($id)){
            return view('product.edit',['item'=>Product::find($id),'arr_level'=>$arr_level]);
        }else{
            return redirect()->route('home');
        }
    }
    public function update(Request $request) // xử lý thêm mới và cập nhật
    {
       
        $rules = [
            'title' => 'required|string',
            'status' => 'required',

        ];
        $customMessages = [
            'string' => ':attribute phải là chuỗi',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages, [
            'title' => _('lang.Product_title'),
            'status' => _('lang.Status'),
        ]);

        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $notification =array('status' => 'success','message' => 'Tạo mới thành công');
        $thumbnail = "";
        $data = [
            'title' => $request->title,
            'status' => $request->status,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'price_sale' => $request->price_sale,
            'specification' => $request->specification
            
        ];
        for ($i = 1; $i < 4; $i++) {
            if ($request->has('category_id_' . $i)) {
                $data['category_id_' . $i] = $request->{'category_id_' . $i};
            }
        }

        if ($request->hasFile('thumbnail')) {
           
            $file = $request->file('thumbnail');
            $file_name = $file->getClientOriginalName('image');
            $extention = $file->getClientOriginalExtension('image');

            if(!is_dir('upload/product')){ // Kiểm tra thư mục đã tồn tại
                mkdir('upload/product', 0777, true);
            }
            if (strcasecmp($extention, 'jpg') === 0 || strcasecmp($extention, 'png') === 0 || strcasecmp($extention, 'jpeg') == 0) {
                $name = Str::random(4) . "_" . $file_name;
                while (file_exists("upload/product/" . $name)) {
                    $name = Str::random(4) . "_" . $file_name;
                }
                $file->move('upload/product', $name);
               
                $thumbnail = "upload/product/" . $name;
                $data['thumbnail'] = $thumbnail;
            }
        }
        if ($request->id == '') {
            Product::create( $data  );
            
        }else{
            $notification = array('status' => 'success','message' => 'Cập nhật thành công');
            if($thumbnail != ""){
                File::delete(Product::find($request->id)->thumbnail);
            }
            Product::where('id',$request->id)->update($data);
        }
        return redirect('product/' . ($request->id != '' ? 'edit/' . $request->id : 'list'))->with('notification', $notification);
    }
    public function create()
    {
        $arr_level = array();
        for ($i=1; $i < 4; $i++) { 
            $arr_level[$i] = Category::where('level', $i)->get();
        }
        return view('product.edit',['arr_level'=>$arr_level]);
    }
    public function remove($id)
    {
        Product::destroy($id);
        File::delete(@Product::find($id)->thumbnail);
        $notification = array('status' => 'success','message' => 'Xóa danh mục thành công');
        return redirect()->route('product-list')->with('notification', $notification);
    }
}
