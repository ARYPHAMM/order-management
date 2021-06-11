<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Product;
use App\Order;
use App\OrderDetail;
use Illuminate\Support\Str;


class OrderController extends Controller
{
   public function create()
   { 
      return view('order.create');
   }
   public function list()
   {
      $items = Order::paginate(10);
      return view('order.list', ['items' => $items]);
   }
   public function view($id)
   {
      $item = Order::find($id);
      return view('order.view', ['item' => $item]);
   }
   public function edit($id)
   {
      $item = Order::find($id);
      return view('order.edit', ['item' => $item]);
   }
   public function update(Request $request)
   {

      if (@$request->id == '') {

         $data_order = [];
         foreach ($request->{'product-id'} as $product_id) {
            $product = \json_decode($product_id, true);
            $data_order[] = [
               'product_id' => $product['id'],
               'price' =>  Product::find($product['id'])->price_sale,
               'quantity' =>  $product['quantity'],
            ];
            $productUpdate = Product::find($product['id']);
            $productUpdate->quantity -= $product['quantity'];
            $productUpdate->save();
         }
         $data = [
            'customer_id' => $request->customer_id,
            'address' => $request->address_customer == 1 ? Customer::find($request->customer_id)->address : $request->address,
            'delivery_date' => strtotime($request->delivery_date),
            'serial' => Str::random(10),

         ];
         $order = Order::create($data);
         foreach ($data_order as $key =>  $r_product) {
            $data_order[$key]['order_id'] = $order->id;
            OrderDetail::create($data_order[$key]);
         }

         return redirect()->route('order-list');
      } else {
         $orderDetail = OrderDetail::where('order_id', 'like', $request->id)->get();
         if ($request->status == 'cancel') {
            foreach ($orderDetail as $key => $r_item) {
               $product = Product::find($r_item->product_id);
               $product->quantity += $r_item->quantity;
               $product->save();
            }
         } else {
            foreach ($orderDetail as $key => $r_item) {
               if ($request->has('order-product-' . $r_item->id)) {
                  if( $orderDetail[$key]->quantity < $request->{'order-product-' . $r_item->id}){
                     $product = Product::find($orderDetail[$key]->product_id);
                     $product->quantity -= ($request->{'order-product-' . $r_item->id} - $orderDetail[$key]->quantity ) ;
                     $product->save();
                  }
                  if( $orderDetail[$key]->quantity > $request->{'order-product-' . $r_item->id}){
                     $product = Product::find($orderDetail[$key]->product_id);
                     $product->quantity += ($request->{'order-product-' . $r_item->id} - $orderDetail[$key]->quantity ) ;
                     $product->save();
                  }
                  $orderDetail[$key]->quantity = $request->{'order-product-' . $r_item->id};
                  $orderDetail[$key]->save();
               }
            }
         }

      }
      Order::where('id', 'like', $request->id)->update(['status' => $request->status]);
      return redirect()->route('order-list');
   }
}
