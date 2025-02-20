<?php 
include ('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Chatapp</title>
</head>
<body>
    <div id="container">
        <div id="chatbox"></div> 

        <form id="chatForm">
            <input type="text" name="name" placeholder="Enter your name" required>
            <textarea name="msg" placeholder="Enter your message" required></textarea>
            <input type="submit" value="Send">
        </form>
    </div>

    <script>
        function loadMessages() {
            fetch("fetch_messages.php")
            .then(response => response.text())
            .then(data => {
                document.getElementById("chatbox").innerHTML = data;
            });
        }

        setInterval(loadMessages, 1000);

        document.getElementById("chatForm").addEventListener("submit", function(event) {
            event.preventDefault(); // منع إعادة التحميل

            let formData = new FormData(this);

            fetch("send_message.php", {
                method: "POST",
                body: formData
            }).then(() => {
                loadMessages(); 
                document.getElementById("chatForm").reset();
            });
        });

        loadMessages();
    </script>

</body>
</html>
