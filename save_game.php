<?php
include 'includes/db.php';

$playerX = $_POST['player_x'];
$playerO = $_POST['player_o'];
$winner = $_POST['winner'];
$moves = $_POST['moves'];


function upsertPlayer($conn, $player) {
    $stmt = $conn->prepare("SELECT id, wins FROM players WHERE name = ?");
    $stmt->bind_param("s", $player);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $playerId = $row['id'];
        $wins = $row['wins'];
    }

    return ['id' => $playerId, 'wins' => $wins];
}

$playerXData = upsertPlayer($conn, $playerX);
$playerOData = upsertPlayer($conn, $playerO);

if ($winner === $playerX) {


    $winnerId = $playerXData['id'];

    $playerXData['wins']++;
    $stmt = $conn->prepare("UPDATE players SET wins = ? WHERE id = ?");
    $stmt->bind_param("ii", $playerXData['wins'], $winnerId);
    $stmt->execute();
} elseif ($winner === $playerO) {


    $winnerId = $playerOData['id'];

    $playerOData['wins']++;
    $stmt = $conn->prepare("UPDATE players SET wins = ? WHERE id = ?");
    $stmt->bind_param("ii", $playerOData['wins'], $winnerId);
    $stmt->execute();
} else {
    $winnerId = null;
}

$stmt = $conn->prepare("INSERT INTO games (player_x_id, player_o_id, winner, moves) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $playerXData['id'], $playerOData['id'], $winner, $moves);
$stmt->execute();

$conn->close();
?>
