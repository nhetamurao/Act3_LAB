<?php
$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

// Ensure the uploads directory exists
if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0777, true);
}

// Handle PDF File
if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
    $uploaded_pdf_file = $upload_directory . basename($_FILES['pdf_file']['name']);
    $temporary_file = $_FILES['pdf_file']['tmp_name'];

    if (move_uploaded_file($temporary_file, $uploaded_pdf_file)) {
        echo '<h3>Uploaded PDF File:</h3>';
        echo '<embed src="' . $relative_path . basename($_FILES['pdf_file']['name']) . '" width="600" height="500" type="application/pdf">';
    } else {
        echo 'Failed to upload PDF file';
    }
}

// Handle Audio File
$uploaded_audio_file = $upload_directory . basename($_FILES['audio_file']['name']);
$temporary_audio_file = $_FILES['audio_file']['tmp_name'];

if (move_uploaded_file($temporary_audio_file, $uploaded_audio_file)) {
    echo "<audio controls>
            <source src='{$relative_path}" . basename($_FILES['audio_file']['name']) . "' type='audio/mpeg'>
          Your browser does not support the audio element.
          </audio>";
} else {
    echo 'Failed to upload audio file';
}


echo '<pre>';
var_dump($_FILES);
exit;