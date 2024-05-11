<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function index(array $query);
    public function checkUser(array $data);
    public function checkUserById($id);
    public function createUser(array $data);
    public function updateUser(int $id,array $data);
    public function deleteUser(int $id);
}
