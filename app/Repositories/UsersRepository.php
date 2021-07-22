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
            dd($data);
            return ['error' => 'Відсутні дані'];
        }
        $user = $this->model->create([
            'name' => $data['name'],
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        if ($user)
        {
            $user->roles()->attach($data['role_id']);
        }
        return ['status'=> 'Користувача додано'];
    }
    public function updateUser ($request, $user)
    {
        if (Gate::denies('edit',$this->model))
        {
            abort(403);
        }
        $data = $request->all();

        if (isset($data['password']))
        {
            $data['password'] = bcrypt($data['password']);
        }
        $user->fill($data)->update();
        $user->roles()->sync([$data['role_id']]);
        return ['status' => 'Дані користувача змінено'];
    }
    public function deleteUser ($user)
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
