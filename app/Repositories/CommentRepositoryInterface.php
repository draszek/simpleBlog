<?php

namespace App\Repositories;

interface CommentRepositoryInterface
{
    public function create($data);

    public function find($id);

    public function delete($id);

    public function all();
}
