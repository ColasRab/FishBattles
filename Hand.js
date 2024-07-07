import { showDescription, hideDescription } from "./Game.js";
let isSummon = false;
export default class Hand {
    constructor(cards = [], summonCallback) {
        this.cards = Array.isArray(cards) ? cards : [cards];
        this.handArray = [];
        this.fieldArray = [];
        this.shuffleCards();
        this.summonCallback = summonCallback;
    }

    shuffleCards() {
        for (let i = this.cards.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [this.cards[i], this.cards[j]] = [this.cards[j], this.cards[i]];
        }
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
            imgElement.onmouseover = () => showDescription(cardDetails);
            imgElement.onmouseleave = () => hideDescription();
            imgElement.onclick = () => this.summonCard(cardDetails);
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

    summonCard(card) {
        const name = card['\u0000Card\u0000name'];
        document.getElementById('summonCard').innerText = name;
        document.getElementsByClassName('summon_container')[0].style.display = 'flex';
        console.log(card);

        const button = document.querySelector('#summonButton');
        button.onclick = () => this.summonCondition(card, 1)

        const setButton = document.getElementById('setButton');
        setButton.onclick = () => this.summonCondition(card, 0)

        const cancelButton = document.getElementById('cancelButton');
        cancelButton.onclick = () => this.hideSummonContainer();
    }

    summonCondition(cardEvent, mode) {
        if (this.hasSummonedDuringStandby) {
            document.getElementById('summonCard').innerText = "Cannot summon.";
            return;
        }
        const cards = document.querySelector('.battlefield');
        console.log("check");
        document.getElementsByClassName('summon_container')[0].style.display = 'none';
        cards.onclick = (event) => this.placeCard(cardEvent, event.target.id, mode, () => this.removeCardFromHand(cardEvent));

        this.hasSummonedDuringStandby = true;
        isSummon = true;

        if (this.summonCallback) {
            this.summonCallback();
        }
    }
    hideSummonContainer() {
        isSummon = false;
        document.getElementsByClassName('summon_container')[0].style.display = 'none';
    }

    placeCard(card, divId, mode, onSuccessCallback) {
        console.log(card);

        if (isSummon) {
            const atk = card['\u0000Card\u0000atk'];
            const def = card['\u0000Card\u0000def'];
            const img = card['\u0000Card\u0000image_url'];
            const back_img = card['\u0000Card\u0000back_card'];
            isSummon = false;

            console.log(divId);

            this.displayCardDetails(`summon${divId}`, `card_slot_${divId}`, atk, def, img, back_img, mode);
            if(mode == 1){
                this.cardAnimation(img);
            }

            if (typeof onSuccessCallback === 'function') {
                onSuccessCallback();
            }
        }

    }

    displayCardDetails(slotId, slot, atk, def, img, back_img, mode) {
        const slotElement = document.getElementById(slotId);
        const stats = document.getElementById(slot);
        switch (mode) {
            case 0:
                slotElement.style.display = 'block';
                slotElement.src = back_img;
                slotElement.width = 120;
                slotElement.height = 180;
                slotElement.style.transform = 'rotate(90deg)';  // Rotate the image 90 degrees
                break;
            case 1:
                slotElement.style.display = 'block';
                slotElement.src = img;
                slotElement.width = 120;
                slotElement.height = 180;
                slotElement.style.transform = 'rotate(0deg)';  // Reset rotation
                stats.innerHTML = `${atk}<br/><img src='assets/SWORD.png' width='35px' height='35px' style='vertical-align: middle;'> <br/>${def}<img src='assets/SHIELD.png' width='35px' height='35px' style='vertical-align: middle;'>`;
                break;
        }
    }


    cardAnimation(img) {
        const animationDiv = document.querySelector('.summoned_card_animation');
        animationDiv.style.backgroundImage = `url(${img})`;
        animationDiv.classList.add('animate');

        setTimeout(() => {
            animationDiv.classList.remove('animate');
            animationDiv.style.backgroundImage = '';
        }, 2000);
    }
}
