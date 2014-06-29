<?php

require('./bootstrap.php');
require('vendor/autoload.php');

$app = new \Slim\Slim(array(
	'templates.path' => './views',
));

$noop = function () {};

$app->get('/list', $noop);
$app->post('/list', $noop);
$app->get('/list/:id', $noop);
$app->delete('/list/:id', $noop);

$app->get('/list/:id/todos', $noop);
$app->post('/list/:id/todos', $noop);
$app->put('/list/:id/todos/:todoId', $noop);
$app->delete('/list/:id/todos/:todoId', $noop);

$app->get('/', function() use ($app) {
	$app->render('lists.html');
});

$app->get('/l/:id', function() use ($app) {
	$app->render('todos.html');
});

$app->run();