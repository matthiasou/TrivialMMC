<?php

class JoinColumn extends Column{
	public $className;
	public $name;
	public $referencedColumnName;
	public function checkConstraints($target){
		parent::checkConstraints($target);
		if(is_null($this->className)&&is_null($this->name))
			throw new Exception("L'un des attributs className ou name est obligatoire pour une annotation de type JoinColumn");
	}
}