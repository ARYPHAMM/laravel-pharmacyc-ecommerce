@include('admin.layout.'.$layout);
<script>
    const attrLayout = {
        layout: null,
        level: null,
        id_current: null,
        token: null,
    }
    random_token = () => {
        return Math.random().toString(36).substring(7);
    }
    selectCategory = (layout, level = 1, current = 1, token) => {
        attrLayout.layout = layout;
        attrLayout.level = level;
        attrLayout.id_current = current;
        attrLayout.token = token;
        $.fancybox.open({ // FancyBox 3
            src: '#select__category',
            modal: true,
            width: 600,
            height: 'auto'
        });
    }
    handleOpenModal = (id) =>{
        $('#'+id).modal('show');
        $('#'+id).on('hidden.bs.modal', function (e) {
            var editorData= CKEDITOR.instances[$('label[for='+id+']').data('name')].getData();
            $('label[for='+id+']').text(editorData );
        })
    }
    handleOpenFancy = (id) =>{
        $.fancybox.open({ // FancyBox 3
            src: '#'+id,
            modal: true,
            width: 600,
            height: 600,
            afterClose : function(){
             $('label[for='+id+']').text($('#'+$('label[for='+id+']').data('name')).val() );
           },           
        });
 

    }

    addPositionParent = (id, title, layout, level, current, token) => {
        let hrefEdit = '{{ route('category-edit') }}?id=' + id;
        let getToken = random_token();
        $('.item__position--menu[data-layout=' + layout + '][data-level=' + level + '][data-current=' + current +
                '][data-token=' + token + '] > .category__position')
            .append(`
                <div data-id=` + id + `  class="category__position--child">
                        <div class="category__position--tool" >
                        <a onclick="$('.item__position--menu[data-layout=` + layout + `][data-level=` + (level + 1) +
                `][data-current=` + id + `][data-token=` + getToken + `]').addClass('position--child')" href="javascript:void(0)" class="d-block"> <i class="fas fa-plus    "></i> </a>
                        <a href=` + hrefEdit + ` target="_bank"> <i class="fas fa-edit    "></i> </a>
                        <a href="javascript:void(0)" class="d-block"> <i onclick="$(this).parent().parent().parent().remove();" class="fas fa-times    "></i> </a>
                        </div>
                    <b>` + title + `</b>
                    <div style="z-index:` + (level + 1) +
                `" class="item__position--menu d-flex opacity--0" data-layout="` + layout + `" data-level=` + (
                    level + 1) + ` data-current="` + id + `" data-token="` + getToken + `">
                        <button type="button" class="btn__select--category btn rounded-0 "
                            onclick="selectCategory('` + layout + `',` + (level + 1) + `,'` + id + `','` + getToken + `')">
                            <i class="fas fa-plus text-success "></i>
                        </button>
                        <button type="button" class="btn__close--select btn rounded-0 "
                            onclick="$('.item__position--menu[data-layout=` + layout + `][data-level=` + (level + 1) +
                `][data-current=` + id + `][data-token=` + getToken + `]').removeClass('position--child')">
                           <i class="fas fa-times    "></i>
                        </button>
                        <div class="category__position position-static" >
                        </div>
                     </div>
                </div>
        `);
        $('.category__position').sortable({
            revert: true,
            placeholder: "ui-state-highlight",
            // stop: function() {
            //     refreshImageList();
            // }
        });
    }

    $(function() {
        $('.category__position').sortable({
            revert: true,
            placeholder: "ui-state-highlight",
            // stop: function() {
            //     refreshImageList();
            // }
        });
        // Single Select
        $("#autocomplete__find").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: admin_call_ajax,
                    type: 'post',
                    dataType: "json",
                    data: {
                        title: request.term,
                        _token: '{{ csrf_token() }}',
                        type: 'find',
                        table: 'tbl_tr_category',
                        default_lang_id: '{{ $default_lang_id }}'
                    },
                    success: function(data) {
                        response(data['result']);
                    }
                });
            },
            select: function(event, ui) {
                // $('#autocomplete__find').val(ui.item.title,positionIdCurrent,); // display the selected text
                // console.log($(this).data('layout'));
                addPositionParent(ui.item.category_id, ui.item.title, attrLayout.layout, attrLayout
                    .level, attrLayout.id_current, attrLayout.token);
                return false;
                // console.log(ui.item.url)
                // // redirect to url
                // window.location = ui.item.url
            },
            close: function(event, ui) {
                if (!$("ul.ui-autocomplete").is(":visible")) {
                    $("ul.ui-autocomplete").show();
                }
            },
            create: function() {
                $(this).data('ui-autocomplete')._renderItem = function(ul, item) {
                    elem = $('<li class="category_item_title">')
                        .append('<a href="javascript:void(0)">' + item.title + '</a>')
                        .append('</li>')
                        .appendTo(ul);
                    return elem;
                };
            },
            //   select: function (event, ui) {
            //      // Set selection
            //     //  console.log(ui);
            //     //  $('#selectuser_id').val(ui.item.value); // save selected id to input
            //      return false;
            //   },
            //   focus: function(event, ui){
            //      $( "#autocomplete__find" ).val( ui.item.label );
            //      $( "#selectuser_id" ).val( ui.item.value );
            //      return false;
            //    },
        });
        $('#autocomplete__find').keyup(function() {
            if ($('#autocomplete__find').val() === '') {
                $("ul.ui-autocomplete").hide();
            }
        });
    });

    $('form').submit(function() {
        var position = $('[data-position]');
        $.each(position, function(key, value) {
            value_origin = $('[data-token='+$(value).data('token')+'] > .category__position > div[data-id]');
            let data = {};
            $.each(value_origin, function(key_level_1, value_level_1) {
                data[key_level_1]=  { id: $(value_level_1).data('id'),child: {} };
                var value_1 = $('[data-token='+$(value_level_1).children('.item__position--menu').data('token')+'] > .category__position > div[data-id]');
                $.each(value_1, function(key_level_2, value_level_2) {
                    data[key_level_1]['child'][key_level_2] = { id: $(value_level_2).data('id'),child: {} };
                    var value_2 = $('[data-token='+$(value_level_2).children('.item__position--menu').data('token')+'] > .category__position > div[data-id]');
                    $.each(value_2, function(key_level_3, value_level_3) {
                        data[key_level_1]['child'][key_level_2]['child'][key_level_3] = { id: $(value_level_3).data('id'),child: {} };
                    });
                });
             
            });
         $('form').append('<input type="hidden" name='+$(value).data('position')+' value='+JSON.stringify(data)+' />');
        });
    });

</script>
<div id="select__category" class="popup__select-category display--none">
    <div class="d-flex flex-row boxshadow--none rounded-0">
        <button onclick="$('ul.ui-autocomplete').hide();parent.$.fancybox.close(); "
            class="btn__closeFancybox btn rounded-0 border-0 boxshadow--none">
            <i class="fas fa-times    "></i>
        </button>
        <input type="text" id="autocomplete__find" class="form-control" placeholder="Gõ tên danh mục...">
        {{-- <button class="btn">
        <i class="fas fa-search    "></i>
    </button> --}}
    </div>
</div>
