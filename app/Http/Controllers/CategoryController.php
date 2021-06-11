<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list(Request $request)
    {
        $items = Category::paginate(10);
        return view('category.list', ['items' => $items]);
    }
    public function edit($id)
    {
        if (Category::find($id)) {
            return view('category.edit', ['item' => Category::find($id)]);
        } else {
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
            'title' => _('lang.Category_title'),
            'status' => _('lang.Status'),
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $notification = array('status' => 'success', 'message' => 'Tạo mới thành công');
        $data = [
            'title' => $request->title,
            'status' => $request->status,
            'level' => $request->level
        ];

        if ($request->id == '') {
            Category::create(
                $data
            );
        } else {
            $notification = array('status' => 'success', 'message' => 'Cập nhật thành công');
         
            for ($i = $request->level; $i <= 3; $i++) {
                    $data['level_id_' . $i] = null;
           
            }
            Category::where('id', $request->id)->update($data);
        }
        return redirect('category/' . ($request->id != '' ? 'edit/' . $request->id : 'list'))->with('notification', $notification);
    }
    public function create()
    {
        return view('category.edit');
    }
    public function classify($level)
    {
        $items = Category::where('level', $level)->paginate(10);
        return view('category.classify', ['items' => $items]);
    }
    public function classifyEdit($level, $id)
    {
        $arr_level = array();
        $item = Category::find($id);
        for ($i=1; $i < $level; $i++) { 
            $arr_level[$i] = Category::where('level', $i)->get();
        }
        return view('category.classify-edit', ['item' => $item, 'arr_level' => $arr_level]);
    }
    public function classifyUpdate(Request $request, $level)
    {
        $notification = array('status' => 'success', 'message' => 'Cập nhật danh mục thành công!');
        $data = array();
        for ($i = 1; $i < $level; $i++) {
            if ($request->has('level_id_' . $i)) {
                $data['level_id_' . $i] = $request->{'level_id_' . $i};
            }
        }

        Category::where('id', $request->id)->update($data);
        return redirect()->back()->with('notification', $notification);
    }
    public function remove($id)
    {
        Category::destroy($id);
        $notification = array('status' => 'success', 'message' => 'Xóa danh mục thành công');
        return redirect()->route('category-list')->with('notification', $notification);
    }
}
