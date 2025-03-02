@extends('tgs::layouts.master')

@section('content')
    <h1>Cписок статей</h1>
    <table class="table mt-4">
        <tr>
            <th class="m-0 p-0" scope="col">
                <form action="{{ route('tgs.article.delete') }}" method="POST">
                    @csrf
                    <input class="chosen-articles" type="text" hidden name="articles" value="">
                    <button type="submit" class="m-0 p-1 d-none btn btn-outline-danger btn-remove-articles">Удалить</button>
                </form>
            </th>
            <th scope="col">ID Статья</th>
            <th scope="col">Название статьи</th>
            <th scope="col">Дата публикации</th>
            <th scope="col">Тип</th>
            <th scope="col"></th>
        </tr>
        @foreach($articles as $article)
            <tr class="@if($article['status'] =='accepted') table-success @elseif($article['status'] =='rejected') table-danger @endif">
                <td class="m-0 p-0">
                    <input style="margin-right: 55px" class="choose-article" type="checkbox" name="choose_article" value="{{$article['id']}}">
                </td>
                <td>
                    {{$article['ai_article_id']}}
                </td>
                <td><a href="{{ route('tgs.article.show', $article['id']) }}">{{$article['title']}}</a></td>
                <td>{{ $article['published'] }}</td>
                <td>{{ $article->type_label }}</td>
                <td>
                    <a class="btn btn-outline-danger btn-sm px-2 ml-3" onclick="return confirm('Уверены что хотите удалить элемент?')" href="{{route("tgs.article.remove",[$article['id']])}}">
                        <i class="icon-size" data-feather="trash-2"></i>
                    </a>
                    @if($article['status'] != 'accepted' and $article['status'] != 'rejected')
                        <a class="btn btn-outline-primary px-2 btn-sm" href="{{route("tgs.article.edit",[$article['id']])}}">
                            <i class="icon-size" data-feather="edit-3"></i>
                        </a>
                        <form action="{{ route('tgs.article.accept', $article['id']) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            <input type="text" name="status" hidden value="accepted">
                            <button type="submit" class="btn btn-outline-success btn-sm px-2">
                                <span>Принят</span>
                            </button>
                        </form>
                        <form action="{{ route('tgs.article.accept', $article['id']) }}" method="POST"
                              style="display:inline;">
                            @csrf
                            <input type="text" name="status" hidden value="rejected">
                            <button type="submit" class="btn btn-outline-danger btn-sm px-2">
                                Отказ
                            </button>
                        </form>
                    @endif
                </td>
            </tr>

        @endforeach
    </table>
@endsection
