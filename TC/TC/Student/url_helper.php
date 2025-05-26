<?php
function encode_url($url) {
    return urlencode(base64_encode(gzcompress($url)));
}

function decode_url($encoded_url) {
    return gzuncompress(base64_decode(urldecode($encoded_url)));
}
?>