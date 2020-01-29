<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\UserRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    public function create($data)
    {
        return Comment::create($data);
    }

    public function find($id)
    {
        return Comment::find($id);
    }

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

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function all()
    {
        return Comment::all();
    }
}
