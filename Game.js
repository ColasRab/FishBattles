import Hand from './Hand.js';

let isSummon = false;

export default class Game {
    constructor(user, enemy) {
        this.hasSummonedDuringStandby = false;
        this.userHand = new Hand(user, () => {
            this.hasSummonedDuringStandby = true;
            console.log("A card has been summoned during the standby phase.");
        });
        this.enemyHand = new Hand(enemy);
        this.gamePhase = 1;
        this.gameFlag = true;
    }

    
    mainGame() {

        switch (this.gamePhase) {
            case 0:
                this.drawPhase();
                break;

            case 1:
                this.standbyPhase();
                this.endOfStandbyPhase();
                break;

            case 2:
                this.attackingPhase();
                break;

            case 3:
                this.endPhase();
                break;

            default:
                this.gameFlag = false;
                break;
        }

    }

    drawPhase() {

    }

    standbyPhase() {
        this.enemyHand.displayEnemyCard();
        this.userHand.displayCards();

    }

    attackingPhase() {

    }

    endPhase() {

    }

    endOfStandbyPhase() {
        // Logic to end the standby phase...
        this.hasSummonedDuringStandby = false; // Reset summon status
    }
}

export function showDescription(card) {
    const imageSrc = card['\u0000Card\u0000image_url'];
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


export function hideDescription() {
    document.getElementsByClassName('description_container')[0].style.display = 'none';
}





