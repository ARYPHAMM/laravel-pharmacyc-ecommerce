@extends('admin.index')
@section('content')
<div class="mt-1">
    <form action="{{ route('product-update') }}" method="POST" enctype="multipart/form-data" class="w-75 d-block m-auto">
        @if (session('session-notification'))
        <div class="alert alert-{{ session('session-notification')['status'] }} text-center" role="alert">
            <strong>{{ session('session-notification')['title'] }}</strong>
        </div>
        @endif
        @csrf
        <h3 class="item__form--title">
            {{ @$item['id'] == '' ? 'Thêm mới danh mục' : 'Cập nhật' }}
            @if (@$item['id'] !== '')
            <span> {{ @$item['title'] }}</span>
            @endif
        </h3>
        <div class="item__thumbnail mb-1">
            <label class="text-uppercase font-weight-bold">
                Hình ảnh đại diện
            </label>
            <img id="thumb" src="<?php echo file_exists(@$item['thumbnail']) && !empty(@$item['thumbnail']) ? asset('') . @$item['thumbnail'] : asset('') . 'assets/images/no-image.png'; ?>" alt="Chưa có hình" onclick="openBrowser('#thumb', '#thumbnail');" style="cursor: pointer; height: calc(150px * 500 / 800) !important;">&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-primary" onclick="openBrowser('#thumb', '#thumbnail');">Chọn
                hình</button>&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-danger" onclick="$('#thumbnail').val('');$('#thumb').attr('src','');">Xóa hình hiện tại</button>
            <input id="thumbnail" name="thumbnail" type="hidden" value="<?php echo @$item['thumbnail']; ?>">
        </div>
        <div class="item__image mb-1">
            <label class="text-uppercase font-weight-bold">
                Hình ảnh slide
            </label>
            <div id="imagelist-container" style="margin-bottom: 10px; overflow: hidden;">
                @if (@$item['id'] != '')
                @foreach ($item->productImagesExtend()->get() as $r_image)
                <div style="position: relative; float: left; margin-right: 5px; margin-bottom: 5px;">
                    <span class='close' style='position: absolute; top: 8px; right: 8px; background: #fff; width: 20px; height: 20px; line-height: 18px; text-align: center; font-size: 16px; opacity: 1; user-select: none;' onclick='$(this).parent().remove(); refreshImageList();'>x</span>
                    <img alt="<?php echo $r_image->thumbnail; ?>" data-src='<?php echo $r_image->thumbnail; ?>' src='<?php echo asset('') . $r_image->thumbnail; ?>' class='thumbnail' style='-width: 100px !important; height: 70px !important; background: transparent !important; margin-bottom: 0;'>
                </div>
                @endforeach
                @endif
            </div>
            <div class="clearfix"></div>
            <button type="button" class="btn btn-primary" onclick="openBrowser('folder', '#imagelist', true)">Thêm
                hình</button>&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-danger" onclick="$('#imagelist-container').html(''); refreshImageList();">Xóa tất cả</button>
            <div id="inputlist-container">
                @if (@$item['id'] != '')
                @foreach ($item->productImagesExtend()->get() as $r_image)
                <input type="hidden" name="image[]" value="<?= $r_image->thumbnail ?>">
                @endforeach
                @endif
            </div>
        </div>
        <div class="item__checkbox">
            @foreach ($config_page['checkbox'] as $key => $r_checbox)
            @include('admin.layout.checkbox')
            @endforeach
        </div>
        <div class="">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php foreach ($lang as $index => $r_lang) { ?>
                    <li class="nav-item">
                        <a class="rounded-0 nav-link <?= $index == 0 ? 'active' : '' ?>" id="lang-tab-<?= $r_lang['url'] ?>" data-toggle="tab" href="#lang-<?= $r_lang['url'] ?>" role="tab" aria-controls="lang-<?= $r_lang['url'] ?>" aria-selected="<?= $index == 0 ? true : false ?>"><?= $r_lang['url'] ?></a>
                    </li>
                <?php } ?>
            </ul>
            <div class="tab-content mt-1" id="myTabContent">
                <?php foreach ($lang as $index => $r_lang) { ?>
                    <div class="tab-pane fade <?= $index == 0 ? 'show active' : '' ?> " id="lang-<?= $r_lang['url'] ?>" role="tabpanel" aria-labelledby="lang-tab-<?= $r_lang['url'] ?>">
                        @foreach ($config_page['input'] as $key => $r_input)
                        <div class="form-group">
                            @include('admin.layout.input-trl')
                        </div>
                        @endforeach
                        @foreach ($config_page['number'] as $key => $r_input)
                        <div class="form-group">
                            @include('admin.layout.input-price-trl')
                        </div>
                        @endforeach
                        @foreach ($config_page['text'] as $key => $r_input)
                        <div class="form-group">
                            @include('admin.layout.text-trl')
                        </div>
                        @endforeach
                        @foreach ($config_page['editor'] as $key => $r_input)
                        <div class="form-group">
                            @include('admin.layout.editor-trl')
                        </div>
                        @endforeach
                        @foreach ($config_page['textSeo'] as $key => $r_input)
                        <div class="form-group">
                            @include('admin.layout.input-trl')
                        </div>
                        @endforeach
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="item__radio--status">
            @foreach ($config_page['status'] as $key => $r_radio)
            <div class="form-group">
                @include('admin.layout.radio-status')
            </div>
            @endforeach
        </div>
        <input type="hidden" name="id" value="{{ @$item['id'] }}">
        <button type="submit" name="" id="" class="btn bg-success rounded-0 font-weight-bold ml-auto d-block">
            {{ @$item['id'] == '' ? 'Thêm mới' : 'Cập nhật' }}
        </button>
    </form>
</div>
@endsection