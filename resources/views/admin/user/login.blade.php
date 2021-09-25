@extends('admin.index')
@section('content')

    <form action="{{ route('user-check') }}" method="POST" class="col-md-5 col-12 d-flex flex-column m-auto">
        @csrf
        @if (session('session-notification'))
        <div class="alert alert-{{ session('session-notification')['status'] }} text-center" role="alert">
            <strong>{{ session('session-notification')['title'] }}</strong>
            <button type="button" class="close position-relative line__height--0" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @endif
        <h3>
           <span> Đăng nhập </span>
        </h3>
        <div class="form-group">
            <input type="email" class="form-control" name="email" aria-describedby="helpId" placeholder="Email">

        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="" placeholder="Password">
        </div>

        {{-- <div class="form-group">
          <textarea class="form-control" name="" id="" rows="3"></textarea>
        </div> --}}
        <div class="form-group">
        <button type="submit" name="" id="" class="btn btn-primary d-block ml-auto">
            Đăng nhập
        </button>
      </div>
    </form>
    @if (session('register-success'))
    {{ session('register-success') }}

@endif
@endsection