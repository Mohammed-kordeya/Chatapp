<?php 
include ('db.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.3">
    <title>Chatapp</title>
</head>
<body>
   
    <div id="container">
        <div id="chatbox"></div> 

        <form id="chatForm" enctype="multipart/form-data">
    <input type="text" id="username" name="name" placeholder="Enter your name" required>
    <textarea name="msg" placeholder="Enter your message" required></textarea>
    <input type="file" name="image" accept="image/*">
    <input type="submit" value="Send">
</form>
    </div>

    <script>
        
      document.addEventListener("DOMContentLoaded", function () {
    let usernameField = document.getElementById("username");

    if (localStorage.getItem("username")) {
        usernameField.value = localStorage.getItem("username");
    }

    usernameField.addEventListener("input", function () {
        localStorage.setItem("username", usernameField.value);
    });

    function loadMessages() {
        fetch("fetch_messages.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("chatbox").innerHTML = data;
        });
    }

    setInterval(loadMessages, 1000);

    document.getElementById("chatForm").addEventListener("submit", function(event) {
        event.preventDefault();

        let usernameValue = usernameField.value; 
        let formData = new FormData(this);

        fetch("send_message.php", {
            method: "POST",
            body: formData
        }).then(() => {
            loadMessages(); 
            document.getElementById("chatForm").reset();
            usernameField.value = usernameValue; 
        });
    });

    loadMessages();
});

    </script>

</body>
</html>
