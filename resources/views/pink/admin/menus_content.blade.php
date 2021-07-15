<div id="content-page" class="content group">
    <h3 class="title_page">Користувачы</h3>
    <div class="short-table white">
        <table style="width:100%">
            <thead>
                <th>Name</th>
                <th>Link</th>
                <th>Видалити</th>
            </thead>
            <p>sdsdsdsd</p>
            @if($menus)
                <p>sdsdsdsd</p>
                @include(env('theme').'.admin.custom-menu-items',array('items'=>$menus->roots(),'paddingLeft'=>''))
                <p>sdsdsdsd</p>
            @endif

        </table>
    </div>
</div>