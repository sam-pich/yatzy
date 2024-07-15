<?php
require_once('_config.php');
//
use Yatzy\Dice;
use Yatzy\YatzyGame;
use Yatzy\YatzyEngine;
//lab 6 below
//
//// test Dice
//$dice = new Dice();
//
//echo "test dice roll:<br>";
//
//for ($i = 1; $i <= 5; $i++) {
//    echo "Roll {$i}: {$dice->roll()}<br>";
//}
//
//// test YatzyGame
//$game = new YatzyGame();
//// game init
//echo "<br>Initial game:<br>";
//echo "Roll: {$game->roll}<br>";
//echo "Dice: " . implode(", ", $game->dice) . "<br>";
//// dice roll
//echo "<br>Roll dice:<br>";
//$game->rollDice();
//echo "Roll: {$game->roll}<br>";
//echo "Dice: " . implode(", ", $game->dice) . "<br>";
//
//// toggle keep dice index 0
//echo "<br>Toggle keep on dice index 0:<br>";
//$game->toggleKeep(0);
//$game->rollDice();
//echo "Roll: {$game->roll}<br>";
//echo "Dice: " . implode(", ", $game->dice) . "<br>";
//echo "Keep: " . implode(", ", $game->keep) . "<br>";
//
//// test YatzyEngine
//echo "<br>Dice scoring:<br>";
//
//$game->scores['ones'] = YatzyEngine::scoreOnes($game);
//$game->scores['twos'] = YatzyEngine::scoreTwos($game);
//$game->scores['threes'] = YatzyEngine::scoreThrees($game);
//$game->scores['fours'] = YatzyEngine::scoreFours($game);
//$game->scores['fives'] = YatzyEngine::scoreFives($game);
//$game->scores['sixes'] = YatzyEngine::scoreSixes($game);
//
//$game->scores['three_of_a_kind'] = YatzyEngine::scoreThreeOfAKind($game);
//$game->scores['four_of_a_kind'] = YatzyEngine::scoreFourOfAKind($game);
//$game->scores['full_house'] = YatzyEngine::scoreFullHouse($game);
//$game->scores['small_straight'] = YatzyEngine::scoreSmallStraight($game);
//$game->scores['large_straight'] = YatzyEngine::scoreLargeStraight($game);
//
//$game->scores['yatzy'] = YatzyEngine::scoreYatzy($game);
//$game->scores['chance'] = YatzyEngine::scoreChance($game);
//
//YatzyEngine::updateScore($game);
//
//echo "Total score: {$game->overallScore}<br>";
//echo "Scores: <br>";
//
//foreach ($game->scores as $category => $score) {
//    echo ucfirst(str_replace('_', ' ', $category)) . ": {$score}<br>";
//}

// lab 7

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Yatzy\Leaderboard;
require __DIR__ . '/../vendor/autoload.php';


$app = AppFactory::create();
$leaderboard = new Leaderboard();


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
$app->get('/api/roll', function (Request $request, Response $response, $args) {
    $d = new Dice();
    $data = ["value" => $d->roll()];
    return jsonReply($response, $data);
});

// leaderboard api routes
$app->get('/api/leaderboard', function (Request $request, Response $response, $args) use ($leaderboard) {
    $data = ['leaderboard' => $leaderboard->getScores()];
    return jsonReply($response, $data);
});

$app->post('/api/leaderboard', function (Request $request, Response $response, $args) use ($leaderboard) {
    $parsedBody = $request->getParsedBody();
    $player = $parsedBody['player'];
    $score = $parsedBody['score'];
    $leaderboard->addScore($player, $score);
    $data = ['status' => 'success'];
    return jsonReply($response, $data);
});


function jsonReply(Response $response, $data)
{
    $payload = json_encode($data);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json');
}

$app->run();
