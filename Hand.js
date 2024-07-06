let isSummon = false;
export default class Hand {
    constructor(cards = []) {
        this.cards = Array.isArray(cards) ? cards : [cards];
        this.handArray = []; // Initialize the hand array
        this.shuffleCards();
    }

    shuffleCards() {
        for (let i = this.cards.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [this.cards[i], this.cards[j]] = [this.cards[j], this.cards[i]];
        }
        // Populate the hand array with the first 5 cards
        this.handArray = this.cards.slice(0, 5).map((_, index) => index);
    }

    displayCards() {
        this.handArray.forEach(index => {
            const cardDetails = this.cards[index];
            if (!cardDetails) {
                console.error(`No card details found for index ${index}`);
                return;
            }
            const imageSrc = cardDetails["\u0000Card\u0000image_url"];
            const backImageSrc = cardDetails["\u0000Card\u0000back_card"];
            const description = cardDetails['\u0000Card\u0000description'];
            const name = cardDetails['\u0000Card\u0000name'];
            const attack = cardDetails['\u0000Card\u0000atk'];
            const defense = cardDetails['\u0000Card\u0000def'];
            const cardId = cardDetails['\u0000Card\u0000card_id'];

            const imgElement = document.createElement('img');
            imgElement.src = imageSrc;
            imgElement.id = `card-${cardId}`;
            imgElement.alt = "Uploaded Image";
            imgElement.width = 160;
            imgElement.height = 240;
            imgElement.dataset.cardId = cardId.toString();
            imgElement.dataset.description = JSON.stringify({ desc: description });
            imgElement.dataset.name = JSON.stringify({ desc: name });
            imgElement.dataset.attack = JSON.stringify({ desc: attack });
            imgElement.dataset.defense = JSON.stringify({ desc: defense });
            imgElement.dataset.image = JSON.stringify({ desc: imageSrc });
            imgElement.onmouseover = () => this.showDescription(cardDetails);
            imgElement.onmouseleave = () => this.hideDescription();
            imgElement.addEventListener('click', function () { this.summonCard(cardDetails); }.bind(this));
            document.querySelector('.user_hand').appendChild(imgElement);
        });
    }




    displayEnemyCard() {
        this.handArray.forEach(index => {
            const cardDetails = this.cards[index + 1]; // Adjusted to work with sliced array
            if (!cardDetails) {
                console.error(`No card details found for index ${index}`);
                return;
            }

            const imageSrc = cardDetails["\u0000Card\u0000image_url"];
            const backImageSrc = cardDetails["\u0000Card\u0000back_card"];
            const description = cardDetails['\u0000Card\u0000description'];
            const name = cardDetails['\u0000Card\u0000name'];
            const attack = cardDetails['\u0000Card\u0000atk'];
            const defense = cardDetails['\u0000Card\u0000def'];
            const cardId = cardDetails['\u0000Card\u0000card_id'];

            const imgElement = document.createElement('img');
            imgElement.src = backImageSrc;
            imgElement.id = `card-${cardId}`;
            imgElement.alt = "Uploaded Image";
            imgElement.width = 120;
            imgElement.height = 180;
            imgElement.dataset.cardId = cardId.toString();
            imgElement.dataset.description = JSON.stringify({ desc: description });
            imgElement.dataset.name = JSON.stringify({ desc: name });
            imgElement.dataset.attack = JSON.stringify({ desc: attack });
            imgElement.dataset.defense = JSON.stringify({ desc: defense });
            imgElement.dataset.image = JSON.stringify({ desc: imageSrc });
            document.querySelector('.enemy_hand').appendChild(imgElement);
        });
    }

    removeCardFromHand(cardEvent) {
        const cardIndex = this.cards.findIndex(card => card['\u0000Card\u0000card_id'] === cardEvent['\u0000Card\u0000card_id']);
        if (cardIndex !== -1) {
            this.cards.splice(cardIndex, 1);
            this.handArray = this.handArray.filter(index => index !== cardIndex); // Update the hand array
            this.updateHandDisplay();
        }
    }

    updateHandDisplay() {
        const cardContainer = document.querySelector('.user_hand');
        while (cardContainer.firstChild) {
            cardContainer.removeChild(cardContainer.firstChild);
        }
        this.displayCards();
    }


    displaySingleCard(card, container, index) {
        // Your existing logic to display a single card goes here
        // For example:
        const imgElement = document.createElement('img');
        imgElement.src = card['\u0000Card\u0000image_url'];
        imgElement.id = `card-${card['\u0000Card\u0000card_id']}`;
        imgElement.alt = "Uploaded Image";
        imgElement.width = 160;
        imgElement.height = 240;
        imgElement.dataset.cardId = card['\u0000Card\u0000card_id'].toString();
        // Add event listeners as needed
        container.appendChild(imgElement);
    }

