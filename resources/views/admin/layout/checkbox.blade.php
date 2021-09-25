<label for="">{{ $key }}</label>
<div id="">
 
    <?php foreach ($r_checbox as $key_checkbox => $r_checkbox_item) { ?>

    <?php foreach ($r_checkbox_item as $r_item) { ?>

    <label for="">
        <input type="checkbox" {{in_array($r_item->id, explode(",",@$item[$key_checkbox]) ) ? 'checked' : ''}} name="{{ $key_checkbox }}[]" value="{{ $r_item->id }}">
        <span>{{ $r_item->translates()->first()->title }}</span>
    </label>
    <?php } ?>

    <?php } ?>
</div>
