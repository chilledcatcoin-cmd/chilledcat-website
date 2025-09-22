<?php
// Path to file
$file = "counter.txt";

// Read current count
$count = (int)file_get_contents($file);

// Increment
$count++;

// Save back
file_put_contents($file, $count);

// Return count
echo $count;
?>