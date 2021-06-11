<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Customer;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    public function callAjax(Request $request){
        Session::put('remember_menu',$request->key);
        return response()->json(['status' => true], 200);
    }
    public function callAjaxCustomer(Request $request){
        return response()->json(['status' => 1,'result' => DB::table('customer')->where('tel','like', '%'.$request->name. '%')->orWhere('name','like', '%'.$request->name. '%')->get() ], 200);
    }
    public function callAjaxAddCustomer(Request $request){
        $customer = Customer::where('tel','=', $request->tel)->get()->toArray();
        $status = 1;
        $notification = array(
            "messages" => "Thêm khách hàng thành công",
            "label" =>"success"
        );
        if(is_array($customer) && !empty($customer)){
                 $status = 0;
                 $notification['messages'] = "Trùng số điện thoại";
                 $notification['label'] = "Danger";
        }else{
            $customer = Customer::create([
                'name' => $request->name,
                'tel' => $request->tel,
                'address' => $request->address
            ]);
        }
        return response()->json(['status' => $status,"notification"=>$notification,'result' => $customer], 200);
    }
    public function callAjaxProduct(Request $request){
        return response()->json(['status' => 1,'result' => DB::table('product')->where('title','like', '%'.$request->title. '%')->get() ], 200);
    }
}
