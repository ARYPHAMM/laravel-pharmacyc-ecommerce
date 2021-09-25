@extends('admin.index')
@section('content')
    <div class="mt-1">
        <form action="{{ route('user-update') }}" method="POST" enctype="multipart/form-data" class="w-50 d-block m-auto">
            @if (session('session-notification'))
            <div class="alert alert-{{ session('session-notification')['status'] }} text-center" role="alert">
                <strong>{{ session('session-notification')['title'] }}</strong>
            </div>
        @endif
            @csrf
            <h3 class="user__form--title">
                Thêm mới
            </h3>
            <div onclick="$('#thumbnail').trigger('click')" class="form-group user__avatar position-relative">
                <img class="user__avatar--image d-none" src="" alt="">
                <span class="user__avatar--default d-flex position-absolute">
                    <i class="fas fa-user-alt    "></i>
                </span>
            </div>
            <div class="form-group  mb-0 ">
                <label for="thumbnail" class="btn bg--default2 rounded-0 text-white">Tải hình đại diện</label>
                <img src="" alt="">
                <input accept=".png,.jpg,.jpeg" type="file" class="form-control-file d-none" name="thumbnail" id="thumbnail"
                    placeholder="Select avatar" aria-describedby="fileHelpId">
            </div>
            <div class="form-group">
                <input type="text" class="form-control rounded-0 outline--none boxshadow--none" name="username" id=""
                    aria-describedby="helpId" placeholder="Tên đăng nhập">

            </div>
            <div class="form-group">
                <input type="password" class="form-control rounded-0 outline--none boxshadow--none" name="password" id=""
                    placeholder="Mật khẩu">
            </div>
            <div class="form-group">
                <input type="email" class="form-control rounded-0 outline--none boxshadow--none" name="email" id=""
                    aria-describedby="emailHelpId" placeholder="Email">

            </div>
            <div class="form-group">
                <input type="date" class="form-control rounded-0 outline--none boxshadow--none" name="birthday"
                    placeholder="Ngày sinh">

            </div>
            <div class="form-group">
                <select class="custom-select" name="role" >
                    <option selected>Chọn người dùng</option>
                    <option value="2">Admin</option>
                    <option  value="3">Công tác viên</option>
                    <option value="4">Thành viên</option>
                </select>
            </div>

            <button type="submit" name="" id="" class="btn bg-success rounded-0 font-weight-bold ml-auto d-block">
                Đăng ký
            </button>
        </form>
    </div>




@endsection
