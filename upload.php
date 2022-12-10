<?php
$target_dir = "songs";
$target_file = $target_dir . "/" . basename($_FILES["fileToUpload"]["name"]);

if (preg_match('/.mp3$/', $target_file)) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " uploaded.";
    } else {
        echo "Error uploading file.";
    }
    header('Location: index4.php');

} else {
    echo "Error uploading file.";
    header('Location: upload_file.php');
}


