<?php
$servername = "localhost";
$username = "root";
$password = "0000";
$dbname = "tic_tac_toe";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create players table
$playersTable = "CREATE TABLE IF NOT EXISTS players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    wins INT DEFAULT 0,
    UNIQUE (name)
)";
$conn->query($playersTable);

// Create games table
$gamesTable = "CREATE TABLE IF NOT EXISTS games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    player_x_id INT,
    player_o_id INT,
    winner VARCHAR(50),
    moves TEXT,
    FOREIGN KEY (player_x_id) REFERENCES players(id),
    FOREIGN KEY (player_o_id) REFERENCES players(id)
)";
$conn->query($gamesTable);
?>
