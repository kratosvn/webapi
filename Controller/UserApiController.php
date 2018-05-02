<?php

namespace WebApi\Controller;

include_once '../Db/Connection.php';
use WebApi\Db\Connection;

class UserApiController
{
    protected $connection;

    function __construct()
    {
        try {
            $this->connection = Connection::getInstance();
        } catch (\Exception $e) {

        }
        header('Content-Type: application/json');
    }

    public function get()
    {
        $id = $_GET['id'];
        if (!empty($id)) {
            $query = "SELECT * FROM users where id = $id";
            $result = $this->connection->query($query);
            if ($result->num_rows > 0) {
                $dataReturn = $this->prepareGetUserData($result->fetch_assoc());
                echo json_encode($dataReturn);
                die;
            }
        }

        http_response_code(400);
        $error = ['message' => 'user not found'];
        echo json_encode($error);
        die;
    }

    public function update()
    {
        $id = $_POST['id'];
        $data = $_POST['data'];

        if ($id && $this->validateDataUpdate($data)) {
            $dataUpdate = $this->prepareDataUpdate($data);
            $query = "UPDATE users SET name = ?, tel = ?, address = ? WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            if ($stmt) {
                $stmt->bind_param("ssss", $dataUpdate['name'], $dataUpdate['tel'], $dataUpdate['address'], $id);
                $stmt->execute();

                $response = ["success" => 1];
                echo json_encode($response);
                die;
            }
        }
        http_response_code(400);
        echo json_encode(["success" => 0, 'message' => "Error updating record."]);
        die;
    }

    protected function prepareGetUserData($userData)
    {
        $attributeReturn = ['id', 'name', 'email', 'dob', 'tel'];
        $dataReturn = [];
        foreach ($userData as $attribute => $value) {
            if (in_array($attribute, $attributeReturn)) {
                $dataReturn[$attribute] = $value;
            }
        }

        return $dataReturn;
    }

    protected function validateDataUpdate($userData)
    {
        //Todo:: check attribute allow update, type of input , required attribute etc.
        return true;
    }

    protected function prepareDataUpdate($userData)
    {
        //Todo:: if user wana change password we should encode password here, exclude attribute doesn't necessary
        unset($userData['email']);

        return $userData;
    }
}