<label class="font-weight-bold" for="{{ $r_radio }}">{{ $key }}</label>
@if (request()->get('id') == '' && $r_radio == 'enable')
    <div class="d-flex align-items-center">
        <span class="mr-1 font-italic">Có</span><input type="radio" name="{{ $r_radio }}" value="1"
        checked>,
        <span class="ml-1 mr-1 font-italic">Không</span><input type="radio" name="{{ $r_radio }}" value="0"
          >
    </div>
@else
    <div class="d-flex align-items-center">
        <span class="mr-1 font-italic">Có</span><input type="radio" name="{{ $r_radio }}" value="1"
            {{ @$item[$r_radio] == 1 ? 'checked' : '' }}>,
        <span class="ml-1 mr-1 font-italic">Không</span><input type="radio" name="{{ $r_radio }}" value="0"
            {{ @$item[$r_radio] == 0 ? 'checked' : '' }}>
    </div>
@endif
