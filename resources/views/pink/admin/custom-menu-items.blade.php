<p>sdsdsdsd</p>
@foreach($items as $item)

    <tr>
        <td style="'test-align:left;">{{$paddingLeft}}{{route('admin.menus.edit',['menu'=>$item->id],$item->title)}}</td>
        <td>{{$item->url()}}</td>
        <td>
            <form action="{{route('admin.menus.destroy',['menu'=>$item->id])}}" class="form-horizontal" method="delete">
                <input type="button" value="Видалити" class="btn btn-french-5">
            </form>
        </td>
    </tr>
    @if($item->hasChildren())
        @include(env('theme').'.admin.custom-menu-items',array('items'=>$item->children(),'paddingLeft'=>$paddingLeft.'--'))
    @endif
    $i++
    print_r($i)
@endforeach