<<div id="content-page" class="content group">
    <div class="hentry group">
        <form method="post" action="{{isset($article->id)?route('admin.articles.update',['articles'=>'alias']):route('admin.articles.store')}}" class="contact-form" enctype="multipart/form-data">
            <ul>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Назва:</span>
                        <br/>
                        <span class="sublabel">Заголовок:</span><br/>
                    </label>
                    <div class="input-prepend">
                        <span class="add-on">
                            <i class="icon-user"></i>
                            <input type="text" name="title" value="{{isset($article->title)?$article->title:old('title')}}" placeholder="гавно">
                        </span>
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Ключові слова:</span>
                        <br/>
                        <span class="sublabel">Заголовок:</span><br/>
                    </label>
                    <div class="input-prepend">
                        <span class="add-on">
                            <i class="icon-user"></i>
                            <input type="text" name="meta_desc" value="{{isset($article->meta_desc)?$article->meta_desc:old('meta_desc')}}" placeholder="гавно">
                        </span>
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Псевдонім:</span>
                        <br/>
                        <span class="sublabel">Введіть псевдонім:</span><br/>
                    </label>
                    <div class="input-prepend">
                        <span class="add-on">
                            <i class="icon-user"></i>
                            <input type="text" name="alias" value="{{isset($article->alias)?$article->alias:old('alias')}}" placeholder="гавно">
                        </span>
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Короткий опис:</span>
                    </label>
                    <div class="input-prepend">
                        <span class="add-on">
                            <i class="icon-user"></i>
                            <textarea name="desc" >{{isset($article->desc)?$article->desc:old('desc')}}</textarea>
                        </span>
                        <div class="msg-error"></div>
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Короткий опис:</span>
                    </label>
                    <div class="input-prepend">
                        <span class="add-on">
                            <i class="icon-user"></i>
                            <textarea name="text" >{{isset($article->text)?$article->text:old('text')}}</textarea>
                        </span>
                        <div class="msg-error"></div>
                    </div>
                </li>
                @if(isset($article->img->path))
                <li class="textarea-field">
                    <label>
                        <span class="label">Зображення матеріалу:</span>
                    </label>
                    <img src="{{asset(env('theme').'/images/articles/'.$article->img->path)}}">
                    <input type="hidden" name="old_image" value="{{$article->img->path}}">
                </li>
                @endif
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Зображення:</span>
                        <br/>
                        <span class="sublabel">Зображення матеріалу:</span><br/>
                    </label>
                    <div class="input-prepend">
                        <input type="file" class="lifestyle data-button">
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Категорія:</span>
                        <br/>
                        <span class="sublabel">Категорія матеріалу:</span><br/>
                    </label>
                    <div class="input-prepend">
                        <input type="file" class="lifestyle data-button">
                    </div>
                </li>
            </ul>
        </form>

    </div>
</div>
