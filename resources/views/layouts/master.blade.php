<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Tgs Module - {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Vite CSS --}}
    {{-- {{ module_vite('build-tgs', 'resources/assets/sass/app.scss', storage_path('vite.hot')) }} --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/translations/ru.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <style>
        .icon-size {
            width: 18px;
            height: 18px;
        }
    </style>
</head>

<body>

<div class="container-sm mt-5">
    @include('tgs::components.breadcrumbs')
    @yield('content')
</div>


    {{-- Vite JS --}}
    {{-- {{ module_vite('build-tgs', 'resources/assets/js/app.js', storage_path('vite.hot')) }} --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if(document.querySelector( '.ckedit' )){
                document.querySelector( '.ckedit' ).removeAttribute("required")
                ClassicEditor
                    .create(
                        document.querySelector( '.ckedit' ), {
                            language:"ru",
                            toolbar:
                                {items:
                                        ["heading","|","bold","italic","link","bulletedList","numberedList","|","outdent","indent","|","imageUpload","blockQuote","insertTable","mediaEmbed","undo","redo","sourceEditing"]
                                },
                        })
                    .catch( error => {
                        console.error( error );
                    } );
            }

            let articles_id = []

            document.addEventListener('input',async function(e){
                const target = e.target;
                if (!target.closest('.choose-article')) return;
                let articles = target.closest('.choose-article');
                let btn_remove_articles = document.querySelector('.btn-remove-articles');
                let chosen_articles = document.querySelector('.chosen-articles');

                if(articles.checked){
                    articles_id.push(articles.value)
                }else{
                    var index = articles_id.indexOf(articles.value);
                    articles_id.splice(index, 1);
                }

                if(articles_id != undefined && articles_id.length != 0){
                    btn_remove_articles.classList.remove('d-none')
                }else{
                    btn_remove_articles.classList.add('d-none')
                }

                chosen_articles.value = JSON.stringify(articles_id);
            });

        });


        feather.replace();
    </script>
</body>
