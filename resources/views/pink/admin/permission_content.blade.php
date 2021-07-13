<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Привілеї</h3>
        <form action="{{route('admin.permission.index')}}" method="post">
            @csrf
            <div class="short-table white">
                <table style="width: 100%">
                    <thead>
                        <th>Привілеї</th>
                        @if(!$roles->isEmpty())
                            @foreach($roles as $role)
                                <th>{{$role->name}}</th>
                            @endforeach
                        @endif
                    </thead>
                    <tbody>
                        @if(!$priv->isEmpty())
                            @foreach($priv as $pr)
                                <tr>
                                    <td>{{$pr->name}}</td>
                                    @foreach($roles as $role)
                                        @if($role->hasPermission($pr->name))
                                            <td><input checked name="{{$role->id}}[]" type="checkbox" value="{{$pr->id}}"></td>
                                        @else
                                            <td><input name="{{$role->id}}[]" type="checkbox" value="{{$pr->id}}"></td>
                                        @endif

                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <input class="btn btn-the-salmon-dance-3" type="submit" value="Оновити">
        </form>
    </div>

</div>
