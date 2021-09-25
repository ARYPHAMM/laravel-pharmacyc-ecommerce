<div class="input-lang">
    <label class="text-uppercase font-weight-bold" for="{{ $r_input }}_{{ $r_lang['url'] }}">
        Nhập {{ $key }} {{ $r_lang['title'] }}
    </label>
    <input type="text" class="form-control outline--none  boxshadow--none rounded-0" name="{{ $r_input }}_{{ $r_lang['url'] }}" id="{{ $r_input }}_{{ $r_lang['url'] }}" 
    value="{{@$item_lang[$r_lang['id']][$r_input]}}<?php echo isset($item_layout)? @$item_layout : ''?>" 
    
    aria-describedby="helpId" placeholder="{{ $key }}">
</div>
