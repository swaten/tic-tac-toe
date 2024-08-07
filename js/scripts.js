$(document).ready(function() {
    let currentPlayer = 'X';
    let moves = ['', '', '', '', '', '', '', '', ''];
    let gameActive = true;

    function checkWinner() {
        const winningCombinations = [
            [0, 1, 2], [3, 4, 5], [6, 7, 8],
            [0, 3, 6], [1, 4, 7], [2, 5, 8],
            [0, 4, 8], [2, 4, 6]
        ];

        for (const combination of winningCombinations) {
            const [a, b, c] = combination;
            if (moves[a] && moves[a] === moves[b] && moves[a] === moves[c]) {
                return moves[a];
            }
        }
        return moves.includes('') ? null : 'Draw';
    }

    function handleClick() {
        if (!gameActive || $(this).text()) return;

        $(this).text(currentPlayer);
        const cellIndex = $(this).data('cell');
        moves[cellIndex] = currentPlayer;

        const winner = checkWinner();
        if (winner) {
            gameActive = false;
            $('#message').text(winner === 'Draw' ? "It's a draw!" : currentPlayer + " wins!");
            saveGame(winner);
        } else {
            currentPlayer = currentPlayer === 'X' ? 'O' : 'X';
        }
    }

    function saveGame(winner) {
      win = winner == 'X' ? playerX : playerO;
        $.post('save_game.php', {
            player_x: playerX,
            player_o: playerO,
            winner: win,
            moves: JSON.stringify(moves)
        }, function(response) {
            console.log('Game saved:', response);
        });
    }

    function resetGame() {
        currentPlayer = 'X';
        moves = ['', '', '', '', '', '', '', '', ''];
        gameActive = true;
        $('#board td').text('');
        $('#message').text('');
    }

    function showResults() {
        window.location.href = 'results.php';
    }

    $('#board td').on('click', handleClick);
    $('#reset').on('click', resetGame);
    $('#showResults').on('click', showResults);
});
