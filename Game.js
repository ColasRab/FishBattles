import Hand from './Hand.js';

let firstRound = true;

export default class Game {
    constructor(user, enemy) {
        this.hasSummonedDuringStandby = false;
        this.userHand = new Hand(user, () => {
            this.hasSummonedDuringStandby = true;
            console.log("A card has been summoned during the standby phase.");
        }, this);
        this.enemyHand = new Hand(enemy, null, this);
        this.gamePhase = 1;
        this.gameFlag = true;
        this.userLP = 8000;
        this.enemyLP = 8000;
        this.updatePhaseDisplay();
    }

    nextPhase() {
        if (firstRound) {
            this.gamePhase = 3;
        } else {
            this.gamePhase++;
        }
        this.mainGame();
        this.updatePhaseDisplay();
        console.log(this.gamePhase);
    }

    mainGame() {
        this.updatePhaseDisplay();
        switch (this.gamePhase) {
            case 0:
                this.updatePhaseDisplay();
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
        this.userHand.drawCard();
        firstRound = false;
        setTimeout(() => {
            this.nextPhase();
        }, 3000);
    }

    standbyPhase() {
        this.enemyHand.displayEnemyCard();
        this.userHand.displayCards();
        this.endOfStandbyPhase();
    }

    attackingPhase() {
        console.log("Attacking Phase");
        this.userHand.initiateAttack();
    }

    endPhase() {
        this.enemyTurn();
    }

    endOfStandbyPhase() {
        this.hasSummonedDuringStandby = false;
    }

    enemyTurn() {
        this.enemyDrawPhase();

        setTimeout(() => {
            this.enemyStandbyPhase();
        }, 5000);

        setTimeout(() => {
            this.enemyAttackingPhase();
        }, 10000);

        setTimeout(() => {
            this.enemyEndPhase();
        }, 15000);
    }

    enemyDrawPhase() {
        console.log("Enemy Draw Phase");
        this.enemyHand.drawCard(false);
    }

    enemyStandbyPhase() {
        console.log("Enemy Standby Phase");
        this.enemyHand.displayEnemyCard();
        this.enemyHand.summonRandomCard();
    }

    enemyAttackingPhase() {
        console.log("Enemy Attacking Phase");
        const totalDamage = this.enemyHand.enemyAttack(this.userHand, true);
        console.log(`Total Damage Dealt: ${totalDamage}`);
        this.updateLPDisplay();
    }

    enemyEndPhase() {
        console.log("Enemy End Phase");
        this.gamePhase = 0;
        this.drawPhase();
    }

    updateHandDisplay() {
        this.userHand.updateHandDisplay();
    }

    updateLPDisplay() {
        if (this.userLP <= 0) {
            this.displayGameOver("Game Over");
            return true;
        } else if (this.enemyLP <= 0) {
            this.displayGameOver("You Win");
            return true;
        }
        document.getElementById('userLP').innerText = `${this.userLP}`;
        document.getElementById('enemyLP').innerText = `${this.enemyLP}`;
    }

    displayGameOver(message) {
        document.getElementById('gameOverMessage').innerText = message;
        const gameFrameElement = document.querySelector('.gameOverScreen');
        gameFrameElement.style.display = 'flex';
        this.gameFlag = false;
    
        const gameContainer = document.querySelector('.container');
        gameContainer.classList.add('dimmed');
    }

    updatePhaseDisplay() {  
        const phaseDisplay = document.getElementById('phaseDisplay');
        const phaseContainer = document.querySelector('.phaseContainer');
        const phases = ["Draw Phase", "Standby Phase", "Attacking Phase", "End Phase"];
        phaseContainer.style.display = 'flex';
        phaseDisplay.innerText = phases[this.gamePhase] || "Unknown Phase";
    
        phaseDisplay.classList.add('animate-phase');

        setTimeout(() => {
            phaseDisplay.classList.remove('animate-phase');
            phaseContainer.style.display = 'none';
        }, 2000);
    }
}

export function showDescription(card) {
    const imageSrc = card['\u0000Card\u0000image_url'];
    const description = card['\u0000Card\u0000description'];
    const name = card['\u0000Card\u0000name'];
    const attack = card['\u0000Card\u0000atk'];
    const defense = card['\u0000Card\u0000def'];

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
