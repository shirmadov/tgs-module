@extends('tgs::layouts.master')

@section('content')
{{--    @include('components.breadcrumbs')--}}


<div class="container-lg mt-5 card col-lg-8">
    <h4 class="p-2">Редактирование публикации</h4>
    <div class="card-body">
        <form method="post" action="{{route('tgs.article.update',['id'=>$article->id])}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="">
                    <div class="mb-3">
                        <label>Тип публикации</label>
                        <select name="type" class="form-control">
                            <option>Выбор типа публикации</option>
                            <option value="1" {{$article->type->value == 1 ? "selected" : ""}}>Новость</option>
                            <option value="2" {{$article->type->value == 2 ? "selected" : ""}}>Статья</option>
                            {{--                                <option value="3" {{$article->type_id==3?"selected":""}}>Блог</option>--}}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label>Дата публикации</label>
                            <input type="datetime-local" class="form-control" value="{{ $article->published }}" name="published" id="datetimepicker-dashboard">
                            @error('published')
                            <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="mb-3">
                        <label>Заголовок</label>
                        <input type="text" name="title" required placeholder="" value="{{$article->title}}" class="form-control" >
                        @error('title')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="page_title"  placeholder="" value="{{$article->page_title}}" class="form-control" >
                        @error('pagetitle')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Изображение</label>
                        <input type="file" id="imageInput" name="image" placeholder="jpeg,jpg" class="form-control ">
                        <img id="previewImage" class="article-show__image pt-4" height="360" width="640" src="{{asset("/storage/publication/".$article->image)}}">
                        @error('image')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Подпись изображения</label>
                        <input type="text" name="image_title" placeholder="" value="{{$article->image_title}}" class="form-control" >
                        @error('image_title')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Источник (текст)</label>
                                <input type="text" name="source_title" placeholder="" value="{{$article->source_title}}" class="form-control" >
                                @error('source_title')
                                <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Источник (ссылка)</label>
                                <input type="text" name="source_url" required placeholder="" value="{{$article->source_url}}" class="form-control" >
                                @error('source_url')
                                <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label>Краткое описание</label>
                        <textarea name="short_description" required class="form-control">{{$article->short_description}}</textarea>
                        @error('short_description')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Текст</label>
                        <textarea name="content" required class="form-control ckedit">{!! $article->content !!}</textarea>
                        @error('content')
                        <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @foreach($fields as $field)
                        @if(array_key_exists($field['field_name'], $article['extra_fields']))
                            @if($field['type']=='text_input')
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label>{{$field['field_label']}}</label>
                                        <input type="text" name="extra_fields[{{$field['field_name']}}]" required="{{$field['required']}}" value="{{ $article['extra_fields'][$field['field_name']] }}" class="form-control" >
                                        @error('source_url')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @elseif($field['type']=='textarea')
                                <div class="mb-3">
                                    <label>{{$field['field_label']}}</label>
                                    <textarea name="extra_fields[{{$field['field_name']}}]" required="{{$field['required']}}" class="form-control ckedit">{!! $article['extra_fields'][$field['field_name']] !!}</textarea>
                                    @error('content')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @elseif($field['type']=='checkbox')
                                <input type="hidden" name="extra_fields[{{ $field['field_name'] }}]" value="0">
                                <div class="col-6">
                                    <div class="mb-3 form-check">
                                        <label class="form-check-label" for="flexCheckChecked">{{ $field['field_label'] }}</label>
                                        <input class="form-check-input" type="checkbox" value="1" name="extra_fields[{{$field['field_name']}}]" id="flexCheckChecked" @if($article['extra_fields'][$field['field_name']]) checked @endif>
                                    </div>
                                </div>
                            @endif
                        @endif

                    @endforeach


                    <button class="btn btn-outline-primary">Сохранить</button>
                </div>

            </div>
        </form>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        // if(document.getElementById("datetimepicker-dashboard")){
        //     var date = new Date(Date.now());
        //     var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
        //     var current_val = document.getElementById("datetimepicker-dashboard").value;
        //     document.getElementById("datetimepicker-dashboard").flatpickr({
        //         enableTime: true,
        //         dateFormat: "Y-m-d H:i",
        //         inline: true,
        //         prevArrow: "<span title=\"Previous month\">&laquo;</span>",
        //         nextArrow: "<span title=\"Next month\">&raquo;</span>",
        //         time_24hr: true,
        //         defaultDate: current_val || new Date(),
        //         minuteIncrement: 1,
        //     });
        // }

        document.getElementById('imageInput').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        });

    });
</script>

@endsection

