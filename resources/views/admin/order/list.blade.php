@extends('admin.index')
@section('content')
@if (session('session-notification'))
<div class="w-50 d-block m-auto mt-1">
    <div class="alert alert-{{ session('session-notification')['status'] }} text-center" role="alert">
        <strong>{{ session('session-notification')['title'] }}</strong>
    </div>
</div>
@endif
<div class="mt-1 pl-1 pr-1">

    <table class="table__admin--custom table  w-100">
        <thead class="thead-dark w-100 d-block">
            <tr class="d-flex justify-content-center align-items-center">
                <th class="col-1 text-center d-flex align-items-center
        justify-content-center">STT</th>
                <th class="col-2 d-flex align-items-center
        justify-content-center">Mã đơn</th>
                <th class="col-2 d-flex align-items-center
        justify-content-center">Người đặt</th>
                <th class="col-3 d-flex align-items-center
        justify-content-center">Trạng thái</th>
                <th class="col-2 d-flex align-items-center
        justify-content-center">
                    Ngày đặt
                </th>
                <th class="col-2 d-flex align-items-center
        justify-content-center">
                    &nbsp;
                </th>
            </tr>
        </thead>
        <tbody class="w-100 d-block">
            @foreach ($items as $key => $item)
            <tr class="d-flex ">
                <td class="col-1 d-flex justify-content-center">
                    {{$key+1}}
                </td>
                <td class="col-2 d-flex justify-content-center">
                    {{$item['id']}}
                </td>
                <td class="col-2 d-flex justify-content-center">
                    {{$item['fullname']}}
                </td>
                <td class="col-3 d-flex justify-content-center">
                    @if ($item['status'] > 0)
                    <span>
                        Đã xác nhận
                    </span>
                    @else
                    <span class="text-success">
                        Mới
                    </span>
                    @endif
                </td>
                <td class="col-2 d-flex justify-content-center">

                    {{ date('d-m-Y H:m', strtotime(@$item['created_at'])) }}
                </td>
                <td class="col-2 d-flex justify-content-center">
                    <a href="{{route('order-edit',['id'=>$item['id'] ])}}">
                        <i class="fas fa-edit   text-danger "></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <div class="admin__paging">
            {{ $items->appends(Request::except('page'))->links() }}
        </div>
    </div>
</div>
@endsection