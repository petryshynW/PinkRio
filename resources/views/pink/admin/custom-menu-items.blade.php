@foreach($items as $item)

    <tr>
        <td style="text-align:left;"><a href="{{route('admin.menus.edit',['menu'=>$item->id],$item->title)}}" >{{$paddingLeft.$item->title}}</a> </td>
        <td><a href="{{$item->url()}}">{{$item->url()}}</a></td>
        <td>
            <form action="{{route('admin.menus.destroy',['menu'=>$item->id])}}" class="form-horizontal" method="delete">
                <input type="button" value="Видалити" class="btn btn-french-5">
            </form>
        </td>
    </tr>
    @if($item->hasChildren())
        @include(env('theme').'.admin.custom-menu-items',array('items'=>$item->children(),'paddingLeft'=>$paddingLeft.'--'))
    @endif
@endforeach
