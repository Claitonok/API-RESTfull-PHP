<?php

header("Content-Type: application/json");

require 'db.php';

$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'GET':
        // Função para ler dados
        get_users();
        break;
    case 'POST':
        // Função para criar dados
        create_user();
        break;
    case 'PUT':
        // Função para atualizar dados
        update_user();
        break;
    case 'DELETAR':
        // Função para deletar dados
        delete_user();
        break;
    default:
        // Requisição inválida
        http_response_code(405);
        echo json_encode(["message" => "Método não permitido"]);
        break;
}

function get_users() {
    global $connection;

    $query = "SELECT * FROM `api_db`";
    $result = $connection->query($query);

    $users = [];

    foreach ($result as $key => $value) {
        $users[] = $value;
    }
    echo json_encode($users);
    // $users = [];
    // while($row = $result->fetch_assoc()) {
    //     $users[] = $row;
    // }
    // echo json_encode($users);

}

function create_user() {
    global $connection;

    $data = json_decode(file_get_contents("php://input"));
    $name = $data->name;
    $email = $data->email;
    $password = $data->password;

    $query = "INSERT INTO `api_db`(`id`, `name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
    if ($connection->query($query)) {
        echo json_encode(["message" => "Usuário criado com sucesso"]);
    } else {
        echo json_encode(["message" => "Erro ao criar usuário"]);
    }
}

function update_user() {
    global $connection;

    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id;
    $name = $data->name;
    $email = $data->email;
    $password = $data->password;

    $query = "UPDATE `api_db` SET `name`= $name,`email`=$email,`password`= $password WHERE `id`= $id";
    if ($connection->query($query)) {
        echo json_encode(["message" => "Usuário atualizado com sucesso"]);
    } else {
        echo json_encode(["message" => "Erro ao atualizar usuário"]);
    }
}

function delete_user() {

    global $connection;

    $data = json_decode(file_get_contents("php://input"));
    $id = $data->id;

    $query = "DELETE FROM `api_db` WHERE `id`= $id";
    if ($connection->query($query)) {
        echo json_encode(["message" => "Usuário deletado com sucesso"]);
    } else {
        echo json_encode(["message" => "Erro ao deletar usuário"]);
    }
}