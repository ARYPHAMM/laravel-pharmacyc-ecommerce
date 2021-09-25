<form action="{{ route('post-form') }}" method="post">
<div class="form-group">
@csrf
<!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
  <input type="text"
    class="form-control" name="name"  aria-describedby="helpId" placeholder="name">
    <button type="submit">
    Submit
    </button>
</div>
</form>
@if( session('success') )
{{ session('success')   }}
@endif