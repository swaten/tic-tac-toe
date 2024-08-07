<?php
session_start();
include 'includes/db.php';

$result = $conn->query("SELECT name, wins FROM players ORDER BY wins DESC");

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
    <title>Game Results</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <form method="post">
            <input type="submit" name="end_game" value="End Game"><br><br><br>
        </form>
        <h1>Game Results</h1>
        <table>
            <tr>
                <th>Player</th>
                <th>Wins</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['wins']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <a href="index.php">Start New Game</a>
    </div>
</body>
</html>

<?php
$conn->close();

?>
