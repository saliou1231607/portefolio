<?php
declare(strict_types=1);

require __DIR__ . DIRECTORY_SEPARATOR . 'db.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

try {
    $database = database();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
        $name = trim((string) ($input['name'] ?? ''));
        $email = trim((string) ($input['email'] ?? ''));
        $message = trim((string) ($input['message'] ?? ''));

        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $message === '') {
            http_response_code(422);
            echo json_encode(['error' => 'Nom, email valide et message requis.']);
            exit;
        }

        $statement = $database->prepare(
            'INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)'
        );
        $statement->execute(['name' => $name, 'email' => $email, 'message' => $message]);
        http_response_code(201);
        echo json_encode(['message' => 'Votre message a bien été enregistré.']);
        exit;
    }

    $result = [
        'profile' => $database->query('SELECT * FROM profile WHERE id = 1')->fetch(),
        'skills' => $database->query('SELECT * FROM skills ORDER BY position')->fetchAll(),
        'projects' => $database->query('SELECT * FROM projects ORDER BY position')->fetchAll(),
        'experiences' => $database->query('SELECT * FROM experiences ORDER BY position')->fetchAll(),
    ];

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode(['error' => 'La base de données est indisponible.']);
}
