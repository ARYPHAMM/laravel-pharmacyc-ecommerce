<?php

namespace App\Http\Controllers\admin;

use App\Models\Order as orderDB;
use App\Models\OrderDetail as orderDetailDB;
use App\Http\Controllers\Controller;
use Aws\Result;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class Order extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function edit($id)
    {
        $order = orderDB::find($id);
        $orderDetail = $order->orderDetails()->get();
        foreach ($orderDetail as $key => $r_product) {
            $temp = $r_product->product()->first()->productDetail($this->default_lang_id);
            $orderDetail[$key]->total_price = ($orderDetail[$key]->price != 0 && $orderDetail[$key]->price != '') ? $r_product->quantity * $orderDetail[$key]->price : 0;
            $order->cart_total_price += ($orderDetail[$key]->price != 0 && $orderDetail[$key]->price != '') ? $r_product->quantity * $orderDetail[$key]->price : 0;
            $orderDetail[$key]->total_price_sale = ($orderDetail[$key]->price_sale != 0 && $orderDetail[$key]->price_sale != '') ? $r_product->quantity * $orderDetail[$key]->price_sale : 0;
            $order->cart_total_price_sale += ($orderDetail[$key]->price_sale != 0 && $orderDetail[$key]->price_sale != '') ? $r_product->quantity * $orderDetail[$key]->price_sale : 0;


            $orderDetail[$key]->title = $temp->title;
            $orderDetail[$key]->thumbnail = $temp->thumbnail;
            $orderDetail[$key]->url = $temp->url;
        }

        $order->orderDetail = $orderDetail;
        return view('admin.order.edit', ['order' => $order]);
    }
    public function update($id)
    {
        $order = orderDB::find($id);
        $order->update(array("status" => "1"));

        $alert = array('title' => 'Câp nhật đơn hàng thành công!', 'status' => 'success');

        return redirect()->route('order-list')->with('session-notification', $alert);
    }

    public function list(Request $request)
    {
        $orderList = orderDB::all();
        foreach ($orderList as $key_order =>  $r_order) {
            $order_detail = array();
            foreach ($r_order_temp = $r_order->orderDetails()->get()  as $key => $r_product) {
                $temp = $r_product->product()->first()->productDetail($this->default_lang_id);
                $r_order_temp[$key]->total_price = ($r_order_temp[$key]->price != 0 && $r_order_temp[$key]->price != '') ? $r_product->quantity * $r_order_temp[$key]->price : 0;
                $orderList[$key_order]->cart_total_price += ($r_order_temp[$key]->price != 0 && $r_order_temp[$key]->price != '') ? $r_product->quantity * $r_order_temp[$key]->price : 0;
                $r_order_temp[$key]->total_price_sale = ($r_order_temp[$key]->price_sale != 0 && $r_order_temp[$key]->price_sale != '') ? $r_product->quantity * $r_order_temp[$key]->price_sale : 0;
                $orderList[$key_order]->cart_total_price_sale += ($r_order_temp[$key]->price_sale != 0 && $r_order_temp[$key]->price_sale != '') ? $r_product->quantity * $r_order_temp[$key]->price_sale : 0;


                $r_order_temp[$key]->title = $temp->title;
                $r_order_temp[$key]->thumbnail = $temp->thumbnail;
                $r_order_temp[$key]->url = $temp->url;
                $order_detail[] = $r_order_temp[$key];
            }
            $orderList[$key_order]->orderDetail = $order_detail;
        }
        // pagination start
        // $product =  new Paginator($product,count($product),4,@$request->page);
        $total = count($orderList); // total count of the set, this is necessary so the paginator will know the total pages to display
        $page = $request->page ?? 1; // get current page from the request, first page is null
        $perPage = 5; // how many items you want to display per page?
        $offset = ($page - 1) * $perPage; // get the offset, how many items need to be "skipped" on this page
        $items = array_slice($orderList->toArray(), $offset, $perPage); // the array that we actua
        $orderList =  new LengthAwarePaginator($items, $total, $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query()
        ]);
        return view('admin.order.list', ['items' => $orderList]);
    }
}
