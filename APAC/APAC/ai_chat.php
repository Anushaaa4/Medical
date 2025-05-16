<?php
$aiResponse = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_input'])) {
    $apiKey = "AIzaSyBe0skxxAv4an-SdGoJKAka9BPDgKQQMSA"; // Replace this with your actual API key
    $userMessage = htmlspecialchars($_POST['user_input']);

    // Prepare the request data according to the API spec
    $data = [
        "prompt" => [
            "text" => $userMessage
        ],
        "temperature" => 0.7,
        "maxOutputTokens" => 256
    ];

    // Correct API endpoint with your model name
    $url = "https://generativelanguage.googleapis.com/v1beta/models/text-bison-001:generateText?key=$apiKey";

    // Initialize curl and set options
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute the request
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Handle errors or parse response
    if (curl_errno($ch)) {
        $aiResponse = "⚠️ cURL Error: " . curl_error($ch);
    } elseif ($httpCode !== 200) {
        $aiResponse = "⚠️ Error: Gemini API returned HTTP $httpCode\n\n$response";
    } else {
        $responseData = json_decode($response, true);
        if (isset($responseData['candidates'][0]['output'])) {
            $aiResponse = $responseData['candidates'][0]['output'];
        } else {
            $aiResponse = "⚠️ Gemini responded but no valid answer was found.";
        }
    }

    curl_close($ch);
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Ask MediConnect AI</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #e8f0fe;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #1a73e8;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        textarea {
            padding: 10px;
            font-size: 16px;
            resize: vertical;
            min-height: 80px;
            margin-bottom: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            background: #1a73e8;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #1558b0;
        }

        .response-box {
            margin-top: 20px;
            padding: 15px;
            background: #f1f3f4;
            border-radius: 8px;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2>🧠 Ask MediConnect AI</h2>
        <form method="post">
            <textarea name="user_input" placeholder="Ask a medical question or type your query..." required><?php echo isset($_POST['user_input']) ? htmlspecialchars($_POST['user_input']) : '' ?></textarea>
            <button type="submit">Ask AI</button>
        </form>

        <?php if (!empty($aiResponse)): ?>
            <div class="response-box">
                <strong>AI Response:</strong><br>
                <?php echo nl2br(htmlspecialchars($aiResponse)); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
