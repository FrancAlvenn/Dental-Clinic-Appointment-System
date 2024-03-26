<?php

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use Twilio\Rest\Client;

require_once __DIR__ . "/../../vendor/autoload.php";

// Check if the request is made via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number = $_POST["number"];
    $message = $_POST["message"];

    $base_url = "https://2vnl2z.api.infobip.com";
    $api_key = "162c6972aefcfa36dbbef6fbaf46267a-35ffb26f-807a-4285-8d5a-b1e29f08e6a4";

    $configuration = new Configuration(host: $base_url, apiKey: $api_key);

    $api = new SmsApi(config: $configuration);

    $destination = new SmsDestination(to: $number);

    $message = new SmsTextualMessage(
        destinations: [$destination],
        text: $message,
        from: "Dental Clinic"
    );

    $request = new SmsAdvancedTextualRequest(messages: [$message]);

    try {
        $response = $api->sendSmsMessage($request);
        $responseData = [
            'success' => true,
            'message' => 'Message sent successfully'
        ];
    } catch (\Throwable $e) {
        $responseData = [
            'success' => false,
            'message' => 'Failed to send message: ' . $e->getMessage()
        ];
    }

    // Return response as JSON
    header('Content-Type: application/json');
    echo json_encode($responseData);
    exit;
} else {
    // If not an AJAX request or missing required parameters
    $responseData = [
        'success' => false,
        'message' => 'Invalid request. Please provide both number and message parameters.'
    ];

    // Return response as JSON
    header('Content-Type: application/json');
    echo json_encode($responseData);
    exit;
}
?>
