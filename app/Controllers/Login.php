<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class Login extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        helper(['form']);
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new UserModel();
        $employee = $model->where('email', $this->request->getVar('email'))->first();
        if (!$employee) return $this->failNotFound('Employee tidak ditemukan');
        if (!password_verify($this->request->getVar('password'), $employee['password'])) return $this->fail('Password Salah');

        $key = getenv('JWT_SECRET');
        $payload = array(
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "uid" => $employee['id']
        );

        $token = JWT::encode($payload, $key);

        return $this->respond($token);
    }
}
