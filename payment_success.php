<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Successful Payment</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    text-align: center;
    
  }
  
  .checkmark {
    margin: 0 auto;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    border: 3px solid #4CAF50;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 100px;
  }

  .checkmark i {
    color: #4CAF50;
    font-size: 90px;
    
  }

  .message {
    margin-top: 30px;
    font-size: 30px;
    color: #333;
  }
</style>
</head>
<body>
  <div class="checkmark">
    <i class="fas fa-check">✔</i>
  </div>
  <div class="message">Successful Payment</div>
  <p><a href='index.php'>Back to Home</a></p>
</body>
</html>