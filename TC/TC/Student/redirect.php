<?php
// Function to decode the URL
function decode_url($encoded_url) {
    return base64_decode($encoded_url);
}

// Check if the URL parameter is set and it is not already encoded
if (isset($_GET['url']) && isset($_GET['encoded']) && $_GET['encoded'] == '1') {
    // Decode the encoded URL
    $decoded_url = decode_url($_GET['url']);

    // Redirect to the decoded URL
    header("Location: $decoded_url");
    exit();
} else {
    echo "Invalid or missing URL.";
}
?>