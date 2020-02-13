<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\UserRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return Comment::create($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Comment::find($id);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $user = $this->find($id);
        foreach($data as $key => $value) {
            if(property_exists(Comment::class, $key)) {
                $user->{$key} = $value;
            }
        }

        return $user->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @return Comment[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Comment::all();
    }
}
