<?php
session_start();
if (!isset($_SESSION['player_x']) || !isset($_SESSION['player_o'])) {
    header("Location: index.php");
    exit();
}

include 'includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['end_game'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tic Tac Toe Game</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const playerX = <?php echo json_encode($_SESSION['player_x']); ?>;
        const playerO = <?php echo json_encode($_SESSION['player_o']); ?>;
    </script>
    <script src="js/scripts.js"></script>
</head>
<body>
    <div class="container">

        <form method="post">
          <input type="submit" name="end_game" value="End Game" ><br><br><br>
        </form>
        <h1>Tic Tac Toe</h1>
        <p>Player X: <?php echo htmlspecialchars($_SESSION['player_x']); ?></p>
        <p>Player O: <?php echo htmlspecialchars($_SESSION['player_o']); ?></p>
        <table id="board">
            <tr>
                <td data-cell="0"></td>
                <td data-cell="1"></td>
                <td data-cell="2"></td>
            </tr>
            <tr>
                <td data-cell="3"></td>
                <td data-cell="4"></td>
                <td data-cell="5"></td>
            </tr>
            <tr>
                <td data-cell="6"></td>
                <td data-cell="7"></td>
                <td data-cell="8"></td>
            </tr>
        </table>
        <p id="message"></p>
        <button id="reset">Reset Game</button>
        <button id="showResults">Show Results</button>
    </div>
</body>
</html>
