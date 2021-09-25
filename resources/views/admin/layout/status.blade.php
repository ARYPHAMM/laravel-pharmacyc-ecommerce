<div class="d-flex justify-content-around align-items-center">
    <span class="font-weight-bold">
        {{$key}}
    </span>
    <label class="switch ml-1">
        <input  onclick="changeStatus('{{$id}}','{{$r_status}}','{{$table}}')" type="checkbox" {{$value == 1? 'checked' : ''}}>
        <span class="sliderToggle round"></span>
    </label>
</div>
