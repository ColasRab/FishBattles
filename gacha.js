function gacha() {
    const coinsElement = document.getElementById('coins');
    const coins = parseInt(coinsElement.innerText, 10);

    if (coins >= 100) {
        window.location.href = 'GachaResult.php';
    } else {
        alert('You need at least 100 coins to play Gacha.');
    }
}