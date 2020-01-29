<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function create($data);

    public function find($id);

    public function update($id, $data);

    public function delete($id);

    public function all();
}
