    @extends('admin.index')
    @section('content')
        <div class="mt-1">
            <form action="{{ route('user-update') }}" method="POST" enctype="multipart/form-data"
                class="w-50 d-block m-auto">
                @if (session('session-notification'))
                    <div class="alert alert-{{ session('session-notification')['status'] }} text-center" role="alert">
                        <strong>{{ session('session-notification')['title'] }}</strong>
                    </div>
                @endif
                @csrf
                <h3 class="user__form--title">
                    Cập nhật
                </h3>
                <input type="hidden" name="id" value="{{ @$account['id'] }}">
                <span class="color--default1 text-center w-100 font-weight-bold d-block">
                    {{ $account['username'] }}
                </span>
                <div onclick="$('#thumbnail').trigger('click')" class="form-group user__avatar position-relative">
                    <img class="user__avatar--image {{ file_exists($account['thumbnail']) && !empty($account['thumbnail']) ? '' : 'd-none' }} "
                        src="{{ file_exists($account['thumbnail']) && !empty($account['thumbnail']) ? asset($account['thumbnail']) : './assets/img/no-image.png' }}"
                        alt="">
                    @if (!file_exists($account['thumbnail']) || empty($account['thumbnail']))
                        <span class="user__avatar--default d-flex position-absolute">
                            <i class="fas fa-user-alt    "></i>
                        </span>
                    @endif
                </div>
                <div class="form-group  mb-0 ">
                    <label for="thumbnail" class="btn bg--default2 rounded-0 text-white">Tải hình đại diện</label>
                    <input accept=".png,.jpg,.jpeg" type="file" class="form-control-file d-none" name="thumbnail"
                        id="thumbnail" placeholder="Select avatar" aria-describedby="fileHelpId">
                </div>
                <div class="form-group">
                    <input type="text"
                        class="form-control rounded-0 outline--none boxshadow--none {{ @$account_current['role'] == 1 ? '' : 'disabled bg-gray' }}"
                        name="username" id="" value={{ @$account['username'] }} aria-describedby="helpId"
                        placeholder="Tên đăng nhập">
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success"
                        onclick="$('input[name=password],input[name=password_confirm]').toggleClass('disabled bg-gray');$(this).text(($(this).hasClass('btn-success')? 'Hủy' : 'Đổi mật khẩu')).toggleClass('btn-success btn-danger')">
                        Đổi mật khẩu
                    </button>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control rounded-0 outline--none boxshadow--none disabled bg-gray"
                        name="password" id="" placeholder="Mật khẩu">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control rounded-0 outline--none boxshadow--none disabled bg-gray"
                        name="password_confirm" id="" placeholder="Nhập lại mật khẩu">
                </div>
                <div class="form-group">
                    <input value={{ @$account['email'] }} type="email"
                        class="form-control rounded-0 outline--none boxshadow--none disabled bg-gray" name="email" id=""
                        aria-describedby="emailHelpId" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="date" value='{{ @$account['birthday'] }}'
                        class="form-control rounded-0 outline--none boxshadow--none" name="birthday"
                        placeholder="Ngày sinh">
                </div>
                @if ($account_current['id'] != @$account['id'])
                <div class="form-group">
                    <select class="custom-select" name="role">
                        <option value="" selected>Chọn người dùng</option>
                        <option {{ @$account['role'] == 2 ? 'selected' : '' }} value="2">Admin</option>
                        <option {{ @$account['role'] == 3 ? 'selected' : '' }} value="3">Công tác viên</option>
                        <option {{ @$account['role'] == 4 ? 'selected' : '' }} value="4">Thành viên</option>
                    </select>
                </div>
                @endif

                <button type="submit" name="" id="" class="btn bg-success rounded-0 font-weight-bold ml-auto d-block">
                    Cập nhật
                </button>
            </form>
        </div>
    @endsection
