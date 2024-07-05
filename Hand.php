    <?php
    include("Effects.php");

    class Hand
    {
        private $cards = [];

        public function __construct(array $card)
        {
            $this->cards = $card;
        }



        public function displayCards()
        {
            foreach ($this->cards as $card) {
                $imageJson = json_encode(['desc' => $card->getCardImage()]);
                $descriptionJson = json_encode(['desc' => $card->getCardDesc()]);
                $nameJson = json_encode(['desc' => $card->getCardName()]);
                $attackJson = json_encode(['desc' => $card->getCardAtk()]);
                $defJson = json_encode(['desc' => $card->getCardDef()]);
                echo '<img src="' . $card->getCardImage() . '" id="cards" alt="Uploaded Image" width=160 height=240 data-card-id="' . $card->getCardId() . '" data-description="' . htmlspecialchars($descriptionJson) . '" data-name="' . htmlspecialchars($nameJson) . '"data-attack="' . htmlspecialchars($attackJson) . '"data-defense="' . htmlspecialchars($defJson) .'" data-image="'.htmlspecialchars($imageJson).'" onmouseover="showDescription(this)" onmouseout="hideDescription()" onclick="summonCard(this)">';
            }
        }

        public function displayEnemyCard()
        {
            foreach ($this->cards as $card) {
                echo '<img src="' . $card->getBackCard() . '" id="cards" alt="Uploaded Image" width=120 height=180 data-card-id="' . $card->getCardId() . '">';
            }
        }



        /*public function hasEffect(Card $card){
        $card_id = $card->getCardId();
        $fetchKeyword = fetchEffect($card_id);
    }*/
    }
    ?>
    </body>

    </html>