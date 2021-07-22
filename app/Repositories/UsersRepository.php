<?php
namespace App\Repositories;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UsersRepository extends Repository
{
    public function __construct (User $user)
    {
        $this->model = $user;
    }
    public function addUser ($request)
    {
        if (Gate::denies('create',$this->model))
        {
            abort(403);
        }
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
