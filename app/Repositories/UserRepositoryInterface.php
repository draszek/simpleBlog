<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function create($data);

    public function find($id);

    public function update($id, $data);

    public function delete($id);

    public function all();
}
