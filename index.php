<?php

require('./bootstrap.php');
require('vendor/autoload.php');

$app = new \Slim\Slim(array(
	'templates.path' => './views',
));

$noop = function () {};

$app->get('/list', function() use ($dm) {

	$lists = $dm->getRepository('Models\TodoList')->findAll();

	echo json_encode($lists);

});

$app->post('/list', function() use ($app, $dm) {

	$data = json_decode($app->request->getBody());

	$list = new \Models\TodoList();
	$list->setName($data->name);
	$dm->persist($list);
	$dm->flush();

	echo json_encode($list);
});
$app->get('/list/:id', function($id) use($dm) {
	$list = $dm->find('Models\TodoList', $id);

	echo json_encode($list);
});
$app->delete('/list/:id', function($id) use($dm) {
	$list = $dm->getReference('Models\TodoList', $id);
	$dm->remove($list);
});

$app->get('/list/:id/todos', function($id) use($dm) {
	$list = $dm->find('Models\TodoList', $id);

	echo json_encode($list->getTasks()->toArray());
});
$app->post('/list/:id/todos', function($id) use($app, $dm) {
	$list = $dm->find('Models\TodoList', $id);
	$data = json_decode($app->request->getBody());

	$task = new \Models\ToDo();
	$task->setName($data->name);
	$task->setDone($data->done);
	$list->addTask($task);

	$dm->flush();

	echo json_encode($task);
});
$app->put('/list/:id/todos/:todoId', function($id, $taskId) use ($app, $dm) {
	$data = json_decode($app->request->getBody());


	$dm->createQueryBuilder('Models\ToDoList')
		->update()
		->field('_id')->equals($id)
		->field('tasks._id')->equals(new MongoId($taskId))
		->field('tasks.$.done')->set($data->done)
		->getQuery()->execute();

});
$app->delete('/list/:id/todos/:todoId', function($id, $taskId) use ($dm) {
	$list = $dm->find('Models\TodoList', $id);

	$tasks = $list->getTasks();
	$remove = null;
	foreach($tasks as $key=>$task) {
		if($task->getId() == $taskId) {
			$remove = $key;
		}
	}

	$tasks->remove($remove);
});

$app->get('/', function() use ($app) {
	$app->render('lists.html');
});

$app->get('/l/:id', function() use ($app) {
	$app->render('todos.html');
});

$app->run();
$dm->flush();