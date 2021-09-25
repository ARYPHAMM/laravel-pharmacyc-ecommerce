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
        <div class="w-100 mb-1">
            <a class="btn btn bg--default4 text-white border-0 rounded-0 text-capitalize"
                href="{{ route('post-edit') }}"><i class="fas fa-user-plus    "></i> Thêm bài viết mới</a>
        </div>
        <table class="table__admin--custom table  w-100">
            <thead class="thead-dark w-100 d-block">
                <tr class="d-flex justify-content-center align-items-center">
                    <th class="col-1 text-center d-flex align-items-center
                justify-content-center">STT</th>
                    <th class="col-3 d-flex align-items-center
                justify-content-center">Tên danh mục</th>
                    <th class="col-2 d-flex align-items-center
                justify-content-center">Photo</th>
                    <th class="col-4 d-flex align-items-center
                justify-content-center">Trạng thái</th>
                    <th class="col-2 d-flex align-items-center
                justify-content-center">
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody class="w-100 d-block">
                @foreach ($items as $key => $item)
                    <tr class="d-flex justify-content-center r">
                        <td class="col-1 d-flex align-items-center col-1 break-all justify-content-center">
                            {{ $key + 1 }}</td>
                        <td class="col-3 d-flex align-items-center col-1 break-all justify-content-center">
                            {{ $item->title }}</td>
                        <td class=" col-2 d-flex align-items-center col-1 break-all justify-content-center"><img height="50"
                                src="{{ asset($item->post()->first()->thumbnail) }}" alt=""></td>
                        <td class="col-4 d-flex align-items-center col-1 break-all justify-content-center flex-column">
                            <div class="d-flex flex-column">
                                @php
                                    $table = 'tbl_post';
                                @endphp
                                @foreach ($config_page['status'] as $key => $r_status)
                                    @php
                                        $id = @$item->post()->first()->id;
                                        $value = @$item->post()->first()->$r_status;
                                    @endphp
                                    @include('admin.layout.status')
                                @endforeach
                            </div>
                        </td>
                        <td class=" col-2 d-flex align-items-center col-1 break-all justify-content-center">
                            <div class="d-flex  w-100">
                                <a href="{{ route('post-edit') . '?id=' . $item->post()->first()->id }}"
                                    class="ml-1 mr-1 btn btn-warning"><i class="fas fa-edit    "></i></a>
                                <a href="{{ route('post-remove', ['id' => $item->post()->first()->id]) }}"
                                    class="ml-1 mr-1 btn btn-danger"><i class="fas fa-trash    "></i></a>
                            </div>
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
