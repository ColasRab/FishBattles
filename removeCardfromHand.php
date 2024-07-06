<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardName = $_POST['cardName'];
    $userId = $_SESSION['userId']; // Adjust according to how you manage sessions

    // Fetch the user's hand
    $hand = unserialize($_SESSION[$userId . '_Hand']);
    // Logic to find and remove the card by name
    // This depends on how your Card objects are structured and identified
    // For example, if each Card object has a getName() method:
    foreach ($hand->cards as &$card) {
        if ($card->getName() === $cardName) {
            $hand->removeCard($card->getId()); // Assuming getId() returns the card's ID
            break;
        }
    }
    unset($card);

    // Save the updated hand back to session
    $_SESSION[$userId . '_Hand'] = serialize($hand);

    echo "success";
} else {
    http_response_code(405); // Method Not Allowed
}
