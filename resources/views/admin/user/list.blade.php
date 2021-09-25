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
        <div class="w-100 ">
            <a class="btn btn bg--default4 text-white border-0 rounded-0 text-capitalize"
                href="{{ route('user-register') }}"><i class="fas fa-user-plus    "></i> Thêm người
                dùng</a>

        </div>
        <table class="table__admin--custom table table-bordered table-inverse table-responsive w-100">
            <thead class="thead-inverse w-100 d-block">
                <tr class="d-flex justify-content-center align-items-center">
                    <th class="col-1 text-center">STT</th>
                    <th class="col-3">Tài khoản</th>
                    <th class="col-2">Photo</th>
                    <th class="col-4">Email</th>
                    <th class="col-2">
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody class="w-100 d-block">
               @php
                   $index = 0;
               @endphp
                @foreach ($items as $key => $item)
                <?php if($item['id'] == @$account_current['id'] ){  ;continue; } ?>
                    <tr class="d-flex ">
                        <td class="d-flex align-items-center col-1 break-all justify-content-center">{{ ++$index }}
                        </td>
                        <td class="d-flex align-items-center col-3 text-break">{{ $item['username'] }}</td>
                        <td class="d-flex align-items-center col-2 justify-content-center"><img height="50"
                                src="{{ asset($item['thumbnail']) }}" alt=""></td>
                        <td class="d-flex align-items-center col-4">{{ $item['email'] }}</td>
                        <td class="d-flex align-items-center col-2">
                            <div class="d-flex justify-content-center w-100">
                                <a href="{{ route('user-edit') . '?id=' . $item['id'] }}" class="ml-1 mr-1 btn btn-warning"><i
                                        class="fas fa-user-edit    "></i></a>
                                <a href="{{ route('user-remove', ['id' => $item['id']]) }}"
                                    class="ml-1 mr-1 btn btn-danger"><i class="fas fa-trash    "></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div>
            <div class="admin__paging">
                {!! $items->links() !!}
            </div>
        </div>
    </div>
@endsection
