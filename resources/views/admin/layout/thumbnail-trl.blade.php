<div class="item__thumbnail mb-1">
    <label class="text-uppercase font-weight-bold">
        Thêm {{ $key }} {{ $r_lang['title'] }}
    </label>

    <img id="thumb_{{$r_input}}_{{$r_lang['url']}}"
        src="<?php echo file_exists(@$item_layout) && !empty(@$item_layout) ? asset('') . @$item_layout : asset('') . 'assets/images/no-image.png'; ?>"
        alt="Chưa có hình" onclick="openBrowser('#thumb_{{$r_input}}_{{$r_lang['url']}}', '#{{$r_input}}_{{$r_lang['url']}}');"
        style="cursor: pointer; height: calc(150px * 500 / 800) !important;">&nbsp;&nbsp;&nbsp;
    <button type="button" class="btn btn-primary" onclick="openBrowser('#thumb_{{$r_input}}_{{$r_lang['url']}}', '#{{$r_input}}_{{$r_lang['url']}}');">Chọn
        hình</button>&nbsp;&nbsp;&nbsp;
    <button type="button" class="btn btn-danger" onclick="$('#{{ $r_input }}_{{ $r_lang['url'] }}').val('');$('#thumb_{{$r_input}}_{{$r_lang['url']}}').attr('src','');">Xóa
        hình hiện tại</button>


        <input type="hidden" class="form-control outline--none  boxshadow--none rounded-0" name="{{ $r_input }}_{{ $r_lang['url'] }}" id="{{ $r_input }}_{{ $r_lang['url'] }}" 
        value="{{@$item_lang[$r_lang['id']][$r_input]}}<?php echo isset($item_layout)? $item_layout : ''?>" 
        
        aria-describedby="helpId" placeholder="{{ $key }}">
</div>