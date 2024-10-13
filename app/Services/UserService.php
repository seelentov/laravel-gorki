<?php

namespace App\Services;

use App\Models\User;
use App\Services\Abstract\AbstractDataService;

class UserService extends AbstractDataService
{

    public function __construct()
    {
        $this->model = new User();
    }
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function isExist(int $id)
    {
        return $this->model->find($id) != null;
    }
}
