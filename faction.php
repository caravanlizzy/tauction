<?php


class Faction {
	public $name;
	public $color;
	
	function __construct($name, $color){
		$this->name = $name;
		$this->color = $color;
	}

	
	function set_color($color){
		$this->color = $color;
	}
	
	function get_color(){
		return $this->color;
	}
}

?>
