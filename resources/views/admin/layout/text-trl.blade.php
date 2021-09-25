<div class="text-lang">
    <label class="text-uppercase font-weight-bold" for="{{ $r_input }}_{{ $r_lang['url'] }}">
        Nhập {{ $key }} {{ $r_lang['title'] }}
    </label>
    <textarea name="{{ $r_input }}_{{ $r_lang['url'] }}" class="form-control outline--none  boxshadow--none rounded-0" id="{{ $r_input }}_{{ $r_lang['url'] }}" cols="30" rows="10" placeholder="{{ $key }}">{{@$item_lang[$r_lang['id']][$r_input]}}<?php echo isset($item_layout)? $item_layout : ''?></textarea>
</div>
