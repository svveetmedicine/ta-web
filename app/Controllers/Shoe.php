<?php

namespace App\Controllers;

use App\Models\ShoeModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Shoe extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new ShoeModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $model = new ShoeModel();
        $data = $model->getWhere(['id' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $id);
        }
    }

    public function create()
    {
        $model = new ShoeModel();

        $data = [
            'brandname' => $this->request->getPost('brandname'),
            'shoename' => $this->request->getPost('shoename'),
            'size' => $this->request->getPost('size'),
            'color' => $this->request->getPost('color'),
            'condition' => $this->request->getPost('condition'),
            'price' => $this->request->getPost('price'),
            'contactinfo' => $this->request->getPost('contactinfo'),
        ];

        $data = json_decode(file_get_contents("php://input"));

        // $data = $this->request->getPost();
        $model->insert($data);

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respondCreated($data, 201);
    }

    public function update($id = null)
    {
        $model = new ShoeModel();

        $json = $this->request->getJSON();

        if ($json) {
            $data = [
                'brandname' => $json->brandname,
                'shoename' => $json->shoename,
                'size' => $json->size,
                'color' => $json->color,
                'condition' => $json->condition,
                'price' => $json->price,
                'contactinfo' => $json->contactinfo,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'brandname' => $this->request->getPost('brandname'),
                'shoename' => $this->request->getPost('shoename'),
                'size' => $this->request->getPost('size'),
                'color' => $this->request->getPost('color'),
                'condition' => $this->request->getPost('condition'),
                'price' => $this->request->getPost('price'),
                'contactinfo' => $this->request->getPost('contactinfo'),
            ];
        }
        // Insert to Database
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
        $model = new ShoeModel();
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
