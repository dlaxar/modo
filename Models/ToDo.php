<?php
/**
 * Created by PhpStorm.
 * User: dlaxar
 * Date: 30/06/14
 * Time: 14:14
 */

namespace Models;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;


/**
 * Class ToDo
 * @package Models
 * @ODM\EmbeddedDocument
 */
class ToDo implements \JsonSerializable {

	/**
	 * @ODM\Id
	 */
	protected $id;

	/**
	 * @ODM\String
	 */
	protected $name;

	/**
	 * @ODM\Boolean
	 */
	protected $done = false;

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

	/**
	 * (PHP 5 &gt;= 5.4.0)<br/>
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 */
	public function jsonSerialize() {
		return array(
			'id' => $this->getId(),
			'name' => $this->getName(),
			'done' => $this->getDone()
		);
	}


} 