<?php
// Set the content type to JSON
header('Content-Type: application/json');

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Execute the Python script
    $output = shell_exec('python3 download_schneehöhen_dateien.py 2>&1');
    
    // Check if the execution was successful
    if ($output !== null) {
        echo json_encode(['status' => 'success', 'output' => $output]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Failed to execute Python script']);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
}
?>