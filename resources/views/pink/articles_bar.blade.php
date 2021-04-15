

    <div class="widget-first widget recent-posts">
        <h3>{{\Illuminate\Support\Facades\Lang::get('ua.latest_projects')}}</h3>
        <div class="recent-post group">
            @if(!$portfolios->isEmpty())
                @foreach($portfolios as $portfolio)
                    <div class="hentry-post group">
                        <div class="thumb-img"><img src="{{asset(env('theme'))}}/images/articles/{{$portfolio->img->mini}}" alt="{{$portfolio->title}}" title="{{$portfolio->title}}" /></div>
                        <div class="text">
                            <a href="{{route('portfolios.show',['alias'=>$portfolio->alias])}}" title="{{$portfolio->title}}" class="title">{{$portfolio->title}}</a>
                            {!! Illuminate\Support\Str::limit($portfolio->text,130)!!}
                            <a class="read-more" href="{{route('portfolios.show',['alias'=>$portfolio->alias])}}">{{\Illuminate\Support\Facades\Lang::get('ua.read_more')}}</a>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>



    <div class="widget-last widget recent-comments">
        <h3>Recent Comments</h3>
        <div class="recent-post recent-comments group">

            <div class="the-post group">
                <div class="avatar">
                    <img alt="" src="images/avatar/unknow55.png" class="avatar" />
                </div>
                <span class="author"><strong><a href="mailto:no-email@i-am-anonymous.not">eduard</a></strong> in</span>
                <a class="title" href="article.html">Nice &amp; Clean. The best for your blog!</a>
                <p class="comment">
                    hi <a class="goto" href="article.html">&#187;</a>
                </p>
            </div>

            <div class="the-post group">
                <div class="avatar">
                    <img alt="" src="images/avatar/nicola55.jpeg" class="avatar" />
                </div>
                <span class="author"><strong><a href="mailto:nicola@yopmail.com">nicola</a></strong> in</span>
                <a class="title" href="article.html">This is the title of the first article. Enjoy it.</a>
                <p class="comment">
                    While i’m the author of the post. My comment template is different,... <a class="goto" href="article.html">&#187;</a>
                </p>
            </div>

            <div class="the-post group">
                <div class="avatar">
                    <img alt="" src="images/avatar/unknow55.png" class="avatar" />
                </div>
                <span class="author"><strong><a href="mailto:no-email@i-am-anonymous.not">Anonymous</a></strong> in</span>
                <a class="title" href="article.html">This is the title of the first article. Enjoy it.</a>
                <p class="comment">
                    Hi all, i’m a guest and this is the guest’s awesome comments... <a class="goto" href="article.html">&#187;</a>
                </p>
            </div>
        </div>
    </div>

