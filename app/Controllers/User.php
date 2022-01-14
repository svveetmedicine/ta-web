<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;

class User extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $key = getenv('JWT_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');

        if (!$header) return $this->failUnauthorized('Unauthorized');

        $token = explode(' ', $header)[1];

        try {
            JWT::decode($token, $key, ['HS256']);
        } catch (\Throwable $th) {
            return $this->fail('Invalid Token');
        }

        $model = new UserModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $key = getenv('JWT_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');

        if (!$header) return $this->failUnauthorized('Unauthorized');

        $token = explode(' ', $header)[1];

        try {
            JWT::decode($token, $key, ['HS256']);
        } catch (\Throwable $th) {
            return $this->fail('Invalid Token');
        }

        $model = new UserModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }

    public function create()
    {
        $model = new UserModel();

        $data = [
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
        ];

        $model->insert($data);

        return $this->respondCreated($data, 201);
    }

    public function update($id = null)
    {
        $key = getenv('JWT_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');

        if (!$header) return $this->failUnauthorized('Unauthorized');

        $token = explode(' ', $header)[1];

        try {
            JWT::decode($token, $key, ['HS256']);
        } catch (\Throwable $th) {
            return $this->fail('Invalid Token');
        }

        $model = new UserModel();

        $json = $this->request->getJSON();

        if ($json) {
            $data = [
                'name' => $json->name,
                'email' => $json->email,
                'password' => password_hash($json->password, PASSWORD_BCRYPT)
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('password'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
            ];
        }
        
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $key = getenv('JWT_SECRET');
        $header = $this->request->getServer('HTTP_AUTHORIZATION');

        if (!$header) return $this->failUnauthorized('Unauthorized');

        $token = explode(' ', $header)[1];

        try {
            JWT::decode($token, $key, ['HS256']);
        } catch (\Throwable $th) {
            return $this->fail('Invalid Token');
        }

        $model = new UserModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }
}
