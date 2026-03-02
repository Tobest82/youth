<?php
require_once("controller/controller.php");
$call->checkUserLoggedIn();

$receiver_id = isset($_GET['receiver_id']) ? $_GET['receiver_id'] : null;
if ($receiver_id) {
    $sender_id = $call->getUserData('id');
    $messages = $call->getMessages($sender_id, $receiver_id);
    if (mysqli_num_rows($messages) > 0) {
        while ($row = mysqli_fetch_assoc($messages)) {
            $class = $row['sender_id'] == $call->getUserData('id') ? 'sent' : 'received';
            echo "<div class='message $class'>" . htmlspecialchars($row['message']) . "</div>";
        }
    }
}
?>