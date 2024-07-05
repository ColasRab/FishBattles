<?php
include("Card.php");

class Deck
{
    private $cards = [];

    public function __construct()
    {
        
    }

    public function addDeck(array $cardData){
        foreach ($cardData as $cardEntry) {
            $this->addCard(
                $cardEntry["id"],
                $cardEntry["name"],
                $cardEntry["type"],
                $cardEntry["description"],
                $cardEntry["image_url"],
                $cardEntry["rarity"],
                $cardEntry["atk"],
                $cardEntry["def"]
            );
        }
    }

    public function addCard($cardId, $cardName, $cardType, $cardDescription, $image_url, $rarity, $cardAtk, $cardDef)
    {
        $this->cards[] = new Card($cardId, $cardName, $cardType, $cardDescription, $image_url, $rarity, $cardAtk, $cardDef);
    }

    public function shuffle()
    {
        shuffle($this->cards);
    }

    public function draw()
    {
        return array_pop($this->cards);
    }

    public function fetchActiveCard($cardName){
        foreach ($this->cards as $card){
            if ($card->getCardName() == $cardName){
                return $card;
            }
        }
    }
}
