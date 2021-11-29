<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create a Message</title>
</head>
<body>
    <h1>Create a Message</h1>
    <form action="" method="post">
        <label>Sender</label>
        <input disabled type="text" name="sender" value="<?php echo $data->sender; ?>"> </input><br>
        <label>Receiver</label>
        <input disabled type="text" name="sender" value="<?php echo $data->receiver;?>"> </input><br>
        <label>Message</label>
        <textarea name="message" placeholder="Type your message here..."></textarea><br>
        <input type="submit" name="action" value="Send"></input>
    </form>
</body>
</html>