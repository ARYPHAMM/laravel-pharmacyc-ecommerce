<div class="item__position">
    <div class="item__position--title">
        {{ $r_page['title'] }}
    </div>
    <?php $random_token = bin2hex(random_bytes(10)); ?>
    <div class="item__position--menu d-flex position-relative" data-token="{{ $random_token }}"
        data-layout="{{ $r_page['group'] }}" data-level="1" data-current="default" data-position="{{ $r_page['group'] }}">
        <button type="button" class="btn__select--category btn rounded-0 "
            onclick="selectCategory('{{ $r_page['group'] }}',1,'default','{{ $random_token }}')">
            <i class="fas fa-plus text-success "></i>
        </button>
        <div class="category__position position-static">
            @if (isset($items) && isset($items[$r_page['group']]))
             
                @foreach ($items[$r_page['group']] as $item_level_1)
                    <?php
                    $random_token_lv1 = bin2hex(random_bytes(10));
                    $level = 2;
                    ?>
                    <div data-id="{{ $item_level_1['category_id'] }}" class="category__position--child">
                        <div class="category__position--tool">
                            <a onclick="$('.item__position--menu[data-layout={{ $r_page['group'] }}][data-level={{ $level }}][data-current={{ $item_level_1['category_id'] }}][data-token={{ $random_token_lv1 }}]').addClass('position--child')"
                                href="javascript:void(0)" class="d-block"> <i class="fas fa-plus    "></i> </a>
                            <a href="{{ route('category-edit') . '?id=' . $item_level_1['category_id'] }}" target="_bank"> <i
                                    class="fas fa-edit    "></i> </a>
                            <a href="javascript:void(0)" class="d-block"> <i
                                    onclick="$(this).parent().parent().parent().remove();" class="fas fa-times    "></i>
                            </a>
                        </div>
                        <b>{{ $item_level_1['title'] }}</b>
                        <div style="z-index: {{$level}}" class="item__position--menu d-flex opacity--0"
                            data-layout="{{ $r_page['group'] }}" data-level="{{ $level }}"
                            data-current="{{ $item_level_1['category_id'] }}" data-token="{{ $random_token_lv1 }}">
                            <button type="button" class="btn__select--category btn rounded-0 "
                                onclick="selectCategory('{{ $r_page['group'] }}',{{$level}},'{{ $item_level_1['category_id'] }}','{{ $random_token_lv1 }}')">
                                <i class="fas fa-plus text-success "></i>
                            </button>
                            <button type="button" class="btn__close--select btn rounded-0 "
                                onclick="$('.item__position--menu[data-layout={{ $r_page['group'] }}][data-level={{ $level }}][data-current={{ $item_level_1['category_id'] }}][data-token={{ $random_token_lv1 }}]').removeClass('position--child')">
                                <i class="fas fa-times    "></i>
                            </button>
                            <div class="category__position position-static">
                                    @if (isset($item_level_1['child']) && is_array($item_level_1['child']) && !empty($item_level_1['child']) )
                                        @foreach ($item_level_1['child'] as $item_level_2)
                                        @php
                                                  $random_token_lv2 = bin2hex(random_bytes(10));
                                                  $level = 3;
                                        @endphp
                                        <div data-id="{{ $item_level_2['category_id'] }}" class="category__position--child">
                                            <div class="category__position--tool">
                                                <a onclick="$('.item__position--menu[data-layout={{ $r_page['group'] }}][data-level={{ $level }}][data-current={{ $item_level_2['category_id'] }}][data-token={{ $random_token_lv2 }}]').addClass('position--child')"
                                                    href="javascript:void(0)" class="d-block"> <i class="fas fa-plus    "></i> </a>
                                                <a href="{{ route('category-edit') . '?id=' . $item_level_2['category_id'] }}" target="_bank"> <i
                                                        class="fas fa-edit    "></i> </a>
                                                <a href="javascript:void(0)" class="d-block"> <i
                                                        onclick="$(this).parent().parent().parent().remove();" class="fas fa-times    "></i>
                                                </a>
                                            </div>
                                            <b>{{ $item_level_2['title'] }}</b>
                                            <div style="z-index: {{$level}}" class="item__position--menu d-flex opacity--0"
                                                data-layout="{{ $r_page['group'] }}" data-level="{{ $level }}"
                                                data-current="{{ $item_level_2['category_id'] }}" data-token="{{ $random_token_lv2 }}">
                                                <button type="button" class="btn__select--category btn rounded-0 "
                                                    onclick="selectCategory('{{ $r_page['group'] }}',{{$level}},'{{ $item_level_2['category_id'] }}','{{ $random_token_lv2 }}')">
                                                    <i class="fas fa-plus text-success "></i>
                                                </button>
                                                <button type="button" class="btn__close--select btn rounded-0 "
                                                    onclick="$('.item__position--menu[data-layout={{ $r_page['group'] }}][data-level={{ $level }}][data-current={{ $item_level_2['category_id'] }}][data-token={{ $random_token_lv2 }}]').removeClass('position--child')">
                                                    <i class="fas fa-times    "></i>
                                                </button>
                                                <div class="category__position position-static">
                                                    @if (isset($item_level_2['child']) && is_array($item_level_2['child']) && !empty($item_level_2['child']) )
                                                    @foreach ($item_level_2['child'] as $item_level_3)
                                                    @php
                                                              $random_token_lv3 = bin2hex(random_bytes(10));
                                                              $level = 4;
                                                    @endphp
                                                    <div data-id="{{ $item_level_3['category_id'] }}" class="category__position--child">
                                                        <div class="category__position--tool">
                                                            <a onclick="$('.item__position--menu[data-layout={{ $r_page['group'] }}][data-level={{ $level }}][data-current={{ $item_level_3['category_id'] }}][data-token={{ $random_token_lv3 }}]').addClass('position--child')"
                                                                href="javascript:void(0)" class="d-block"> <i class="fas fa-plus    "></i> </a>
                                                            <a href="{{ route('category-edit') . '?id=' . $item_level_3['category_id'] }}" target="_bank"> <i
                                                                    class="fas fa-edit    "></i> </a>
                                                            <a href="javascript:void(0)" class="d-block"> <i
                                                                    onclick="$(this).parent().parent().parent().remove();" class="fas fa-times    "></i>
                                                            </a>
                                                        </div>
                                                        <b>{{ $item_level_3['title'] }}</b>
                                                        <div style="z-index: {{$level}}" class="item__position--menu d-flex opacity--0"
                                                            data-layout="{{ $r_page['group'] }}" data-level="{{ $level }}"
                                                            data-current="{{ $item_level_3['category_id'] }}" data-token="{{ $random_token_lv3 }}">
                                                            <button type="button" class="btn__select--category btn rounded-0 "
                                                                onclick="selectCategory('{{ $r_page['group'] }}',{{$level}},'{{ $item_level_3['category_id'] }}','{{ $random_token_lv3 }}')">
                                                                <i class="fas fa-plus text-success "></i>
                                                            </button>
                                                            <button type="button" class="btn__close--select btn rounded-0 "
                                                                onclick="$('.item__position--menu[data-layout={{ $r_page['group'] }}][data-level={{ $level }}][data-current={{ $item_level_3['category_id'] }}][data-token={{ $random_token_lv3 }}]').removeClass('position--child')">
                                                                <i class="fas fa-times    "></i>
                                                            </button>
                                                            <div class="category__position position-static">
                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif
        </div>
    </div>

</div>
