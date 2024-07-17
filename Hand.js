import { showDescription, hideDescription } from "./Game.js";

let isSummon = false;

export default class Hand {
    constructor(cards = [], summonCallback) {
        this.cards = Array.isArray(cards) ? cards : [cards];
        this.handArray = [];
        this.fieldArray = Array(5).fill(null); // Assuming there are 5 slots for field cards
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

    drawInitialCards() {
        this.handArray = this.cards.slice(0, 5).map((_, index) => index);
    }

    drawCard(isUser = true) {
        console.log("Drawing a card.");
        this.hasSummonedDuringStandby = false;
        if (this.cards.length > this.handArray.length) {
            const newCardIndex = this.handArray.length; // The next card to draw
            this.handArray.push(newCardIndex); // Add the index of the drawn card to handArray
            this.updateHandDisplay(isUser);
        } else {
            alert("No more cards to draw. Opponent wins!");
            this.gameFlag = false;
        }
    }

    displayCards() {
        const cardContainer = document.querySelector('.user_hand');
        cardContainer.innerHTML = ''; // Clear previous cards

        this.handArray.forEach(index => {
            const cardDetails = this.cards[index];
            if (!cardDetails) {
                console.error(`No card details found for index ${index}`);
                return;
            }

            const imgElement = document.createElement('img');
            imgElement.src = cardDetails["\u0000Card\u0000image_url"];
            imgElement.id = `card-${cardDetails['\u0000Card\u0000card_id']}`;
            imgElement.alt = "Card Image";
            imgElement.width = 120;
            imgElement.height = 180;
            imgElement.dataset.cardId = cardDetails['\u0000Card\u0000card_id'].toString();
            imgElement.dataset.description = JSON.stringify({ desc: cardDetails['\u0000Card\u0000description'] });
            imgElement.dataset.name = JSON.stringify({ desc: cardDetails['\u0000Card\u0000name'] });
            imgElement.dataset.attack = JSON.stringify({ desc: cardDetails['\u0000Card\u0000atk'] });
            imgElement.dataset.defense = JSON.stringify({ desc: cardDetails['\u0000Card\u0000def'] });
            imgElement.dataset.image = JSON.stringify({ desc: cardDetails['\u0000Card\u0000image_url'] });
            imgElement.onmouseover = () => showDescription(cardDetails);
            imgElement.onmouseleave = () => hideDescription();
            imgElement.onclick = () => this.summonCard(cardDetails);
            cardContainer.appendChild(imgElement);
        });
    }

    displayEnemyCard() {
        const enemyCardContainer = document.querySelector('.enemy_hand');
        enemyCardContainer.innerHTML = '';

        this.handArray.forEach(index => {
            const cardDetails = this.cards[index + 1];
            if (!cardDetails) {
                console.error(`No card details found for index ${index}`);
                return;
            }

            const imgElement = document.createElement('img');
            imgElement.src = cardDetails["\u0000Card\u0000back_card"];
            imgElement.id = `card-${cardDetails['\u0000Card\u0000card_id']}`;
            imgElement.alt = "Card Image";
            imgElement.width = 120;
            imgElement.height = 180;
            imgElement.dataset.cardId = cardDetails['\u0000Card\u0000card_id'].toString();
            imgElement.dataset.description = JSON.stringify({ desc: cardDetails['\u0000Card\u0000description'] });
            imgElement.dataset.name = JSON.stringify({ desc: cardDetails['\u0000Card\u0000name'] });
            imgElement.dataset.attack = JSON.stringify({ desc: cardDetails['\u0000Card\u0000atk'] });
            imgElement.dataset.defense = JSON.stringify({ desc: cardDetails['\u0000Card\u0000def'] });
            imgElement.dataset.image = JSON.stringify({ desc: cardDetails['\u0000Card\u0000image_url'] });
            enemyCardContainer.appendChild(imgElement);
        });
    }

    getAvailableCardForSummon() {
        return this.cards.length > 0 ? this.cards[0] : null;
    }

    updateHandDisplay(isUser = true) {
        if (isUser) {
            this.displayCards();
        } else {
            this.displayEnemyCard();
        }
    }

    summonCard(card, isAI = false) {
        const name = card['\u0000Card\u0000name'];
        document.getElementById('summonCard').innerText = name;

        if (isAI) {
            // Directly summon the card without user prompt
            this.summonCondition(card, 1, true);
        } else {
            document.getElementsByClassName('summon_container')[0].style.display = 'flex';
            console.log(card);

            const button = document.querySelector('#summonButton');
            button.onclick = () => this.summonCondition(card, 1, isAI);

            const setButton = document.getElementById('setButton');
            setButton.onclick = () => this.summonCondition(card, 0, isAI);

            const cancelButton = document.getElementById('cancelButton');
            cancelButton.onclick = () => this.hideSummonContainer();
        }
    }


    summonCondition(cardEvent, mode, isAI = false) {
        console.log(this.hasSummonedDuringStandby);
        if (this.hasSummonedDuringStandby) {
            document.getElementById('summonCard').innerText = "Cannot summon.";
            return;
        }

        if (isAI) {
            isSummon = true;
            console.log("AI is summoning a card.");
            const aiSlot = 11 + Math.floor(Math.random() * 5);
            this.placeCard(cardEvent, aiSlot, mode, () => {
                this.fieldArray[aiSlot - 11] = cardEvent; // Update fieldArray for AI
                this.removeCardFromHand(cardEvent, false);
            });
        } else {
            const cards = document.querySelector('.battlefield');
            document.getElementsByClassName('summon_container')[0].style.display = 'none';
            cards.onclick = (event) => this.placeCard(cardEvent, event.target.id, mode, () => {
                this.fieldArray[event.target.id] = cardEvent; // Update fieldArray for player
                this.removeCardFromHand(cardEvent, true);
            });
        }

        this.hasSummonedDuringStandby = true;
        isSummon = true;

        if (this.summonCallback && !isAI) {
            this.summonCallback();
        }
    }

    hideSummonContainer() {
        isSummon = false;
        document.getElementsByClassName('summon_container')[0].style.display = 'none';
    }

    placeCard(card, divId, mode, onSuccessCallback) {
        if (!isSummon) {
            return;
        }
        console.log(`Placing card in slot ${divId}`);
        const atk = card['\u0000Card\u0000atk'];
        const def = card['\u0000Card\u0000def'];
        const img = card['\u0000Card\u0000image_url'];
        const back_img = card['\u0000Card\u0000back_card'];
        isSummon = false;

        this.displayCardDetails(`summon${divId}`, `card_slot_${divId}`, atk, def, img, back_img, mode);
        if (mode === 1) {
            this.cardAnimation(img);
        }

        if (typeof onSuccessCallback === 'function') {
            onSuccessCallback();
        }
    }

    displayCardDetails(slotId, slot, atk, def, img, back_img, mode) {
        console.log(slotId, slot);
        const slotElement = document.getElementById(slotId);
        console.log(slotElement);
        const stats = document.getElementById(slot);
        switch (mode) {
            case 0:
                slotElement.style.display = 'block';
                slotElement.src = back_img;
                slotElement.width = 90;
                slotElement.height = 120;
                slotElement.style.transform = 'rotate(90deg)';
                break;
            case 1:
                slotElement.style.display = 'block';
                slotElement.src = img;
                slotElement.width = 90;
                slotElement.height = 120;
                slotElement.style.transform = 'rotate(0deg)';
                stats.innerHTML = `${atk}<br/><img src='assets/SWORD.png' width='15px' height='15px' style='vertical-align: middle;'> <br/>${def}<img src='assets/SHIELD.png' width='15px' height='15px' style='vertical-align: middle;'>`;
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

    initiateAttack() {
        this.fieldArray.forEach(card => {
            if (card) {
                console.log(`${card['\u0000Card\u0000name']} is attacking.`);
            }
        });
    }

    summonRandomCard() {
        if (this.handArray.length > 0) {
            const randomIndex = Math.floor(Math.random() * this.handArray.length);
            const cardIndex = this.handArray[randomIndex];
            const randomCard = this.cards[cardIndex]; // Access the card details using the index
            console.log(randomCard);
            this.summonCard(randomCard, true);
        }
    }


    attack(opponentHand) {
        const aiFieldCards = this.fieldArray.filter(card => card !== null);
        const opponentFieldCards = opponentHand.fieldArray.filter(card => card !== null);

        console.log(aiFieldCards);
        console.log(opponentFieldCards);

        aiFieldCards.forEach((aiCard, aiIndex) => {
            console.log(`AI's ${aiCard['\u0000Card\u0000name']} is attacking`);
            if (opponentFieldCards.length > 0) {
                const targetCard = opponentFieldCards.shift(); // Get the first card and remove it from the array
                console.log(`AI's ${aiCard['\u0000Card\u0000name']} attacks ${targetCard['\u0000Card\u0000name']}`);

                const aiCardAttack = aiCard['\u0000Card\u0000atk'];
                const targetCardAttack = targetCard['\u0000Card\u0000atk'];

                if (aiCardAttack >= targetCardAttack) {
                    console.log(`AI's ${aiCard['\u0000Card\u0000name']} destroys ${targetCard['\u0000Card\u0000name']}`);
                    opponentHand.removeCardFromField(targetCard);
                } else {
                    console.log(`${targetCard['\u0000Card\u0000name']} destroys AI's ${aiCard['\u0000Card\u0000name']}`);
                    this.removeCardFromField(aiCard, true);
                    this.fieldArray[aiIndex] = null;
                }
            } else {
                console.log(`AI's ${aiCard['\u0000Card\u0000name']} has no cards to attack.`);
            }
        });
    }

    removeCardFromHand(cardEvent, isUser) {
        const cardIndex = this.cards.findIndex(card => card && card['\u0000Card\u0000card_id'] === cardEvent['\u0000Card\u0000card_id']);
        if (cardIndex !== -1) {
            this.cards.splice(cardIndex, 1);
            this.handArray = this.handArray.filter(index => index !== cardIndex);
            this.updateHandDisplay(isUser);
        }
    }

    removeCardFromField(cardEvent, isAICard = false) {
        console.log(`Removing card from field: ${cardEvent['\u0000Card\u0000name']}`);

        let cardIndex = this.fieldArray.findIndex(card => card && card['\u0000Card\u0000card_id'] === cardEvent['\u0000Card\u0000card_id']);

        if (cardIndex !== -1) {
            console.log(`Card found at index ${cardIndex}`);
            const removedCard = this.fieldArray.splice(cardIndex, 1)[0];

            console.log(`Removed card: ${removedCard['\u0000Card\u0000name']}`);

            if (isAICard) {
                cardIndex += 11;
            }

            const fieldSlotId = `card_slot_${cardIndex}`;
            const fieldSlotImgId = `summon${cardIndex}`;
            const fieldSlotImg = document.getElementById(fieldSlotImgId);
            const fieldSlot = document.getElementById(fieldSlotId);


            if (fieldSlot) {
                fieldSlotImg.src = '';
                fieldSlot.innerHTML = '';
                fieldSlotImg.style.display = 'none';
            }

            // Specify whether the removed card belongs to the AI
            if (isAICard) {
                console.log(`AI's card ${removedCard['\u0000Card\u0000name']} was removed from the field.`);
            } else {
                console.log(`Opponent's card ${removedCard['\u0000Card\u0000name']} was removed from the field.`);
            }
        }
    }


}
