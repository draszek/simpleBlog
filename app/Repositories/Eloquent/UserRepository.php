<?php

namespace App\Repositories\Eloquent;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\Users;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Exception;

class UserRepository implements UserRepositoryInterface
{

    /**
     * create user and encrypt password
     *
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $data['password'] = bcrypt($data['password']);

        return new UserResource(User::create($data));
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $user = User::find($id);

        foreach ($data as $key => $value) {
            try {
                $user->{$key} = $value;
            } catch (Exception $e) {
                continue;
            }
        }

        return $user->save();
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @param $id
     * @return UserResource
     */
    public function find($id)
    {
        return new UserResource(User::find($id));
    }

    /**
     * @return Users
     */
    public function all()
    {
        return new Users(User::all());
    }
}
