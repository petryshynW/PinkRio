<div id="content-page" class="content group">
    <div class="hentry group">
        <form method="post" action="{{isset($article->id)/*?route('admin.articles.update',['articles'=>'alias']):route('admin.articles.store')*/}}" class="contact-form" enctype="multipart/form-data">
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
                        </span>
                            <input type="text" name="title" value="{{isset($article->title)?$article->title:old('title')}}" placeholder="назва">
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
                        </span>
                            <input type="text" name="meta_desc" value="{{isset($article->meta_desc)?$article->meta_desc:old('meta_desc')}}" placeholder="гавно">
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Псевдонім:</span>
                        <br/>
                        <span class="sublabel">Введіть псевдонім:</span>
                    </label>
                    <div class="input-prepend">
                        <span class="add-on">
                            <i class="icon-user"></i>
                        </span>
                            <input type="text" name="alias" value="{{isset($article->alias)?$article->alias:old('alias')}}" placeholder="гавно">
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Короткий опис:</span>
                    </label>
                    <div class="input-prepend">
                            <textarea id="editor1" name="desc" >{{isset($article->desc)?$article->desc:old('desc')}}</textarea>
                        <div class="msg-error"></div>
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Текст:</span>
                    </label>
                    <div class="input-prepend">
                            <textarea id="editor" name="text" >{{isset($article->text)?$article->text:old('text')}}</textarea>
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
                        <select>
                            @if(isset($categories) && count($categories)>0)

                                @foreach($categories as $cat_title=>$cat_value)
                                    <optgroup label="{{$cat_title}}">
                                        @foreach($cat_value as $key=>$value)
                                            <option {{(isset($articles->category_id) && $articles->category_id==$key)?'selected':''}}value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            @endif

                        </select>
                    </label>
                    <div class="input-prepend">
                        <input type="file" class="lifestyle data-button">
                    </div>
                </li>
                @if(isset($article->id))
                    <input type="hidden" name="_method" value="PUT">
                @endif
                <li class="submit-button">
                    <input type="submit" value="Зберегти">
                </li>
            </ul>
        </form>

    </div>
</div>
<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor1');
    CKEDITOR.instances.editor.setData(document.getElementById('editor1').value) ;
    CKEDITOR.instances.editor.setData(document.getElementById('editor').value) ;
    $('form').on('submit',function (){
        document.getElementById('editor').value = CKEDITOR.instances.editor.getData();
        document.getElementById('editor1').value = CKEDITOR.instances.editor.getData();
    })
</script>
