<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../config.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

// Set content type to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $slug = $_POST['slug'] ?? '';
    $interested = $_POST['interested'] ?? '';

    if (empty($slug) || empty($interested)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Slug and interested status are required.'
        ]);
        exit;
    }

    // Validate interested value
    if (!in_array($interested, ['Interested', 'Not Interested'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Invalid interested status.'
        ]);
        exit;
    }

    try {
        // First, get current lead status and info
        $stmt = $conn->prepare("SELECT client_name, interested FROM leads WHERE slug = ?");
        $stmt->bind_param("s", $slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $lead = $result->fetch_assoc();
        $stmt->close();

        if (!$lead) {
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'message' => 'Lead not found.'
            ]);
            exit;
        }

        $name = $lead['client_name'] ?? 'Unknown';
        $currentStatus = $lead['interested'] ?? 'Waiting for response';

        // Check if already responded (prevent spam clicking)
        if ($currentStatus !== 'Waiting for response') {
            // Return success but with a different message indicating already responded
            echo json_encode([
                'success' => true,
                'already_responded' => true,
                'current_status' => $currentStatus,
                'message' => getThankYouMessage($currentStatus)
            ]);
            exit;
        }

        // Update interested status - only if currently waiting for response
        $stmt = $conn->prepare("UPDATE leads SET interested = ?, response_date = NOW() WHERE slug = ? AND interested = 'Waiting for response'");
        $stmt->bind_param("ss", $interested, $slug);

        if ($stmt->execute()) {
            $affected_rows = $stmt->affected_rows;
            $stmt->close();

            if ($affected_rows > 0) {
                // Successfully updated - send appropriate email
                $emailSent = false;
                $emailError = '';

                try {
                    if ($interested === 'Interested') {
                        sendInterestEmail($name, $slug);
                        $emailSent = true;
                    } elseif ($interested === 'Not Interested') {
                        sendNotInterestedEmail($name, $slug);
                        $emailSent = true;
                    }
                } catch (Exception $e) {
                    $emailError = $e->getMessage();
                    error_log("Email sending failed: " . $emailError);
                }

                echo json_encode([
                    'success' => true,
                    'message' => getThankYouMessage($interested),
                    'status' => $interested,
                    'email_sent' => $emailSent,
                    'email_error' => $emailError
                ]);
            } else {
                // No rows affected - someone else already updated it
                echo json_encode([
                    'success' => true,
                    'already_responded' => true,
                    'message' => 'Thank you! Your response has already been recorded.'
                ]);
            }
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }

    } catch (Exception $e) {
        error_log("Error in update-response.php: " . $e->getMessage());
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'An error occurred while processing your response. Please try again.'
        ]);
    }

} else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed.'
    ]);
}

// Function to get appropriate thank you message
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

// Function to send interested email
function sendInterestEmail($name, $slug)
{
    $mail = new PHPMailer(true);

    try {
        setupSMTP($mail);
        setupRecipients($mail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Customer is Interested! - ' . $name;

        // Check if template exists, otherwise use default content
        $templatePath = 'interested_email_template.html';
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            $mail->Body = str_replace(
                ['{{name}}', '{{slug}}'],
                [$name, $slug],
                $template
            );
        } else {
            $mail->Body = "
                <h2>New Lead is Interested!</h2>
                <p><strong>Client:</strong> {$name}</p>
                <p><strong>Slug:</strong> {$slug}</p>
                <p><strong>Status:</strong> Interested</p>
                <p><strong>Time:</strong> " . date('Y-m-d H:i:s') . "</p>
                <p>Please follow up with this lead as soon as possible.</p>
            ";
        }

        $mail->send();
        error_log('Interest email sent for: ' . $name);
    } catch (Exception $e) {
        error_log("PHPMailer error (interest): {$mail->ErrorInfo}");
        throw $e;
    }
}

// Function to send not interested email
function sendNotInterestedEmail($name, $slug)
{
    $mail = new PHPMailer(true);

    try {
        setupSMTP($mail);
        setupRecipients($mail);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Customer Not Interested - ' . $name;

        // Check if template exists, otherwise use default content
        $templatePath = 'not_interested_email_template.html';
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);
            $mail->Body = str_replace(
                ['{{name}}', '{{slug}}'],
                [$name, $slug],
                $template
            );
        } else {
            $mail->Body = "
                <h2>Lead Not Interested</h2>
                <p><strong>Client:</strong> {$name}</p>
                <p><strong>Slug:</strong> {$slug}</p>
                <p><strong>Status:</strong> Not Interested</p>
                <p><strong>Time:</strong> " . date('Y-m-d H:i:s') . "</p>
                <p>This lead has indicated they need more time. Consider following up in a few weeks.</p>
            ";
        }

        $mail->send();
        error_log('Not interested email sent for: ' . $name);
    } catch (Exception $e) {
        error_log("PHPMailer error (not interested): {$mail->ErrorInfo}");
        throw $e;
    }
}

// Helper function to setup SMTP settings
function setupSMTP($mail)
{
    $mail->isSMTP();
    $mail->Host = 'smtp-relay.brevo.com'; // Brevo SMTP
    $mail->SMTPAuth = true;
    $mail->Username = '90c28d001@smtp-brevo.com'; // Your Brevo login
    $mail->Password = 'bprQgwxAKjH7yIvd';               // Your Brevo SMTP key
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
}

// Helper function to setup recipients
function setupRecipients($mail)
{
    $mail->setFrom('no-reply@jwcreative.ca', 'JW Creative'); // Your sending email
    $mail->addAddress('jwcreativeca@gmail.com', 'Your Name'); // Your receiving email
}
?>