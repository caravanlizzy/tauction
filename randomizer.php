<?php

require 'faction.php';

class Randomizer {
	public $factions;
	public $pairings;
	public $color_pool = array('red', 'green', 'gray', 'blue', 'black', 'brown', 'yellow');
	public $maps = array('Original', 'Original [2017 VP]', 'Fire & Ice, Side 1', 'Fire & Ice, Side 2', 'Loon Lakes v1.6', 'Fjords v2.1');
	public $player_count = 7;
	public $final_factions = array();
	public $final_map = '';
	public $includeExpansion = false;
	
	function __construct($factions, $pairings){
		$this->factions = $factions;
		$this->pairings = $pairings;
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
		$this->delete_factions_from_pool($new_faction);
		$this->delete_color_from_pool($new_faction->color);
	}
	
	function show_all_array_items($array){
		for($i = 0; $i < count($array); $i++){
			echo $array[$i]->name;
			echo "<br>";
		}
	}
	
	function show_array_length($array){
		echo count($array);
	}
	
	function draw_map(){
		$new_map = $this->maps[rand(0, count($this->maps) - 1)];
		$this->final_map = $new_map;
	}
	
	function delete_factions_from_pool($faction){
		for($i = count($this->factions) - 1; $i >= 0; $i--){
			if(array_key_exists($faction->name, $this->pairings)){
				if($this->factions[$i]->name == $this->pairings[$faction->name]){
					$this->factions[$i]->set_color($faction->color);
				}
			}
			if($this->factions[$i]->color == $faction->color){
				array_splice($this->factions, $i, 1);
			}
		}
	}
	
	function delete_color_from_pool($color){
		for($i = 0; $i < count($this->color_pool); $i++){
			if($this->color_pool[$i] == $color){
				array_splice($this->color_pool, $i, 1);
			}
		}
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
			echo "&nbsp";
			echo $this->final_factions[$i]->color;
			echo "<br>";
		}
	}
}
?>
