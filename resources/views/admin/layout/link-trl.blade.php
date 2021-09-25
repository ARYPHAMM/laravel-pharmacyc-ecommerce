<div class="input-lang">
    <label class="text-uppercase font-weight-bold" for="{{ $r_input }}_{{ $r_lang['url'] }}">
        Nhập liên kết {{ $key }} {{ $r_lang['title'] }}
    </label>
    <input type="text" class="form-control outline--none  boxshadow--none rounded-0" name="{{ $r_input }}_link_{{ $r_lang['url'] }}" id="{{ $r_input }}_link_{{ $r_lang['url'] }}" 
    value="<?php echo isset($item_layout)? $item_layout : ''?>" 
    
    aria-describedby="helpId" placeholder="Liên kết {{ $key }}">
</div>
