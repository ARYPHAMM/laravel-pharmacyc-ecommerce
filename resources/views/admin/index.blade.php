<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./admin">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('admin.layout.style')
    <script>
        var baseURL = "{{ asset('') }}";

    </script>
</head>

<body>
    @if (Cookie::get('admin') !== null)
        @include('admin.layout.header')
        <div id="content">
            <div class="content__col--left">
                @include('admin.layout.menu-left')
            </div>
            <div class="content__col--right">
                @yield('content')
            </div>
        </div>
        @include('admin.layout.footer')

        @include('admin.layout.script')
        <script>
            $(document).ready(function() {
                $("#imagelist-container").sortable({
                    revert: true,
                    placeholder: "ui-state-highlight",
                    stop: function() {
                        refreshImageList();
                    }
                });
            });

            function addToImagList(url) {
                $("#imagelist-container").append(`<div style="position: relative; float: left; margin-right: 5px; margin-bottom: 5px;">
                    <span class='close' style='position: absolute; top: 8px; right: 8px; background: #fff; box-shadow: 0 0 3px #000; width: 20px; height: 20px; line-height: 18px; text-align: center; font-size: 16px; opacity: 1; user-select: none;' onclick='$(this).parent().remove(); refreshImageList();'>x</span>
                    <img data-src=` + url + ` src=` + baseURL + url + ` class='thumbnail' style='-width: 100px !important; height: 70px !important; background: transparent !important; margin-bottom: 0;'>
                </div>`);
            }

            function refreshImageList() {
                var urlList = [];
                $("#inputlist-container").html("");
                $("#imagelist-container img").each(function() {
                    if (urlList.indexOf($(this).attr('src')) < 0) {
                        $("#inputlist-container").append(`<input type="hidden" name="image[]" value="` + $(this)
                            .data("src") + `">`);
                        // urlList.push($(this).data('src'));
                    }
                });
            }
            var fileSeleted = null;
            function openBrowser(imgid, inputid, rf = undefined, cb = undefined) {
                CKFinder.popup({
                    chooseFiles: true,
                    chooseFilesOnDblClick: true,
                    width: 800,
                    height: 600,
                    onInit: function(finder) {
                        finder.on('files:selected', function(evt) {
                            fileSeleted = evt.data.files;
                        });
                        finder.on('files:choose', function(evt) {
                            if (!rf) {
                                var file = evt.data.files.first();
                                var output = document.getElementById(inputid.replace('#', ''));
                                var view = document.getElementById(imgid.replace('#', ''));
                                view.src = baseURL + file.getUrl();
                                output.value = file.getUrl();
                            } else {
                                // var files = evt.data.files;
                                var files = fileSeleted;
                                var chosenFiles = '';
                                files.forEach(function(file, i) {
                                    chosenFiles += (i + 1) + '. ' + file.get('name') + '\n';
                                    addToImagList(file.getUrl());
                                });
                                refreshImageList();
                            }
                        });
                        finder.on('file:choose:resizedImage', function(evt) {
                            var output = document.getElementById(inputid.replace('#', ''));
                            output.value = evt.data.resizedUrl;
                        });
                    }
                });
            }
            $(".editor").each(function(index, el) {
                CKEDITOR.replace(this.id, {
                    baseHref: baseURL,
                    filebrowserImageBrowseUrl: baseURL + "assets/ckfinder/ckfinder.html",
                    filebrowserImageBrowseUrl: baseURL + "assets/ckfinder/ckfinder.html?type=Images",
                    filebrowserWindowWidth: "1000",
                    filebrowserWindowHeight: "700"
                });
            });

        </script>
    @else
        <div class="user__login">
            @yield('content')
        </div>
        <style>
            html {
                height: 100%;
            }

            body {
                min-height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #b8c6db;
                background-image: linear-gradient(315deg, #b8c6db 0%, #f5f7fa 74%);
                ;
            }

            .user__login {
                height: 100%;
                width: 100%;
                position: absolute;
                display: flex;
                align-items: center;
                top: -150px;
            }

            .user__login .form-control {
                border-radius: 0;
                outline: none;
                box-shadow: none;
                border-color: #fdfdfd;
            }

            .user__login form {
                position: relative;
            }

            .user__login form .btn {
                border: 0;
                border-radius: 0;
            }

            .user__login h3 {
                color: #666;
                opacity: 0.9;
                font-weight: 600;
                line-height: 1.4em;
                text-transform: uppercase;
                text-align: center;
                position: relative;
                height: 30px;
            }

            .user__login .form-group {
                z-index: 1;
            }

            .user__login span {
                animation-name: animation-botom-to-top;
                animation-duration: 2s;
                position: absolute;
                top: 0;
                width: 100%;
                left: 0;
                z-index: -1;
                text-shadow: -1px 2px 1px rgb(0 0 0 / 30%);
            }

            @keyframes animation-botom-to-top {
                from {
                    top: 200%;
                    text-shadow: unset;
                }

                to {
                    top: 0;
                    text-shadow: -1px 2px 1px rgb(0 0 0 / 30%);
                }
            }

        </style>
    @endif
</body>

</html>
