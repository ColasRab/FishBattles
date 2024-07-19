import { showDescription, hideDescription } from "./Game.js";

let isSummon = false;

export default class Hand {
    constructor(cards = [], summonCallback, gameInstance) {
        this.gameInstance = gameInstance;
        this.cards = Array.isArray(cards) ? cards : [cards];
        this.handArray = [];
        this.fieldArray = Array(5).fill(null);
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
            const newCardIndex = this.handArray.length;
            this.handArray.push(newCardIndex);

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
        if (mode === 0) {
            console.log("Setting card in defense position.");
            cardEvent.position = cardEvent.position || 'defense';
        } else {
            console.log("Setting card in attack position.");
            cardEvent.position = cardEvent.position || 'attack';
        }
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
                this.fieldArray[aiSlot - 11] = cardEvent;
                this.removeCardFromHand(cardEvent, false);
            });
        } else {
            const cards = document.querySelector('.battlefield');
            document.getElementsByClassName('summon_container')[0].style.display = 'none';
            cards.onclick = (event) => this.placeCard(cardEvent, event.target.id, mode, () => {
                this.fieldArray[event.target.id] = cardEvent;
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

        card.isInDefensePosition = (mode === 0);

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
                slotElement.height = 160;
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

    revealSetCard(cardElement, cardDetails) {
        cardElement.src = cardDetails['\u0000Card\u0000image_url'];
    }

    initiateAttack() {
        this.fieldArray.forEach(card => {
            if (card !== null) {
                card.hasAttacked = false;
            }
        });

        const battlefield = document.querySelector('.battlefield');
        const enemyBattlefield = document.querySelector('.enemy_battlefield');

        battlefield.onclick = (event) => {
            const cardId = event.target.id;
            const index = parseInt(cardId.replace('summon', ''));
            const card = this.fieldArray[index];
            if (card !== null && !card.hasAttacked) {
                this.selectAttacker(card, index);
                const opponentFieldCards = this.gameInstance.enemyHand.fieldArray.filter(card => card !== null);
                if (opponentFieldCards.length === 0) {
                    this.directAttack(card, index);
                }
            }
        };

        enemyBattlefield.onclick = (event) => {
            const cardId = event.target.id;
            const index = parseInt(cardId.replace('summon', '')) - 11;
            const card = this.gameInstance.enemyHand.fieldArray[index];
            if (card !== null && this.selectedAttacker) {
                const cardElement = document.getElementById(`summon${index + 11}`);
                this.revealSetCard(cardElement, card);
                setTimeout(() => {
                    this.selectTarget(card, index);
                }, 2000); // Wait for 2 seconds to show the card
            }
        };
    }

    selectAttacker(card, index) {
        this.selectedAttacker = { card, index };
        console.log(`Selected attacker: ${card['\u0000Card\u0000name']}`);
    }

    selectTarget(card, index) {
        if (!this.selectedAttacker) {
            console.log("No attacker selected.");
            return;
        }
        const { card: attackerCard, index: attackerIndex } = this.selectedAttacker;
        console.log(`Selected target: ${card['\u0000Card\u0000name']}`);
        const damage = this.attack(this.gameInstance.enemyHand, false, attackerCard, attackerIndex, card, index);
        this.gameInstance.enemyLP -= damage;
        this.gameInstance.updateLPDisplay();
        this.selectedAttacker = null;
    }

    directAttack(attackingCard) {
        const cardAttack = attackingCard['\u0000Card\u0000atk'];
        console.log(`Direct attack with ${attackingCard['\u0000Card\u0000name']} dealing ${cardAttack} damage.`);
        this.gameInstance.enemyLP -= cardAttack;
        this.gameInstance.updateLPDisplay();
        this.selectedAttacker = null;
        attackingCard.hasAttacked = true;
    }

    attack(opponentHand, isAI, attackingCard, attackerIndex, targetCard, targetIndex) {
        const cardAttack = attackingCard['\u0000Card\u0000atk'];
        const isTargetInDefense = targetCard.position === 'defense';
        const targetPoints = isTargetInDefense ? targetCard['\u0000Card\u0000def'] : targetCard['\u0000Card\u0000atk'];
        let damage = 0;

        if (!isTargetInDefense) {
            if (cardAttack >= targetPoints) {
                opponentHand.removeCardFromField(targetCard, true);
                damage = cardAttack - targetPoints;
                opponentHand.gameInstance.enemyLP -= damage;
            } else {
                this.removeCardFromField(attackingCard);
                this.fieldArray[attackerIndex] = null;
                damage = targetPoints - cardAttack;
                if (damage > 0) {
                    opponentHand.gameInstance.userLP -= damage;
                    damage = 0;
                }
            }

        } else {
            if (cardAttack > targetPoints) {
                opponentHand.removeCardFromField(targetCard, true);
                damage = cardAttack - targetPoints;
                damage = 0;
            } else if (cardAttack < targetPoints) {
                this.removeCardFromField(attackingCard);
                this.fieldArray[attackerIndex] = null;
                damage = targetPoints - cardAttack;
                opponentHand.gameInstance.userLP -= damage;
            } else {
                console.log("Both");
                damage = 0;
            }
        }

        this.gameInstance.updateLPDisplay();
        return damage;
    }


    summonRandomCard() {
        if (this.handArray.length > 0) {
            const randomIndex = Math.floor(Math.random() * this.handArray.length);
            const cardIndex = this.handArray[randomIndex];
            const randomCard = this.cards[cardIndex];
            console.log(randomCard);
            this.summonCard(randomCard, true);
        }
    }

    enemyAttack(opponentHand, isAI) {
        const fieldCards = this.fieldArray.filter(card => card !== null);
        const opponentFieldCards = opponentHand.fieldArray.filter(card => card !== null);
        let totalDamage = 0;

        fieldCards.forEach((card, index) => {
            const cardAttack = card['\u0000Card\u0000atk'];

            if (opponentFieldCards.length > 0) {
                const targetCard = opponentFieldCards.shift();
                const isTargetInDefense = targetCard.position === 'defense';
                const targetPoints = isTargetInDefense ? targetCard['\u0000Card\u0000def'] : targetCard['\u0000Card\u0000atk'];
                let damage = 0;

                console.log(isTargetInDefense, cardAttack, targetPoints);

                if (!isTargetInDefense) {
                    if (cardAttack >= targetPoints) {
                        opponentHand.removeCardFromField(targetCard);
                        damage = cardAttack - targetPoints;
                        opponentHand.gameInstance.userLP -= damage;
                    } else {
                        this.removeCardFromField(card, true); 
                        this.fieldArray[index] = null;
                        damage = targetPoints - cardAttack;
                        if (damage > 0) {
                            opponentHand.gameInstance.enemyLP -= damage;
                            damage = 0;
                        }
                    }

                } else {
                    if (cardAttack > targetPoints) {
                        opponentHand.removeCardFromField(targetCard);
                        damage = cardAttack - targetPoints;
                        damage = 0;
                    } else if (cardAttack < targetPoints) {
                        this.removeCardFromField(card, true);
                        this.fieldArray[index] = null;
                        damage = targetPoints - cardAttack;
                        opponentHand.gameInstance.enemyLP -= damage;
                    } else {
                        console.log("Both");
                        damage = 0;
                    }
                }

                this.gameInstance.updateLPDisplay();

            } else {
                const damage = cardAttack;
                if (isAI) {
                    opponentHand.gameInstance.userLP -= damage;
                } else {
                    opponentHand.gameInstance.enemyLP -= damage;
                }
                totalDamage += damage;
                console.log(`Direct Attack! Damage: ${damage}`);
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

            console.log(cardIndex, isAICard);

            const fieldSlotId = `card_slot_${cardIndex}`;
            const fieldSlotImgId = `summon${cardIndex}`;
            const fieldSlotImg = document.getElementById(fieldSlotImgId);
            const fieldSlot = document.getElementById(fieldSlotId);


            if (fieldSlot) {
                fieldSlotImg.src = '';
                fieldSlot.innerHTML = '';
                fieldSlotImg.style.display = 'none';
            }

            if (isAICard) {
                console.log(`AI's card ${removedCard['\u0000Card\u0000name']} was removed from the field.`);
            } else {
                console.log(`Opponent's card ${removedCard['\u0000Card\u0000name']} was removed from the field.`);
            }
        }
    }
}