    showDescription(card) {
        const imageSrc = card['\u0000Card\u0000image_url'];
        console.log(card);
        const backImageSrc = card['\u0000Card\u0000back_card'];
        const description = card['\u0000Card\u0000description'];
        const name = card['\u0000Card\u0000name'];
        const attack = card['\u0000Card\u0000atk'];
        const defense = card['\u0000Card\u0000def'];
        const cardId = card['\u0000Card\u0000card_id'];
        document.getElementById('description').innerText = description;

        document.getElementById('cardImage').src = imageSrc;

        document.getElementById('cardName').innerText = name;

        document.getElementById('atkCard').innerHTML = "<img src='assets/SWORD.png' width='30px' height='30px' style='vertical-align: middle;'> " + attack;

        document.getElementById('defCard').innerHTML = "<img src='assets/SHIELD.png' width='30px' height='30px' style='vertical-align: middle;'> " + defense;


        document.getElementsByClassName('description_container')[0].style.display = 'flex';
    }


    hideDescription() {
        document.getElementsByClassName('description_container')[0].style.display = 'none';
    }

    summonCard(card) {
        console.log(card);
        const name = card['\u0000Card\u0000name'];
        document.getElementById('summonCard').innerText = name;
        document.getElementsByClassName('summon_container')[0].style.display = 'flex';

        document.getElementById('summonButton').addEventListener('click', () => { this.summonCondition(card) });
        document.getElementById('setButton').addEventListener('click', () => this.hideSummonContainer());
        document.getElementById('cancelButton').addEventListener('click', () => this.hideSummonContainer());
    }



    hideSummonContainer() {
        isSummon = false;
        document.getElementsByClassName('summon_container')[0].style.display = 'none';
    }

    summonCondition(cardEvent) {
        console.log(cardEvent);

        const clickedFishCard = cardEvent.target; // Get the clicked fish card element
        console.log(clickedFishCard);
         const targetDataId = clickedFishCard.id; 
        const cards = document.querySelectorAll('.card');

        // Assuming you want to target cards with a specific data-id or id

        cards.forEach((card) => {

            // Now, reattach the event listeners programmatically
            
            if (card.id === targetDataId) {
                card.addEventListener('click', () => this.placeCard(cardEvent, card.id, () => this.removeCardFromHand(cardEvent)));
                card.onmouseover = () => this.showDescription(cardEvent);
                card.onmouseleave = () => this.hideDescription();
            }
        });

        // Hide the summon container
        document.getElementsByClassName('summon_container')[0].style.display = 'none';

        // Set the summon flag
        isSummon = true;
    }


    cardAnimation() {

    }

    placeCard(card, divId, onSuccessCallback) {
        console.log("i am called");
        if (isSummon) {
            const atk = card['\u0000Card\u0000atk'];
            const def = card['\u0000Card\u0000def'];
            const img = card['\u0000Card\u0000image_url'];
            isSummon = false;

            try {
                switch (divId) {
                    case '1':
                        this.displayCardDetails('summon1', 'card_slot_1', atk, def, img);
                        break;
                    case '2':
                        this.displayCardDetails('summon2', 'card_slot_2', atk, def, img);
                        break;
                    case '3':
                        this.displayCardDetails('summon3', 'card_slot_3', atk, def, img);
                        break;
                    case '4':
                        this.displayCardDetails('summon4', 'card_slot_4', atk, def, img);
                        break;
                    case '5':
                        this.displayCardDetails('summon5', 'card_slot_5', atk, def, img);
                        break;
                    case '6':
                        this.displayCardDetails('summon6', 'card_slot_6', atk, def, img);
                        break;
                    case '7':
                        this.displayCardDetails('summon7', 'card_slot_7', tk, def, img);
                        break;
                    case '8':
                        this.displayCardDetails('summon8', 'card_slot_8', atk, def, img);
                        break;
                    case '9':
                        this.displayCardDetails('summon9', 'card_slot_9', atk, def, img);
                        break;
                    case '10':
                        this.displayCardDetails('summon10', 'card_slot_10', atk, def, img);
                        break;
                    default:
                        console.log("Invalid divId");
                        break;
                }
            } catch (error) {
                console.error(error);
            }
            if (typeof onSuccessCallback === 'function') {
                onSuccessCallback();
            }

        }
    }

    displayCardDetails(slotId, slot, atk, def, img) {
        const slotElement = document.getElementById(slotId);
        slotElement.style.display = 'block';
        slotElement.src = img;
        const stats = document.getElementById(slot);
        stats.innerHTML = `${atk}<br/><img src='assets/SWORD.png' width='35px' height='35px' style='vertical-align: middle;'> <br/>${def}<img src='assets/SHIELD.png' width='35px' height='35px' style='vertical-align: middle;'>`;

    }
}
