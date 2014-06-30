<?php
/**
 * Created by PhpStorm.
 * User: dlaxar
 * Date: 30/06/14
 * Time: 14:14
 */

namespace Models;


class ToDo {

	protected $id;

	protected $name;

	protected $done;

	/**
	 * @param mixed $done
	 */
	public function setDone($done) {
		$this->done = $done;
	}

	/**
	 * @return mixed
	 */
	public function getDone() {
		return $this->done;
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



} 