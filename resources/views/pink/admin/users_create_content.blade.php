<div id="content-page" class="content group">
    <div class="hentry group">

        <form action="{{isset($user->id)?route('admin.users.update',['user'=>$user->id]):route('admin.users.store')}}" class="contact-form" method="post" enctype="multipart/form-data">
            @csrf

        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Имя:</span>
                    <br />
                    <span class="sublabel">Имя</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    <input type="text" name="name" placeholder="Введіть імя користувача" value="{{isset($user->name)?$user->name:old('name')}}">
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Логин:</span>
                    <br />
                    <span class="sublabel">Логин</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    <input type="text" name="login" placeholder="Введіть логін користувача" value="{{isset($user->login)?$user->login:old('login')}}">
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Email:</span>
                    <br />
                    <span class="sublabel">Email</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    <input type="text" name="email" placeholder="Введіть e-mail користувача" value="{{isset($user->email)?$user->email:old('email')}}">
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Пароль:</span>
                    <br />
                    <span class="sublabel">Пароль</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    <input type="password" name="password">
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Повтор пароля:</span>
                    <br />
                    <span class="sublabel">Повтор пароля</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    <input type="password" name="password_confirmation">
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Роль:</span>
                    <br />
                    <span class="sublabel">Роль</span><br />
                </label>
                <div class="input-prepend">

                    <select name="role_id">
                        @foreach($roles as $id=>$role)
                            <option value="{{$id}}" {{(isset($user) && $user->roles()->first()->id == $id)? 'selected':false}}>{{$role}}</option>
                        @endforeach
                    </select>
                </div>

            </li>





            @if(isset($user->id))
                <input type="hidden" name="_method" value="PUT">

            @endif

            <li class="submit-button">
                <input type="submit" value="Зберегти" class="btn btn-the-salmon-dance-5">
            </li>

        </ul>



        </form>


    </div>
</div>
