<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $playerX = $_POST['player_x'];
    $playerO = $_POST['player_o'];

    $_SESSION['player_x'] = $playerX;
    $_SESSION['player_o'] = $playerO;

    include 'includes/db.php';

    // Insert players if not exists
    $stmt = $conn->prepare("INSERT INTO players (name) VALUES (?) ON DUPLICATE KEY UPDATE id=id");
    $stmt->bind_param("s", $playerX);
    $stmt->execute();

    $stmt->bind_param("s", $playerO);
    $stmt->execute();

    header("Location: game.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Tic Tac Toe</h1>
        <form id="player-form" method="POST">
            <label for="player_x">Player X Name:</label>
            <input type="text" id="player_x" name="player_x" required>
            <label for="player_o">Player O Name:</label>
            <input type="text" id="player_o" name="player_o" required>
            <button type="submit">Start Game</button>
        </form>
    </div>
</body>
</html>
