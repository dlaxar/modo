<?php
/**
 * Created by PhpStorm.
 * User: dlaxar
 * Date: 30/06/14
 * Time: 14:12
 */

namespace Models;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class TodoList
 * @package Models
 *
 * @ODM\Document
 */
class TodoList  {

	/**
	 * @var
	 * @ODM\Id(strategy="INCREMENT")
	 */
	protected $id;

	/**
	 * @var
	 * @ODM\String
	 */
	protected $name;

	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection
	 * @ODM\EmbedMany(targetDocument="ToDo")
	 */
	protected $tasks;

	function __construct() {
		$this->tasks = new ArrayCollection();
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $tasks
	 */
	public function setTasks($tasks) {
		$this->tasks = $tasks;
	}

	/**
	 * @return mixed
	 */
	public function getTasks() {
		return $this->tasks;
	}

	public function addTask($task) {
		$this->tasks->add($task);
	}


} 