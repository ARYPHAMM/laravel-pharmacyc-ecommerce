<div>
        @foreach ($config_menu as $key => $item)
        <div class="menuConfig">
            <button
                class="d-flex flex-row align-items-center btn btn-danger border-0 shadow-none rounded-0 {{ checkParamsAdmin(request()->path(), 1) != $item['com'] ? '' : 'collapsed' }}"
                data-toggle="collapse" data-target="#com-{{ $item['com'] }}" aria-expanded="{{ checkParamsAdmin(request()->path(), 1) != $item['com'] ? '' : 'true' }}"
                aria-controls="com-{{ $item['com'] }}">
                <i class="{{$item['icon']}}"></i><span>{{ $key }}</span>
                <i class="fas fa-chevron-down d-block ml-auto"></i>
            </button>
            <ul id="com-{{ $item['com'] }}"
                class="collapse {{ checkParamsAdmin(request()->path(), 1) != $item['com'] ? '' : ' show' }}">
                @foreach ($item['child'] as $item_child)
                    <li>
                        <a href="{{ url('/admin/' . $item['com'] . '/' . $item_child['act'].($item_child['type'] !="default"?'/'.$item_child['type'] : ''  )) }}">{{ $item_child['title'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
