<?php

/** @Target("property") */
class Column extends Annotation{
	public $name;
	public $nullable=false;
	
	public function checkConstraints($target){
		if(is_null($this->name))
			throw new Exception("L'attribut name est obligatoire pour une annotation de type Column");
	}
}