<!-- START CONTENT -->
<div id="content-page" class="content sidebar-no group">
    <div class="hentry group">
        @if($portfolios)


        <div id="portfolio" class="portfolio-big-image">

            @foreach($portfolios as $portfolio)
                <div class="hentry work group">
                    <div class="work-thumbnail">
                        <div class="nozoom">
                            <img src="{{asset(env('theme'))}}/images/projects/{{$portfolio->img->max}}" alt="{{$portfolio->alias}}" title="{{$portfolio->title}}" />
                            <div class="overlay">
                                <a class="overlay_img" href="{{asset(env('theme'))}}images/projects/{{$portfolio->img->path}}" rel="lightbox" title="{{$portfolio->title}}"></a>
                                <a class="overlay_project" href="{{route('portfolios.show',['alias'=>$portfolio->alias])}}"></a>
                                <span class="overlay_title">{{$portfolio->title}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="work-description">
                        <h3>{{$portfolio->title}}</h3>
                        <p>{{$portfolio->text}}</p>
                        <div class="clear"></div>
                        <div class="work-skillsdate">
                            <p class="skills"><span class="label">Filter:</span> {{$portfolio->filter->title}}</p>
                            <p class="wordate"><span class="label">Customer:</span> {{$portfolio->customer}}</p>
                            @if($portfolio->created_at)
                                <p class="wordate"><span class="label">Year:</span> {{$portfolio->created_at->format('Y')}}</p>
                            @endif
                        </div>
                        <a class="read-more" href="{{route('portfolios.show',['alias'=>$portfolio->alias])}}">View Project</a>
                    </div>
                    <div class="clear"></div>
                </div>
            @endforeach
                <div class="general-pagination group">
                    @if($portfolios->lastPage() > 1)
                        @if($portfolios->currentPage() !== 1)
                            <a href="{{$portfolios->url(($portfolios->currentPage())-1)}}">{!! \Illuminate\Support\Facades\Lang::get('pagination.previous') !!}</a>
                        @endif
                        @for($i=1; $i<=$portfolios->lastPage();$i++)
                            @if($portfolios->currentPage() == $i)
                                <a  class="selected disabled">{{$i }}</a>
                            @else
                                <a href="{{$portfolios->url($i)}}">{{$i}}</a>
                            @endif

                        @endfor
                        @if($portfolios->currentPage() !== $portfolios->lastPage())
                            <a href="{{$portfolios->url($portfolios->currentPage()+1)}}">{!! \Illuminate\Support\Facades\Lang::get('pagination.next')!!}</a>
                        @endif

                    @endif
                </div>


        </div>
        @endif
        <div class="clear"></div>
    </div>
</div>
<!-- END CONTENT -->
