<?php

require 'faction.php';

class Randomizer {
	public $factions;
	public $color_pool = array('red', 'green', 'gray', 'blue', 'black', 'brown', 'yellow');
	public $maps = array('Original', 'Original [2017 VP]', 'Fire & Ice, Side 1', 'Fire & Ice, Side 2', 'Loon Lakes v1.6', 'Fjords v2.1');
	public $player_count = 3;
	public $final_factions = array();
	public $final_map = '';
	public $includeExpansion = false;
	
	function __construct($factions){
		$this->factions = $factions;
	}
	
	function draw_faction(){
		$new_faction = $this->factions[rand(0, count($this->factions) - 1)];
		if($new_faction->color === 'variable'){
			$this->set_variable_color($new_faction);		
		}
		return $new_faction;
	}
	
	function set_variable_color($faction){
		$new_color = $this->color_pool[rand(1, count($this->color_pool))];
		$faction->set_color($new_color);
	}
	
	function find_valid_faction(){
		$new_faction = $this->draw_faction();
		while($this->is_color_taken($new_faction->color)){
			$new_faction = $this->draw_faction();
		}
		array_push($this->final_factions, $new_faction);
		$this->delete_item_by_value($this->factions, $new_faction);
		$this->delete_item_by_value($color_pool, $new_faction->color);	
	}
	
	function draw_map(){
		$new_map = $this->maps[rand(0, count($this->maps) - 1)];
		$this->final_map = $new_map;
	}
	
	
	
	function delete_item_by_value($array1, $value){
		$delete_item_index = array_search($string_value, $array);
		$array1 = array_splice($array1, $delete_item_index, 1);
	}
	
	function is_color_taken($color){
		for($i = 0; $i < count($this->color_pool); $i++){
			if($color === $this->color_pool[$i]){	
				return false;
			}
		}
		return true;
	}
	
	function run(){
		for($i = 0; $i < $this->player_count; $i++){
			$this->find_valid_faction();
		}
		$this->draw_map();
	}
	
	function display_results(){
		echo "$this->final_map <br>";
		for($i = 0; $i < $this->player_count; $i++){
			echo $this->final_factions[$i]->name ;
			echo $this->final_factions[$i]->color;
			echo "<br>";
		}
	}
}
?>
