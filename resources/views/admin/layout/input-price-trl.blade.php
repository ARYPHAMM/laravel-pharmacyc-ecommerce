<div class="input-lang">
    <label class="text-uppercase font-weight-bold" for="{{ $r_input }}_{{ $r_lang['url'] }}">
        Nhập {{ $key }} {{ $r_lang['title'] }}
    </label>
    <input type="text" class="form-control outline--none  boxshadow--none rounded-0 {{$r_input}}" name="{{ $r_input }}_{{ $r_lang['url'] }}" id="{{ $r_input }}_{{ $r_lang['url'] }}" value="{{@$item_lang[$r_lang['id']][$r_input]}}<?php echo isset($item_layout) ? @$item_layout : '' ?>" aria-describedby="helpId" placeholder="{{ $key }}">
    <span style="display: inline-block; margin-left: 5px; width: 100px; text-align: right; letter-spacing: 0.5px;color:red;margin-top: 5px;">
        {{number_format(@$item_lang[$r_lang['id']][$r_input], 0)}} đ
    </span>
</div>