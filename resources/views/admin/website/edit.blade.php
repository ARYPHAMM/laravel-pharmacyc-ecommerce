@extends('admin.index')
@section('content')
    <div class="mt-1">
        <form action="{{ route('website-update') }}" method="POST" enctype="multipart/form-data"
            class="w-75 d-block m-auto">
            @if (session('session-notification'))
                <div class="alert alert-{{ session('session-notification')['status'] }} text-center" role="alert">
                    <strong>{{ session('session-notification')['title'] }}</strong>
                </div>
            @endif
            @csrf
            <h3 class="item__form--title">
                Thông tin website
            </h3>

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
                                                                            <div class="item__thumbnail mb-1">
                    <label class="text-uppercase font-weight-bold">
                        Icon
                    </label>
   
                    <img id="thumb_{{$r_lang['url']}}"
                        src="<?php echo file_exists(@$item_lang[$r_lang['id']]['logo']) && !empty(@$item_lang[$r_lang['id']]['logo']) ? asset('') . @$item_lang[$r_lang['id']]['logo'] : asset('') . 'assets/images/no-image.png'; ?>"
                        alt="Chưa có hình" onclick="openBrowser('#thumb_{{$r_lang['url']}}', '#logo_{{$r_lang['url']}}');"
                        style="cursor: pointer; height: calc(150px * 500 / 800) !important;">&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-primary" onclick="openBrowser('#thumb_{{$r_lang['url']}}', '#logo_{{$r_lang['url']}}');">Chọn
                        hình</button>&nbsp;&nbsp;&nbsp;
                    <button type="button" class="btn btn-danger" onclick="$('#logo_{{$r_lang['url']}}').val('');$('#thumb_{{$r_lang['url']}}').attr('src','');">Xóa
                        hình hiện tại</button>
                    <input id="logo_{{$r_lang['url']}}" name="logo_{{$r_lang['url']}}" type="hidden"
                        value="<?php echo @$item_lang[$r_lang['id']]['logo']; ?>">
                </div>
                                                                @foreach ($config_page['input'] as $key => $r_input)
                                                                <div class="form-group">
                                                                   @include('admin.layout.input-trl')
                                                                </div>
                                                                @endforeach
                                                                {{-- @foreach ($config_page['text'] as $key => $r_input)
                                                        <div class="form-group">
                                                           @include('admin.layout.text-trl')
                                                        </div>
                                                        @endforeach
                                                        @foreach ($config_page['editor'] as $key => $r_input)
                                                        <div class="form-group">
                                                           @include('admin.layout.editor-trl')
                                                        </div>
                                                        @endforeach --}}
                                                                @foreach ($config_page['textSeo'] as $key => $r_input)
                                                                <div class="form-group">
                                                                   @include('admin.layout.input-trl')
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" value="{{ @$item['id'] }}">
                                                <button type="submit" name="" id="" class="btn bg-success rounded-0 font-weight-bold ml-auto d-block">
                                                    {{ @$item['id'] == '' ? 'Thêm mới' : 'Cập nhật' }}
                                                </button>
                                            </form>
                                        </div>
@endsection
