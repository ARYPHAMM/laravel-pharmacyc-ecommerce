<div class="form-group">
    <label class="text-uppercase font-weight-bold" for="{{ $r_select['default'] }}">{{ $key }}</label>
    <select class="form-control rounded-0 outline--none boxshadow--none" name="{{ $r_select['default'] }}"
        id="{{ $r_select['default'] }}">
        <option selected value="">Chọn</option>
        @foreach ($r_select as $key_select => $r_item_select)
            @if($key_select == 'default') 
              <?php continue; ?>
            @endif
        <option {{@$item[$r_select['default']] == $r_item_select? 'selected' : ''}} value="{{$r_item_select}}">
          {{$key_select}}
        </option>
        @endforeach
    </select>
</div>
