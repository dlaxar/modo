<?php

require('./bootstrap.php');
require('vendor/autoload.php');

$app = new \Slim\Slim(array(
	'templates.path' => './views',
));

$noop = function () {};

$app->get('/list', function() use ($dm) {

	$lists = $dm->getRepository('Models\TodoList')->findAll();

	$output = array();

	foreach($lists as $list) {
		$output[] = array(
			'id' => $list->getId(),
			'name' => $list->getName(),
		);
	}

	echo json_encode($output);

});
$app->post('/list', function() use ($app, $dm) {

	$data = json_decode($app->request->getBody());

	$list = new \Models\TodoList();
	$list->setName($data->name);
	$dm->persist($list);
	$dm->flush();

	echo json_encode(array(
		'id' => $list->getId(),
		'name' => $list->getName(),
	));
});
$app->get('/list/:id', function($id) use($dm) {
	$list = $dm->find('Models\TodoList', $id);

	echo json_encode(array(
		'id' => $list->getId(),
		'name' => $list->getName(),
	));
});
$app->delete('/list/:id', function($id) use($dm) {
	$list = $dm->getReference('Models\TodoList', $id);
	$dm->remove($list);
});

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
$dm->flush();