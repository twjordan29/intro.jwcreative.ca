<?php
require_once 'config.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Adjust if you're in a subdirectory (like /intro.jwcreative.ca/)
$base_path = '/intro.jwcreative.ca/';

$request_uri = $_SERVER['REQUEST_URI'];

// Remove query string (e.g., ?utm=xyz)
$request_uri = strtok($request_uri, '?');

// Remove base folder from URI to isolate the slug
if (strpos($request_uri, $base_path) === 0) {
    $slug = substr($request_uri, strlen($base_path));
} else {
    $slug = trim($request_uri, '/');
}

$slug = trim($slug, '/');

// Redirect to main site if no slug is found
if ($slug === '') {
    header("Location: https://jwcreative.ca");
    exit;
}

// ✅ 1. Fetch the lead
$stmt = $conn->prepare("SELECT * FROM leads WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$result = $stmt->get_result();
$lead = $result->fetch_assoc();
$stmt->close();

if (!$lead) {
    http_response_code(404);
    echo "Lead page not found.";
    exit;
}

// ✅ 2. Update the views count
$stmt = $conn->prepare("UPDATE leads SET views = views + 1 WHERE slug = ?");
$stmt->bind_param("s", $slug);
$stmt->execute();
$stmt->close();

// ✅ 3. Check if client has already responded
$hasResponded = ($lead['interested'] && $lead['interested'] !== 'Waiting for response');
$responseStatus = $lead['interested'];
$responseDate = $lead['response_date'] ?? null;

// ✅ 4. Function to get thank you message based on response
function getThankYouMessage($status)
{
    switch ($status) {
        case 'Interested':
            return "Thank you for your interest! We'll be in touch soon to discuss your project in detail.";
        case 'Not Interested':
            return "Thank you for your response. Feel free to reach out when you're ready!";
        default:
            return "Thank you for your response!";
    }
}

// ✅ 5. Render the template
include 'template.php';
?>