@extends('admin.index')
@section('content')
    @if (session('session-notification'))
        <div class="w-50 d-block m-auto mt-1">
            <div class="alert alert-{{ session('session-notification')['status'] }} text-center" role="alert">
                <strong>{{ session('session-notification')['title'] }}</strong>
            </div>
        </div>
    @endif
    <form action="{{route('layout-update')}}" method="post">
        <input type="hidden" name="type" value="{{request()->type}}">
        @csrf
        <button class="btn btn-success">
            Lưu
        </button>
      @foreach ($config_page as $key => $r_page)
           @if ($r_page['type'] == 'position')
               @include('admin.layout.postion')
           @elseif($r_page['type'] == 'container')
     
        
             @include('admin.layout.container')


           @endif
      @endforeach
    </form>
 
@endsection
