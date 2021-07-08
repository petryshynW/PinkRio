@if($articles)
    <div id="content" class="content group">
        <div class="hentry group">
            <h2> Додавання статті</h2>
            <div class="short-table white">
                <table style="width: 100%" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th class="align-left">ID</th>
                            <th>Заголовок</th>
                            <th>Текст</th>
                            <th>Зображення</th>
                            <th>Категорії</th>
                            <th>Псевдонім</th>
                            <th>Дія</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td class="align-left">{{$article->id}}</td>
                                <td class="align-left"><a href="/admin/articles/{{$article->alias}}/edit">{{$article->alias}}</a></td>
                                <td class="align-left">{{\Illuminate\Support\Str::limit($article->text,200)}}</td>
                                <td>
                                    @if(isset($article->img->mini))
                                        <img src="{{env('theme').'/images/articles/'.$article->img->mini}}">
                                    @endif
                                </td>
                                <td>{{$article->category->title}}</td>
                                <td>{{$article->alias}}</td>
                                <td>
                                    <form method="post" class="form-horizontal">
                                        @csrf
                                        <input type="submit" value="Видалити">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="/admin/articles/newArticle" class="btn btn-amor-3">Додати запис</a>
        </div>
    </div>
@endif
