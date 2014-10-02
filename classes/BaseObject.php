<?php

class BaseObject{
	/**
	 * @Id
	 */
	protected $id;
	
	public function __construct($id=null){
		if(isset($id))
			$this->id=$id;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function __toString(){
		return $this->toString();
	}
	public function toString(){
		return get_class($this);
	}
}