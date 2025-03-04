@extends('tgs::layouts.master')

@section('content')

    <div class="container-sm mt-5 col-lg-8">
        <h1>Просмотр статьи</h1>
        <div class="mt-5">
            <h4>{{$article->title}}</h4>
            <p>{{$article->short_description}}</p>
            <img height="360" width="640" src="{{asset("/storage/publication/".$article->image)}}">
            <p>{{$article->image_title}}</p>
            <p>{!! $article->content !!}</p>
            @foreach($fields as $field)
                @if($field['type']=='checkbox')
                    <p><strong>{{$field['field_label']}}</strong></p>
                    <p>@if($article['extra_fields'][$field['field_name']] == 1) Да @else Нет @endif</p>
                @elseif($field['type']=='text_input')
                    <p><strong>{{$field['field_label']}}</strong></p>
                    <p> {{$article['extra_fields'][$field['field_name']]}}</p>
                @endif

            @endforeach
        </div>
    </div>
@endsection
