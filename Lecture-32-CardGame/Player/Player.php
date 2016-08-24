<?php

namespace Player;

class Player
{
	const MAX_HEALTH = 100;
	
	protected $health;
	
	protected $name;
	
	protected $shield;
	
	private $deck = [];
	
	public function __construct($name) 
	{
		$this->name = $name;
		$this->health = self::MAX_HEALTH;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getDeck()
	{
		return $this->deck;
	}
	public function getShield()
	{
		return $this->shield;
	}
	
	public function setDeck($value)
	{
		$this->deck = $value;
	}
	
	public function getHealth()
	{
		return $this->health;
	}
	
	public function setHealth($value)
	{
		$this->health = $value;
	}
	
	public function takeDamage($value) 
	{	if($value > $this->shield){
			$value += $this->shield;
			$this->shield = 0;
			if ($this->health >= $value) {
				$this->health -= $value;
			} else {
				$this->health = 0;
			}
			
		}else $this->shield + $value;
	}
	
	public function increaseHealth($value)
	{
		$total = $this->health + $value;
		// $this->health = $total > self::MAX_HEALTH ? self::MAX_HEALTH : $otal
		$this->health = min(self::MAX_HEALTH, $total);
	}
	
	public function placeShield($value)
	{
		$this->shield += $value;
	}
	
	public function showPlayer()
	{
		return $this->name." healt : ".$this->health."  shield: ".$this->shield.PHP_EOL;
	}
}