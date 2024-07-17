function gacha() {
    const results = ["Rare Fish", "Common Fish", "Epic Fish", "Legendary Fish"];
    const randomResult = results[Math.floor(Math.random() * results.length)];
    document.getElementById('gacha_result').innerText = `You got a ${randomResult}!`;
}

document.addEventListener('DOMContentLoaded', () => {
    const mainBody = document.querySelector('.main_body');
    const promoteCard = document.querySelector('.promote_card');

    promoteCard.addEventListener('mouseover', () => {
        mainBody.classList.add('dimmed');
        promoteCard.classList.add('highlight');
    });

    promoteCard.addEventListener('mouseout', () => {
        mainBody.classList.remove('dimmed');
    });
});
