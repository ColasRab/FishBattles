<?php
include("Card.php");

class Deck
{
    public $cards = [];

    public function __construct()
    {
    }

    public function addDeck(array $cardData)
    {
        foreach ($cardData as $cardEntry) {
            $this->addCard(
                $cardEntry["id"],
                $cardEntry["name"],
                $cardEntry["type"],
                $cardEntry["description"],
                $cardEntry["image_url"],
                $cardEntry["rarity"],
                $cardEntry["atk"],
                $cardEntry["def"],
                $cardEntry["tribute_req"]
            );
        }
    }

    public function addCard($cardId, $cardName, $cardType, $cardDescription, $image_url, $rarity, $cardAtk, $cardDef, $tribute_req)
    {
        $this->cards[] = new Card($cardId, $cardName, $cardType, $cardDescription, $image_url, $rarity, $cardAtk, $cardDef, $tribute_req);
    }

    public function shuffle()
    {
        shuffle($this->cards);
    }

    public function draw()
    {
        return array_pop($this->cards);
    }

    public function fetchActiveCard($cardName)
    {
        foreach ($this->cards as $card) {
            if ($card->getCardName() == $cardName) {
                return $card;
            }
        }
    }

    public function getCardsJson()
    {
        $originalCardsData = $this->cards;
        $serializedCardsData = [];

        foreach ($originalCardsData as $key => $value) {
            $cardArray = (array) $value;

            $serializedCardsData[$key] = $cardArray;
        }

        return json_encode($serializedCardsData);
    }
}
