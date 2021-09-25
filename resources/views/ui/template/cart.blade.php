@extends('ui.index')
@section('content')
@include('ui.template.layout.breadcrumb')
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <h3 class="text-success text-uppercase text-center">Giỏ hàng</h3>
            <div class="cart__load d-block m-auto">
                <div class="cart__wrapper">
                    @foreach($row_cart['product'] as $r_product)
                    <div class="cart__item d-flex">
                        <div class="cart__item--left1">
                            <a href="{{config('app.APP_URL').@$r_product['url']}}">
                                <img src="{{$r_product['thumbnail']}}" alt="">
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
                                        Số lượng</b>
                                </div>
                                <button onclick="$(this).next().val(  $(this).next().val() == 1? 1 : ($(this).next().val() -1) );updateCart({id: $(this).next().data('id'),quantity: $(this).next().val() });" class="btn btn__control--quantity border-0 boxshadow--none  outline--none">
                                    <i class="fas fa-minus    "></i>
                                </button>
                                <input data-id="{{$r_product->id}}" onkeyup="$(this).val($(this).val().replace(/[^0-9,.]+/g, ''));updateCart({id: $(this).data('id'),quantity: $(this).val() });" class="form-control cart_quantity text-center" type="number" value="{{$r_product->quantity}}" min="1" max="10">
                                <button onclick="$(this).prev().val(  $(this).prev().val() == $(this).prev().attr('max') ? $(this).prev().attr('max') : ( parseInt($(this).prev().val()) + 1) );updateCart({id: $(this).prev().data('id'),quantity: $(this).prev().val() });" class="btn btn__control--quantity border-0 boxshadow--none  outline--none">
                                    <i class="fas fa-plus    "></i>
                                </button>

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
            </div>
            <div class="cart__totalPrice text-right mt-1 mb-1">
                <b class="font-weight-cart"> Tổng tiền: </b> <span class="text-danger font-weight-bold">{{number_format($row_cart['cart_total_price_sale'], 0)}}</span> <del>{{number_format($row_cart['cart_total_price'], 0)}}</del>
            </div>
            <div class="w-100 d-flex justify-content-end">
                {{ $row_cart['product']->links('vendor.pagination.bootstrap-4-cart') }}
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <form method="post" action="{{route('save-cart')}}">
                @csrf
                <h3 class="text-success text-uppercase ">Đặt hàng</h3>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname">Họ</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Nhập họ...">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname">Tên</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nhập tên đệm và tên ...">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tel">Số điện thoại</label>
                        <input type="text" class="form-control" id="tel" name="tel" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputState">Tỉnh thành</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputState">Quận/huyện</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content">Nội dung</label>
                    <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                </div>
                <!-- <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div> -->
                <button type="submit" class="btn btn-success rounded-0 border-0">Đặt hàng</button>
            </form>
        </div>
    </div>
</div>


@endsection