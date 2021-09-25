<div class="item__container">
    <div class="item__position--title">
        {{ $r_page['title'] }}
    </div>
    <div class="container-fluid">
        <div class="row">
            @foreach ($r_page['layout'] as $r_layout)
            <div class="item__fancy">
                <label for="{{ $r_layout['group'] }}" data-name="{{ $r_layout['group'] . '_' . $lang_current->url }}"
                    onclick="<?php echo $r_layout['type'] != 'editor' ? " handleOpenFancy('" .
                        $r_layout['group'] . "')" : "handleOpenModal('" . $r_layout['group'] . "')" ; ?> ">
                    {{ @$items[$r_layout['group']][$r_layout['group'] . '_' . $lang_current->url] }}
                </label>
                <span class=" item__fancy--title">
                    {{ $r_layout['title'] }}
                </span>
                <input type="hidden" name="{{ $r_layout['group'] }}">
                @if ($r_layout['type'] == 'input')
                <div id="{{ $r_layout['group'] }}" class="col-md-6  display--none">
                    <button onclick="parent.$.fancybox.close(); "
                        class="btn__closeFancybox btn rounded-0 border-0 boxshadow--none">
                        <i class="fas fa-times    "></i>
                    </button>
                    <ul class="nav nav-tabs" role="tablist">
                        <?php foreach ($lang as $index => $r_lang) { ?>
                        <li class="nav-item">
                            <a class="rounded-0 nav-link <?= $index == 0 ? 'active' : '' ?>" id="lang-tab-<?php
echo $r_layout['group'];
echo $r_lang['url'];
?>" data-toggle="tab" href="#lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>" role="tab"
                                aria-controls="lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>"
                                aria-selected="<?= $index == 0 ? true : false ?>"><?= $r_lang['url'] ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content mt-1">
                        <?php foreach ($lang as $index => $r_lang) { ?>
                        <div class="tab-pane fade <?= $index == 0 ? 'show active' : '' ?> "
                            id="lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>" role="tabpanel" aria-labelledby="lang-tab-<?php
echo $r_layout['group'];
echo $r_lang['url'];
?>">
                            @php
                            $key = $r_layout['title'];
                            $r_input = $r_layout['group'];
                            @$item_layout = $items[$r_layout['group']][$r_input . '_' . $r_lang['url']];
                            @endphp
                            <div class="form-group">
                                @include('admin.layout.input-trl')
                            </div>
                            @if (isset($r_layout['link']) && $r_layout['link'] == true)
                            @php
                            @$item_layout = $items[$r_layout['group']][$r_input . '_link_' . $r_lang['url']];
                            @endphp
                            <div class="form-group">
                                @include('admin.layout.link-trl')
                            </div>
                            @endif
                        </div>
                        <?php } ?>
                    </div>
                </div>

                @elseif($r_layout['type']=='text')
                <div id="{{ $r_layout['group'] }}" class="col-md-6  display--none">
                    <button onclick="parent.$.fancybox.close(); "
                        class="btn__closeFancybox btn rounded-0 border-0 boxshadow--none">
                        <i class="fas fa-times    "></i>
                    </button>
                    <ul class="nav nav-tabs" role="tablist">
                        <?php foreach ($lang as $index => $r_lang) { ?>
                        <li class="nav-item">
                            <a class="rounded-0 nav-link <?= $index == 0 ? 'active' : '' ?>" id="lang-tab-<?php
echo $r_layout['group'];
echo $r_lang['url'];
?>" data-toggle="tab" href="#lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>" role="tab"
                                aria-controls="lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>"
                                aria-selected="<?= $index == 0 ? true : false ?>"><?= $r_lang['url'] ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content mt-1">
                        <?php foreach ($lang as $index => $r_lang) { ?>
                        <div class="tab-pane fade <?= $index == 0 ? 'show active' : '' ?> "
                            id="lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>" role="tabpanel" aria-labelledby="lang-tab-<?php
echo $r_layout['group'];
echo $r_lang['url'];
?>">
                            @php
                            $key = $r_layout['title'];
                            $r_input = $r_layout['group'];
                            @$item_layout = $items[$r_layout['group']][$r_input . '_' . $r_lang['url']];

                            @endphp
                            <div class="form-group">
                                @include('admin.layout.text-trl')
                            </div>
                            @if (isset($r_layout['link']) && $r_layout['link'] == true)
                            @php
                            @$item_layout = $items[$r_layout['group']][$r_input . '_link_' . $r_lang['url']];
                            @endphp
                            <div class="form-group">
                                @include('admin.layout.link-trl')
                            </div>
                            @endif
                        </div>
                        <?php } ?>
                    </div>
                </div>
                @elseif($r_layout['type']=='editor')
                <div class="modal" id="{{ $r_layout['group'] }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content modal__content--pd">
                            <button type="button" class="close btn__close-modal" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul class="nav nav-tabs" role="tablist">
                                <?php foreach ($lang as $index => $r_lang) { ?>
                                <li class="nav-item">
                                    <a class="rounded-0 nav-link <?= $index == 0 ? 'active' : '' ?>" id="lang-tab-<?php
echo $r_layout['group'];
echo $r_lang['url'];
?>" data-toggle="tab" href="#lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>" role="tab"
                                        aria-controls="lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>"
                                        aria-selected="<?= $index == 0 ? true : false ?>"><?= $r_lang['url'] ?></a>
                                </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content mt-1">
                                <?php foreach ($lang as $index => $r_lang) { ?>
                                <div class="tab-pane fade <?= $index == 0 ? 'show active' : '' ?> "
                                    id="lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>" role="tabpanel"
                                    aria-labelledby="lang-tab-<?php
echo $r_layout['group'];
echo $r_lang['url'];
?>">
                                    @php
                                    $key = $r_layout['title'];
                                    $r_input = $r_layout['group'];
                                    @$item_layout = $items[$r_layout['group']][$r_input . '_' . $r_lang['url']];
                                    @endphp
                                    <div class="form-group">
                                        @include('admin.layout.editor-trl')
                                    </div>
                                    @if (isset($r_layout['link']) && $r_layout['link'] == true)
                                    @php
                                    @$item_layout = $items[$r_layout['group']][$r_input . '_link_' . $r_lang['url']];
                                    @endphp
                                    <div class="form-group">
                                        @include('admin.layout.link-trl')
                                    </div>
                                    @endif

                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($r_layout['type']=='image')
                <div id="{{ $r_layout['group'] }}" class="col-md-6  display--none">
                    <button onclick="parent.$.fancybox.close(); "
                        class="btn__closeFancybox btn rounded-0 border-0 boxshadow--none">
                        <i class="fas fa-times    "></i>
                    </button>
                    <ul class="nav nav-tabs" role="tablist">
                        <?php foreach ($lang as $index => $r_lang) { ?>
                        <li class="nav-item">
                            <a class="rounded-0 nav-link <?= $index == 0 ? 'active' : '' ?>" id="lang-tab-<?php
echo $r_layout['group'];
echo $r_lang['url'];
?>" data-toggle="tab" href="#lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>" role="tab"
                                aria-controls="lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>"
                                aria-selected="<?= $index == 0 ? true : false ?>"><?= $r_lang['url'] ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content mt-1">
                        <?php foreach ($lang as $index => $r_lang) { ?>
                        <div class="tab-pane fade <?= $index == 0 ? 'show active' : '' ?> "
                            id="lang-{{ $r_layout['group'] }}-<?= $r_lang['url'] ?>" role="tabpanel" aria-labelledby="lang-tab-<?php
echo $r_layout['group'];
echo $r_lang['url'];
?>">
                            @php
                            $key = $r_layout['title'];
                            $r_input = $r_layout['group'];
                            @$item_layout = $items[$r_layout['group']][$r_input . '_' . $r_lang['url']];

                            @endphp
                            <div class="form-group">
                                @include('admin.layout.thumbnail-trl')
                            </div>
                            @if (isset($r_layout['link']) && $r_layout['link'] == true)
                            @php
                            @$item_layout = $items[$r_layout['group']][$r_input . '_link_' . $r_lang['url']];
                            @endphp
                            <div class="form-group">
                                @include('admin.layout.link-trl')
                            </div>
                            @endif
                        </div>
                        <?php } ?>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>