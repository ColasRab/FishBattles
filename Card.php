<?php
    class Card{
        private $card_id;
        private $name;
        private $type;
        private $description;
        private $image_url;
        private $rarity;
        private $atk;
        private $def;
        private $tribute_req;
        private $back_card = 'assets/cards/BACKOFCARD.png';
        
        public function __construct($id, $name, $type, $description, $image_url, $rarity, $atk, $def)
        {
            $this->card_id = $id;
            $this->name = $name;
            $this->type = $type;
            $this->description = $description;
            $this->image_url = $image_url;
            $this->rarity = $rarity;
            $this->atk = $atk;
            $this->def = $def;
        }

        public function getCardId(){
            return $this->card_id;
        }

        public function getCardName(){
            return $this->name;
        }

        public function getCardType(){
            return $this->type;
        }

        public function getCardDesc(){
            return $this->description;
        }

        public function getCardImage(){
            return $this->image_url;
        }

        public function getCardRarity(){
            return $this->rarity;
        }

        public function getCardAtk(){
            return $this->atk;
        }

        public function getCardDef(){
            return $this->def;
        }

        public function getTributeReq(){
            return $this->tribute_req;
        }

        public function getCardEffect(){
             
        }

        public function getBackCard(){
            return $this->back_card;
        }
    }
?>