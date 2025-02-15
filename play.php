<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Error: Missing or invalid 'id' parameter.";
    exit;
}

$id = htmlspecialchars($_GET['id']);
$url = "http://opplex.live:8080/live/56425836/56425836/{$id}.m3u8";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "User-Agent: XCIPTV"
]);

$response = curl_exec($ch);
if ($response === false) {
    echo "Error: cURL request failed. " . curl_error($ch);
    curl_close($ch);
    exit;
}

$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$final_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
curl_close($ch);

if ($status_code != 200) {
    echo "Error: Failed to fetch the m3u8 file. HTTP status code: $status_code";
    exit;
}

$parsed_url = parse_url($final_url);
$baseUrl = $parsed_url['scheme'] . '://' . $parsed_url['host'];

if (isset($parsed_url['port'])) {
    $baseUrl .= ':' . $parsed_url['port'];
}

$lines = explode("\n", $response);
$processedLines = [];

foreach ($lines as $line) {
    if (preg_match('#^/hls/.*\.ts$#', $line)) {
        $processedLines[] = $baseUrl . $line;
    } else {
        $processedLines[] = $line;
    }
}

$processedResponse = implode("\n", $processedLines);

header('Content-Type: application/vnd.apple.mpegurl');
echo $processedResponse;
?>
