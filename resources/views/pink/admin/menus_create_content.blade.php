<div id="content-page" class="content group">
    <div class="hentry group">

    <form action="{{isset($menu->id) ? route('admin.menus.update',['menu'=>$menu->id]) : route('admin.menus.store')}}" class="contact-form" method="post" enctype="multipart/form-data">
        @csrf
        <ul>


            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Заголовок:</span>
                    <br />
                    <span class="sublabel">Заголовок пункта</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    <input type="text" name="title" value="{{isset($menu->title) ? $menu->title  : old('title'), }}" placeholder="Введите название страницы">

                </div>
            </li>


            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Родительский пункт меню:</span>
                    <br />
                    <span class="sublabel">Родитель:</span><br />
                </label>
                <div class="input-prepend">
                    <select name="parent">
                        @foreach($menus as $key=>$value)
                            <option value="{{$key}}">{{$value}}"</option>
                        @endforeach
                    </select>
                    {!! ''//Form::select('parent', $menus, isset($menu->parent) ? $menu->parent : null) !!}
                </div>

            </li>
        </ul>

        <h1>Тип меню:</h1>

        <div id="accordion">

            <h3>{!!''// Form::radio('type', 'customLink',(isset($type) && $type == 'customLink') ? TRUE : FALSE,['class' => 'radioMenu']) !!}
                <input name="type" type="radio" value="customLink" {{(isset($type) && $type == 'customLink') ? 'Checked' : ''}} class="radioMenu">
                <span class="label">Пользовательская ссылка:</span></h3>

            <ul>

                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Путь для ссылки:</span>
                        <br />
                        <span class="sublabel">Путь для ссылки</span><br />
                    </label>
                    <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                        {!! ''//Form::text('custom_link',(isset($menu->path) && $type=='customLink') ? $menu->path  : old('custom_link'), ['placeholder'=>'Введите название страницы']) !!}
                        <input type="text" name="custom_link" value="{{(isset($menu->path) && $type=='customLink') ? $menu->path  : old('custom_link')}}" placeholder="Введите название страницы">
                    </div>
                </li>
                <div style="clear: both;"></div>
            </ul>


            <h3>{!! ''//Form::radio('type', 'blogLink',(isset($type) && $type == 'blogLink') ? TRUE : FALSE,['class' => 'radioMenu']) !!}
                <input name="type" type="radio" value="blogLink" {{(isset($type) && $type == 'blogLink') ? 'Checked' : ''}} class="radioMenu">
                <span class="label">Раздел Блог:</span></h3>

            <ul>

                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Ссылка на категорию блога:</span>
                        <br />
                        <span class="sublabel">Ссылка на категорию блога</span><br />
                    </label>
                    <div class="input-prepend">

                        @if($categories)
                            {!!''// Form::select('category_alias',$categories,(isset($option) && $option) ? $option :FALSE) !!}
                            <select name="category_alias">
                                @foreach($categories as $key=>$cat)
                                    @if(is_array($cat))
                                        <optgroup label="{{$key}}">
                                        @foreach($cat as $itemKey=>$item)
                                            <option {{(isset($option) && $option == $itemKey) ? 'selected' :FALSE}} value="{{$itemKey}}">{{$item}}</option>
                                        @endforeach
                                        </optgroup>
                                    @else
                                        <option {{(isset($option) && $option == $key) ? 'selected' :FALSE}} value="{{$key}}">{{$cat}}</option>
                                    @endif

                                @endforeach
                            </select>
                        @endif
                    </div>
                </li>


                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Ссылка на материал блога:</span>
                        <br />
                        <span class="sublabel">Ссылка на материал блога</span><br />
                    </label>
                    <div class="input-prepend">
                        {!! ''//Form::select('article_alias', $articles, (isset($option) && $option) ? $option :FALSE, ['placeholder' => 'Не используется']) !!}
                        <select name="article_alias" >
                            <option value="" disabled selected style='display:none;'>Не використовується</option>

                        @foreach($articles as $key=>$article)
                                <option {{(isset($option) && $option) ? 'selected' :FALSE}} value="{{$key}}">{{$article}}</option>
                            @endforeach
                        </select>
                    </div>

                </li>
                <div style="clear: both;"></div>
            </ul>



            <h3>{!! ''//Form::radio('type', 'portfolioLink',(isset($type) && $type == 'portfolioLink') ? TRUE : FALSE,['class' => 'radioMenu']) !!}
                <input name="type" type="radio" value="portfolioLink" {{(isset($type) && $type == 'portfolioLink') ? 'Checked' : ''}} class="radioMenu">
                <span class="label">Раздел портфолио:</span></h3>

            <ul>

                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Ссылка на запись портфолио:</span>
                        <br />
                        <span class="sublabel">Ссылка на запись портфолио</span><br />
                    </label>
                    <div class="input-prepend">
                        {!!''/// Form::select('portfolio_alias', $portfolios, (isset($option) && $option) ? $option :FALSE, ['placeholder' => 'Не используется']) !!}
                        <select name="portfolio_alias" >
                            <option value="" disabled selected style='display:none;'>Не використовується</option>
                            @foreach($portfolios as $key=>$portfolio)
                                <option {{(isset($option) && $option == $key) ? 'selected' :FALSE}} value="{{$key}}">{{$portfolio}}</option>
                            @endforeach
                        </select>

                    </div>

                </li>
                <li class="text-field">
                    <label for="name-contact-us">
                        <span class="label">Портфоліо:</span>
                        <br>
                        <span class="sublabel">Портфоліо</span>
                    </label>
                    <div class="input-prepend">
                        <select name="filter_alias">
                            <option value="" disabled selected style='display:none;'>Не використовується</option>
                            @foreach($filters as $key=>$filter)
                                <option {{(isset($option) && $option == $key) ? 'selected' :FALSE}} value="{{$key}}">{{$filter}}</option>
                            @endforeach
                        </select>
                    </div>

                </li>




            </ul>



        </div>

        <br />

        @if(isset($menu->id))
            <input type="hidden" name="_method" value="PUT">

        @endif
        <ul>
            <li class="submit-button">

                <input type="submit" value="Зберегти" class="btn btn-the-salmon-dance-3">
            </li>
        </ul>
    </form>



    </div>
</div>
<script>
    jQuery(function ($)
    {
        $('#accordion').accordion({
            activate:function (e,obj)
            {
                obj.newPanel.prev().find('input[type=radio]').attr('checked','checked');
            }
        });
        var active =0;
        $('#accordion input[type=radio]').each(function (ind,it){
            if ($(this).prop('checked'))
            {
                active = ind;
            }
        });
        $('#accordion').accordion('option','active',active)
    })
</script>
