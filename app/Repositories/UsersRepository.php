<?php
namespace App\Repositories;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use function PHPUnit\Framework\isEmpty;

class UsersRepository extends Repository
{
    public function __construct (User $user)
    {
        $this->model = $user;
    }
    public function addUser (UserRequest $request)
    {
        if (Gate::denies('create',$this->model))
        {
            abort(403);
        }
        $data = $request->all();
        if (empty($data))
        {
            return ['error' => 'Відсутні дані'];
        }//dd($data);
        $user = $this->model->create([
            'view_name' => $data['view_name'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        if ($user)
        {
            $user->roles()->attach($data['role_id']);
        }
        return ['status'=> 'Користувача додано'];
    }
    public function updateUser (UserRequest $request,User $user)
    {
        if (Gate::denies('edit',$this->model))
        {
            abort(403);
        }
        $data = $request->only('view_name','name','email','password','role_id');

        if (isset($data['password']))
        { dd('no pass');
            $data['password'] = bcrypt($data['password']);
        }
        else
        { unset($data['password']);}
        //dd($data);
        $user->fill($data)->update();
        $user->roles()->sync([$data['role_id']]);
        return ['status' => 'Дані користувача змінено'];
    }
    public function deleteUser (User $user)
    {
        if (Gate::denies('edit',$this->model))
        {
            abort(403);
        }
        $user->roles()->detach();
        if ($user->delete())
        {
            return['status'=>'Користувача видалено'];
        }
    }

}
