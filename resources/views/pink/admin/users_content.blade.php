<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Пользователи</h3>


        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Login</th>
                <th>Role</th>
                <th>Удалить</th>
                </thead>
                @if($users)


                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><a href="{{route('admin.users.edit',['user' => $user->id])}}">{{$user->view_name}}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->roles->implode('name', ', ') }}</td>


                            <td>
                                <form action="{{route('admin.users.destroy',['user'=> $user->id])}}" class="form-horizontal" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="submit" value="Видалити" class="btn btn-french-5">
                                </form>

                            </td>
                        </tr>
                    @endforeach

                @endif
            </table>
        </div>
        <a href="{{route('admin.users.create')}}" class="btn btn-the-salmon-dance-3">Додати користувача</a>

    </div></div>