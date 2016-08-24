<?php
require_once 'readline.php';
use Cards\Card;
use Cards\DamageCard;
use Cards\ShieldCard;
use Player\Player;
use Cards\HealthCard;



require_once 'autoload.php';


$dc = new DamageCard(100, 'ST');
$hc =new HealthCard(10, "H");
$sc =new ShieldCard(10,"S");

$player1 = new Player("megi");
$player2= new Player("qna");


$deck = makeDeck();
makeDeckToPlayers($deck, $player1 ,$player2);

$count = 0;
while(true){
	// first player turn
	echo $player1->getName()."'s on turn".PHP_EOL;
	echo "your cards".PHP_EOL;
	echo showDeck($player1).PHP_EOL;
	echo "your parameters".$player1->showPlayer();
	$choice = pickCard();
	doMove($choice, $player1, $player2, $dc, $hc, $sc);
	changeDeck($player1, $choice);
	echo $player2->showPlayer().PHP_EOL;
	if($player1->getHealth() <= 0){
		break;
	}
	
	//second player turn
	echo $player2->getName()."'s on turn".PHP_EOL;
	echo "your cards".PHP_EOL;
	echo showDeck($player2).PHP_EOL;
	echo "your parameters ->".$player2->showPlayer();
	$choice = pickCard();
	doMove($choice, $player2, $player1, $dc, $hc, $sc);
	changeDeck($player2, $choice);
	echo $player1->showPlayer().PHP_EOL;
	if($player2->getHealth() <= 0){
		break;
	}
	$count++;
	if($count == 10){
		break;
	}
}
if($player1->getHealth() > $player2->getHealth()){
	echo $player1->getName()." WIN";
}else echo $player2->getName()." WIN";

function pickCard(){	
	$choice = "";
	while(true){
		echo "Pick card".PHP_EOL;
		$choice = readline();
		if($choice == "D"){
			return "D";
		}else if($choice == "H"){
			return "H";
		}else if($choice == "S"){
			return "S";
		}
	}
}

function changeDeck(Player $player,$remove){
	$deck = $player->getDeck();
	$index = array_search($remove, $deck);
	unset($deck[$index]);
	$player->setDeck($deck);
}

function showDeck(Player $player){
	$deck = $player->getDeck();
	return implode(" ", $deck);
}


function doMove($cardType, Player $player1,Player $player2, DamageCard $dc ,HealthCard $hc, ShieldCard $sc)
{
	
	switch ($cardType){
		case 'H': $hc->applyToPlayer($player1);break;
		case 'D':$dc->applyToPlayer($player2);break;
		case 'S':$sc->applyToPlayer($player1);break;
	}
}

function makeDeckToPlayers($deck, Player $player1,Player $player2){
	$player1Deck = [];
	$player2Deck = [];
	for($i = 0 ; $i < 20 ; $i++){
		if($i % 2 == 0){
			$player2Deck[] = $deck[$i];
		}else $player1Deck[] = $deck[$i];
	}
	$player1->setDeck($player1Deck);
	$player2->setDeck($player2Deck);
}

function makeDeck()
{
	$deck;
	$options = ["D","H","S"];
	$rand;
	for ($i = 0 ; $i < 100 ; $i++){
		$rand = rand(0,2);
		$deck[] = $options[$rand];
	}
	return $deck;
}