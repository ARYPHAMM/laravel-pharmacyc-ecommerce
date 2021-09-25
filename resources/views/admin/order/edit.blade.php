@extends('admin.index')
@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="cart__success w-100">
            <h3 class="cart__title--success text-center text-success d-block">
                Đơn hàng {{$order->id}}
            </h3>
            <div class="cart__info--payment">
                <div class="d-flex">
                    <b>
                        Họ và tên người đặt :
                    </b>
                    <span class="ml-1">
                        {{$order->fullname}}
                    </span>
                </div>
                <div class="d-flex">
                    <b>
                        Email :
                    </b>
                    <span class="ml-1">
                        {{$order->email}}
                    </span>
                </div>
                <div class="d-flex">
                    <b>
                        Số điện thoại :
                    </b>
                    <span class="ml-1">
                        {{$order->tel}}
                    </span>
                </div>
                <div class="d-flex">
                    <b>
                        Đỉa chỉ :
                    </b>
                    <span class="ml-1">
                        {{$order->address}}
                    </span>
                </div>
                <div class="d-flex">
                    <b>
                        Nội dung :
                    </b>
                    <span class="ml-1">
                        {{$order->content}}
                    </span>
                </div>
                <div class="d-flex">
                    <b>
                        Ngày đặt :
                    </b>
                    <span class="ml-1">
                        {{ date('d-m-Y H:m', strtotime(@$order->created_at)) }}

                    </span>
                </div>
            </div>
            <h4 class="cart__title--success text-left text-success d-block mt-3">
                Chi tiết đơn hàng
            </h4>
            <div class="cart__detail">
                @foreach ($order->orderDetail as $r_product)

                <div class="cart__item d-flex">
                    <div class="cart__item--left1">
                        <a href="{{config('app.APP_URL').@$r_product['url']}}">
                            <img src="{{asset('/').$r_product->thumbnail}}" alt="">
                        </a>
                    </div>
                    <div class="cart__item--right1 d-flex flex-column align-items-center justify-content-around">
                        <a href="{{config('app.APP_URL').@$r_product['url']}}" class="cart__title font-weight-bold text-danger">
                            {{$r_product->title}}
                        </a>
                        <div class="d-flex flex-column w-100 cart__price">
                            <div class="d-flex">
                                <b class="font-weight-cart">Giá bán: </b>
                                <span class="ml-2 text-danger">
                                    @if ($r_product->price_sale > 0 && $r_product->price_sale != '')
                                    {{number_format($r_product->price_sale, 0)}} đ
                                    @else
                                    Liên hệ
                                    @endif
                                </span>
                                @if ($r_product->price > 0 && $r_product->price != '')
                                <del class="ml-2 font-weight-bold text-muted">
                                    {{number_format($r_product->price, 0)}} đ
                                </del>
                                @endif

                            </div>

                        </div>
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <div>
                                <b class="font-weight-cart">
                                    Số lượng: </b>
                                <span>
                                    {{$r_product->quantity}}
                                </span>
                            </div>

                        </div>
                        <div class="d-flex flex-column w-100 cart__price">

                            <div class="d-flex justify-content-end">
                                <b class="font-weight-cart">Thành tiền: </b><span class="ml-2 text-danger font-weight-bold">
                                    @if ($r_product->total_price_sale > 0 && $r_product->total_price_sale != '')
                                    {{number_format($r_product->total_price_sale, 0)}} đ
                                    @else
                                    Liên hệ
                                    @endif
                                </span>
                                @if ($r_product->price > 0 && $r_product->price != '')
                                <del class="ml-2 font-weight-bold text-muted">
                                    {{number_format($r_product->total_price, 0)}} đ
                                </del>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="cart__totalPrice text-right mt-1 mb-1">
                <b class="font-weight-cart"> Tổng tiền: </b> <span class="text-danger font-weight-bold">{{number_format($order->cart_total_price_sale, 0)}}</span> <del>{{number_format($order->cart_total_price, 0)}}</del>
            </div>
            @if($order->status == 0)
            <form action="{{route('order-update',['id'=>$order->id])}}" method="post">
                @csrf
                <button class="btn btn-success">
                    Xác nhận đơn hàng
                </button>
            </form>
            @endif
        </div>
    </div>
</div>

@endsection