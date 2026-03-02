<?php
require_once("controller/controller.php");
$call->checkUserLoggedIn();

$receiver_id = isset($_GET['receiver_id']) ? $_GET['receiver_id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $sender_id = $call->getUserData('id');
    $message = mysqli_real_escape_string($call->dbconnect(), $_POST['message']);
    $call->sendMessage($sender_id, $receiver_id, $message);
}

$messages = [];
if ($receiver_id) {
    $sender_id = $call->getUserData('id');
    $messages = $call->getMessages($sender_id, $receiver_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .chat-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #f1f1f1;
        }
        .message.sent {
            background-color: #d1e7dd;
            margin-left: auto;
            width: fit-content;
        }
        .message.received {
            background-color: #f8d7da;
            width: fit-content;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2>Chat with <?php echo $call->getUserId('firstname', $receiver_id); ?></h2>
        <div id="chat-box">
            <?php
            if (mysqli_num_rows($messages) > 0) {
                while ($row = mysqli_fetch_assoc($messages)) {
                    $class = $row['sender_id'] == $call->getUserData('id') ? 'sent' : 'received';
                    echo "<div class='message $class'>" . htmlspecialchars($row['message']) . "</div>";
                }
            } else {
                echo "<p>No messages yet. Start the conversation!</p>";
            }
            ?>
        </div>
        <form method="POST" action="">
            <div class="input-group mb-3">
                <input type="text" name="message" class="form-control" placeholder="Type a message..." required>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
    </div>
    <script>
    function fetchMessages() {
        fetch('get_messages.php?receiver_id=<?php echo $receiver_id; ?>')
            .then(response => response.text())
            .then(data => {
                document.getElementById('chat-box').innerHTML = data;
            });
    }

    setInterval(fetchMessages, 5000); // Refresh every 5 seconds
</script>
</body>
</html>