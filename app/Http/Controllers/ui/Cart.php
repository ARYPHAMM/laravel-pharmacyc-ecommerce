<?php

namespace App\Http\Controllers\ui;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product as productDB;
use App\Models\Order as orderDB;
use App\Models\OrderDetail as orderDetailDB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Jobs\SendOrderEmail;
use Illuminate\Support\Carbon;

class Cart extends Controller
{
    public function __construct(Controller $controller)
    {
        parent::__construct();
    }
    public function addToCart(Request $request)
    {
        $id = $request->id;
        $product = productDB::find($id)->first();
        if (!$product) {
            abort(404);
        }
        $cart = $request->session()->get('cart');
        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $id => [
                    "quantity" => 1,
                ]
            ];
        } else {
            // if cart not empty then check if this product exist then increment quantity
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $request->quantity;
            } else {
                $cart[$id] = [
                    "quantity" => 1,
                ];
            }
        }
        $request->session()->put('cart', $cart);
        return response()->json(['status' => 0, 'result' =>  $request->session()->get('cart')], 200);
    }
    public function getData(Request $request)
    {

        $category = (object)array();
        // SEO start
        $title = @$category->title;
        $seo['title'] =  @$category->title;
        $seo['thumbnail'] = @$category->thumbnail;
        $seo['fav'] = $this->information->logo;
        $seo['keyword'] = @$category->keyword;
        $seo['desc'] = @$category->desc;
        $seo['h1'] = @$category->h1;
        $seo['h2'] = @$category->h2;
        $seo['h3'] = @$category->h3;
        $information = $this->information->toArray();
        $row_breadcrumb = array("gio-hang.html" => "Giỏ hàng");
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            $row_cart = array('product' => array(), 'cart_total_price' => null, 'cart_total_price_sale' => null);
            foreach ($cart as $id => $option) {
                $temp = productDB::find($id);
                if (!$temp)
                    continue;
                $temp = $temp->productDetail($this->default_lang_id);

                $temp['quantity'] = $option['quantity'];
                $temp->total_price = ($temp->price != 0 && $temp->price != '') ? $option['quantity'] * $temp->price : 0;
                $row_cart['cart_total_price'] += ($temp->price != 0 && $temp->price != '') ? $option['quantity'] * $temp->price : 0;
                $temp->total_price_sale = ($temp->price_sale != 0 && $temp->price_sale != '') ? $option['quantity'] * $temp->price_sale : 0;
                $row_cart['cart_total_price_sale'] += ($temp->price_sale != 0 && $temp->price_sale != '') ? $option['quantity'] * $temp->price_sale : 0;

                $row_cart['product'][] = $temp;
            }

            // pagination start
            // $product =  new Paginator($product,count($product),4,@$request->page);
            $total = count($row_cart['product']); // total count of the set, this is necessary so the paginator will know the total pages to display
            $page = $request->page ?? 1; // get current page from the request, first page is null
            $perPage = 1; // how many items you want to display per page?
            $offset = ($page - 1) * $perPage; // get the offset, how many items need to be "skipped" on this page
            $items = array_slice($row_cart['product'], $offset, $perPage); // the array that we actua
            $row_cart['product'] =  new LengthAwarePaginator($items, $total, $perPage, $page, [
                'path' => $request->url(),
                'query' => $request->query()
            ]);
            // $product->setPath($request->path());
            // pagination end

            return view(config('app.template') . '.cart', ['seo' => $seo, 'title' => $title, 'information' => $information, 'row_cart' => $row_cart, "row_breadcrumb" => $row_breadcrumb]);
        } else {
            return redirect('/');
        }
    }
    public function updateCart(Request $request)
    {
        $cart = $request->session()->get('cart');
        if (isset($cart[$request->id]) && $request->quantity >= 1) {
            $cart[$request->id]['quantity'] = $request->quantity;
        } else {
            $cart[$request->id]['quantity'] = 1;
        }
        $request->session()->put('cart', $cart);
        return response()->json(['status' => 1, 'result' =>  $request->session()->get('cart')], 200);
    }
    public function saveCart(Request $request)
    {
        $data = array('firstname' => null, 'lastname' => null, 'email' => null, 'address' => null, 'content' => null, "province_id" => null, "distrist_id" => null);
        foreach ($data as $key => $r_data) {
            if ($request->has($key)) {
                $data[$key] = (is_array($request->$key) ? implode(',', $request->$key) : $request->$key);
            }
        }
        $data['fullname'] = trim($data['firstname']) . ' ' . trim($data['lastname']);

        $order = orderDB::create($data);
        if ($order) {
            $cart = $request->session()->get('cart');
            foreach ($cart as $id => $option) {
                $cartDetail = array();
                $temp = productDB::find($id);
                // if (!$temp)
                //     continue;
                $temp = $temp->productDetail($this->default_lang_id);
                $cartDetail['quantity'] = $option['quantity'];
                $cartDetail['product_id'] = $id;
                $cartDetail['price'] = $temp['price'];
                $cartDetail['price_sale'] = $temp['price_sale'];
                $cartDetail['order_id'] = $order->id;
                $cartDetail = orderDetailDB::create($cartDetail);
            }
            // $job = (new SendOrderEmail($order))->delay(Carbon::now()->addMinutes(1));
            $job = (new SendOrderEmail($order))->delay(30);
            // $job = (new SendOrderEmail($order));
            // dispatch($job)->onQueue('emails');
            // dispatch($job)->onQueue('processing')->onConnection('database');
            dispatch($job);


            // session()->forget('cart');
            return redirect()->route('cart-success', ['id' => $order->id])->with('cart-notication', "Đặt hàng thành công");
        } else {
        }
    }
    public function cartSuccess($id)
    {
        $order = orderDB::find($id);

        // session()->has('cart-notication')
        if (1) {
            $category = (object)array();
            // SEO start
            $title = @$category->title;
            $seo['title'] =  @$category->title;
            $seo['thumbnail'] = @$category->thumbnail;
            $seo['fav'] = $this->information->logo;
            $seo['keyword'] = @$category->keyword;
            $seo['desc'] = @$category->desc;
            $seo['h1'] = @$category->h1;
            $seo['h2'] = @$category->h2;
            $seo['h3'] = @$category->h3;
            $information = $this->information->toArray();
            $row_breadcrumb = array("gio-hang.html" => "Giỏ hàng");


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
          
            return view(config('app.template') . '.cart-success', ['seo' => $seo, 'title' => $title, 'information' => $information, 'order' => $order, "row_breadcrumb" => $row_breadcrumb]);
        } else {
            return redirect('/');
        }
    }
}
