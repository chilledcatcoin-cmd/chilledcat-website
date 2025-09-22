<?php
$file = "guestbook.txt";

// Save new entry
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $message = htmlspecialchars($_POST["message"]);
    $date = date("Y-m-d H:i:s");

    $entry = "<p><strong>$name</strong> ($date):<br>" . nl2br($message) . "</p>\n---\n";
    file_put_contents($file, $entry, FILE_APPEND | LOCK_EX);
    header("Location: guestbook.php"); // Prevent resubmission on refresh
    exit;
}

// Load all entries
$entries = "";
if (file_exists($file)) {
    $entries = file_get_contents($file);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Chilled Cat Guestbook</title>
  <style>
    body { background: #001f3f; color: #d0eaff; font-family: "Comic Sans MS"; text-align:center; }
    h1 { color: #66ccff; text-shadow: 0 0 5px #00ccff; }
    form { margin: 20px auto; width: 300px; text-align:left; }
    input, textarea {
      width: 100%;
      margin-bottom: 10px;
      padding: 6px;
      border: 2px solid #00ccff;
      background: #003366;
      color: #e0f7ff;
      border-radius: 6px;
    }
    input[type=submit] {
      cursor: pointer;
      background: #004080;
      font-weight: bold;
    }
    .entries {
      margin: 20px auto;
      width: 80%;
      text-align:left;
      border-top: 2px solid #00ccff;
      padding-top: 20px;
    }
    .entries p {
      background:#002244;
      padding:10px;
      border-radius:6px;
      box-shadow:0 0 8px #00aaff inset;
    }
  </style>
</head>
<body>
  <h1>😺 Sign the Chilled Cat Guestbook</h1>
  
  <form action="guestbook.php" method="POST">
    <label>Your Name:</label><br>
    <input type="text" name="name" required><br>
    
    <label>Your Message:</label><br>
    <textarea name="message" rows="4" required></textarea><br>
    
    <input type="submit" value="Sign Guestbook">
  </form>
  
  <div class="entries">
    <h2>Previous Visitors:</h2>
    <?php echo $entries ?: "<p>No entries yet. Be the first to sign!</p>"; ?>
  </div>
</body>
</html>
