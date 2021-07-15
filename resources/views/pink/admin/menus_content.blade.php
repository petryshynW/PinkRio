<div id="content-page" class="content group">
    <h3 class="title_page">Користувачі</h3>
    <div class="short-table white">
        <table style="width:100%">
            <thead>
                <th>Name</th>
                <th>Link</th>
                <th>Видалити</th>
            </thead>
            @if($menus)
                @include(env('theme').'.admin.custom-menu-items',array('items'=>$menus->roots(),'paddingLeft'=>''))
            @endif

        </table>
    </div>
    <a href="{{route('admin.menus.create')}}" class="btn btn-the-salmon-dance-3">Додати пункт меню</a>
</div>
