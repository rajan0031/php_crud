<?php

use Controllers\StudentController;

require_once '../controllers/StudentController.php';

// Get the current URI and method
$uri = parse_url(url: $_SERVER['REQUEST_URI'], component: PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Remove the /crud/public part from the URI
$uri = str_replace(search: "/crud/public", replace: "", subject: $uri);

// Remove any trailing slash
$uri = rtrim(string: $uri, characters: '/');

// Initialize the controller
$controller = new StudentController();

// Routing logic
switch ($uri) {
    case '/students':
        if ($method === 'GET') {
            $controller->index();
        } elseif ($method === 'POST') {
            $controller->store();
        }
        break;

    case (preg_match(pattern: '/^\/students\/\d+$/', subject: $uri) ? true : false):
        $id = basename(path: $uri);

        if ($method === 'GET') {
            $controller->show($id);
        } elseif ($method === 'PUT') {
            $controller->update($id);
        } elseif ($method === 'DELETE') {
            $controller->destroy($id);
        } 
        // Workaround: If PUT is sent via POST with override header
        elseif ($method === 'POST' && isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']) && $_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'] === 'PUT') {
            $controller->update($id);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['message' => 'Route not found']);
        break;
}
