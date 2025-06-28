<?php
require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientName = $_POST['clientName'] ?? '';
    $slug = $_POST['slug'] ?? '';
    $originalPrice = $_POST['originalPrice'] ?? '';
    $offerPrice = $_POST['offerPrice'] ?? '';
    $demo1Type = $_POST['demo1Type'] ?? '';
    $demo2Type = $_POST['demo2Type'] ?? '';
    $demo3Type = $_POST['demo3Type'] ?? '';
    $demo1Title = $_POST['demo1Title'] ?? '';
    $demo2Title = $_POST['demo2Title'] ?? '';
    $demo3Title = $_POST['demo3Title'] ?? '';
    $demo1Desc = $_POST['demo1Desc'] ?? '';
    $demo1Image = $_POST['demo1Image'] ?? '';
    $demo1Url = $_POST['demo1Url'] ?? '';
    $demo2Desc = $_POST['demo2Desc'] ?? '';
    $demo2Image = $_POST['demo2Image'] ?? '';
    $demo2Url = $_POST['demo2Url'] ?? '';
    $demo3Desc = $_POST['demo3Desc'] ?? '';
    $demo3Image = $_POST['demo3Image'] ?? '';
    $demo3Url = $_POST['demo3Url'] ?? '';
    $interested = "Waiting for response";


    if (empty($clientName) || empty($description) || empty($slug)) {
        http_response_code(400);
        echo "All fields are required.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO leads (client_name, slug, original_price, offer_price, demo1_type, demo1_title, demo1_desc, demo1_image, demo1_url, demo2_type, demo2_title, demo2_desc, demo2_image, demo2_url, demo3_type, demo3_title, demo3_desc, demo3_image, demo3_url, interested) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddssssssssssssssss", $clientName, $slug, $originalPrice, $offerPrice, $demo1Type, $demo1Title, $demo1Desc, $demo1Image, $demo1Url, $demo2Type, $demo2Title, $demo2Desc, $demo2Image, $demo2Url, $demo3Type, $demo3Title, $demo3Desc, $demo3Image, $demo3Url, $interested);

    if ($stmt->execute()) {
        echo "Lead added successfully.";
    } else {
        http_response_code(500);
        echo "Error adding lead: " . $stmt->error;
    }

    $stmt->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}