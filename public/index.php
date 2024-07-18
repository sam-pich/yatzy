
<?php
require_once('_config.php');
session_start();

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Yatzy\Leaderboard;
require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();
$leaderboard = new Leaderboard();

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);


// get html page
$app->get('/', function (Request $request, Response $response, $args) {
    $view = file_get_contents("{$GLOBALS["appDir"]}/views/index.html");
    $response->getBody()->write($view);

    return $response;
});

// api route for version
$app->get('/api/version', function (Request $request, Response $response, $args) {
    $data = ["version" => "1.0"];

    return jsonReply($response, $data);
});

// api route for dice
$app->get('/api/roll', function ($request, $response) {
    if (!isset($_SESSION['game_state'])) {
        $_SESSION['game_state'] = [
            'current_roll' => [],
            'leaderboard' => []
        ];
    }

    $dice = new \Yatzy\Dice();
    $roll = [];
    for ($i = 0; $i < 5; $i++) {
        $roll[] = $dice->roll();
    }
    $_SESSION['game_state']['current_roll'] = $roll;

    $response->getBody()->write(json_encode(['roll' => $roll]));
    return $response->withHeader('Content-Type', 'application/json');
});

// leaderboard api routes
$app->get('/api/leaderboard', function ($request, $response) {
    if (!isset($_SESSION['game_state'])) {
        $_SESSION['game_state'] = [
            'current_roll' => [],
            'leaderboard' => []
        ];
    }

    $leaderboard = $_SESSION['game_state']['leaderboard'];
    $response->getBody()->write(json_encode(['leaderboard' => $leaderboard]));

    return $response->withHeader('Content-Type', 'application/json');
});


$app->post('/api/leaderboard', function ($request, $response) {
    $input = json_decode($request->getBody(), true);
    if (!isset($_SESSION['game_state'])) {
        $_SESSION['game_state'] = [
            'current_roll' => [],
            'leaderboard' => []
        ];
    }

    $_SESSION['game_state']['leaderboard'][] = [
        'player' => $input['player'],
        'score' => $input['score']
    ];
    usort($_SESSION['game_state']['leaderboard'], function ($a, $b) {
        return $b['score'] - $a['score'];
    });
    $_SESSION['game_state']['leaderboard'] = array_slice($_SESSION['game_state']['leaderboard'], 0, 10);

    return $response->withStatus(200);
});

// leaderboard reset
$app->post('/api/leaderboard/clear', function ($request, $response) {
    if (!isset($_SESSION['game_state'])) {
        $_SESSION['game_state'] = [
            'current_roll' => [],
            'leaderboard' => []
        ];
    }
    $_SESSION['game_state']['leaderboard'] = [];

    return $response->withStatus(200);
});
function jsonReply(Response $response, $data)
{
    $payload = json_encode($data);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
}

$app->run();
