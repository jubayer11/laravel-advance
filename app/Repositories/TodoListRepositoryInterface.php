<?php

namespace App\Repositories;

interface TodoListRepositoryInterface
{
    public function all();

    public function findById($todolistId);

    public function update($id);

    public function delete($id);
}
