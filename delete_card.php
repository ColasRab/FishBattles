<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

include('SQLConnect.php');

$data = json_decode(file_get_contents('php://input'), true);
$cardId = $data['card_id'];

$username = $_SESSION['username'];
$userIdQuery = "SELECT id FROM users WHERE username = ?";
$stmt = $con->prepare($userIdQuery);
$stmt->bind_param('s', $username);
$stmt->execute();
$userIdResult = $stmt->get_result();
$userIdRow = $userIdResult->fetch_assoc();
$userId = $userIdRow['id'];

// Get the current deck
$deckQuery = "SELECT cards FROM decks WHERE user_id = ?";
$stmt = $con->prepare($deckQuery);
$stmt->bind_param('i', $userId);
$stmt->execute();
$deckResult = $stmt->get_result();
$deckRow = $deckResult->fetch_assoc();
$deck = explode(',', $deckRow['cards']);

// Remove the card from the deck
$deck = array_filter($deck, function($deckCardId) use ($cardId) {
    return $deckCardId != $cardId;
});

// Update the deck in the database
$newDeck = implode(',', $deck);
$updateDeckQuery = "UPDATE decks SET cards = ? WHERE user_id = ?";
$stmt = $con->prepare($updateDeckQuery);
$stmt->bind_param('si', $newDeck, $userId);
$success = $stmt->execute();

echo json_encode(['success' => $success]);
?>
