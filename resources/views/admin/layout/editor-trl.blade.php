<div class="text-lang">
    <label class="text-uppercase font-weight-bold" for="{{ $r_input }}_{{ $r_lang['url'] }}">
        Nhập {{ $key }} {{ $r_lang['title'] }}
    </label>
    <textarea id="{{ $r_input }}_{{ $r_lang['url'] }}" name="{{ $r_input }}_{{ $r_lang['url'] }}" class="editor">
        {{@$item_lang[$r_lang['id']][$r_input]}}<?php echo isset($item_layout)? $item_layout : ''?>
    </textarea>
</div>
