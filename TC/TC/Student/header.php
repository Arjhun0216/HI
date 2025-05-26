<?php
// Function to encode the URL
function encode_url($url) {
    return base64_encode($url);
}

// Get the full URL of the current page
function get_current_url() {
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $url;
}

// Check if the "encoded" parameter is already present to prevent infinite redirects
if (!isset($_GET['encoded'])) {
    // Get the current page URL
    $current_url = get_current_url();

    // Encode the current URL
    $encoded_url = encode_url($current_url);

    // Redirect to the "redirect.php" page with the encoded URL
    header("Location: redirect.php?url=$encoded_url&encoded=1");
    exit();
} else {
    // If already encoded, display the content of the current page
    echo "This is the original page content.";
}
?>