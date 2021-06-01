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
                            <i class="icon-align-center"></i>
                            <textarea title=""></textarea>
                            <input type="text" name="title" value="{{isset($article->title)?$article->title:old('title')}}" placeholder="гавно">
                        </span>
                    </div>
                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Ключові слова:</span>
                        <br/>
                        <span class="sublabel">Заголовок матеріалу:</span>
                    </label>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-align-justify" </span>
                        <input type="text" name="keywords" value="{{isset($article->keywords)?$article->keywords:old('keywords')}">

                    </div>
                </li>
            </ul>
        </form>

    </div>
</div>
