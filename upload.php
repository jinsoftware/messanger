<?php
$uploadDir = "uploads/";

// Create folder if it doesn't exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Save text input (if available)
if (!empty($_POST['text'])) {
    $textContent = $_POST['text'];
    $filename = $uploadDir . "text_" . date("Ymd_His") . ".txt";
    file_put_contents($filename, $textContent);
}

// Save uploaded files (if any)
if (!empty($_FILES['files'])) {
    foreach ($_FILES['files']['tmp_name'] as $index => $tmpName) {
        $originalName = basename($_FILES['files']['name'][$index]);
        $targetPath = $uploadDir . date("Ymd_His") . "_" . $originalName;
        move_uploaded_file($tmpName, $targetPath);
    }
}

// Send success response
echo json_encode(["status" => "success"]);
?>
