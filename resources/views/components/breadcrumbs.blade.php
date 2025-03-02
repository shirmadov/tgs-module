<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @if (Request::routeIs('tgs.article.show'))
            <li class="breadcrumb-item"><a href="{{ route('tgs.article.index') }}">Cписок статей</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $article->title ?? 'View Article' }}</li>

        @elseif (Request::routeIs('tgs.article.edit'))
            <li class="breadcrumb-item"><a href="{{ route('tgs.article.index') }}">Cписок статей</a></li>
            <li class="breadcrumb-item"><a href="{{ route('tgs.article.show', $article) }}">{{ $article->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редактирование</li>
        @endif
    </ol>
</nav>
