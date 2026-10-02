<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

require __DIR__ . '/config.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$goal = trim($_POST['goal'] ?? '');
$membership = trim($_POST['membership'] ?? '');
$message = trim($_POST['message'] ?? '');

$allowedGoals = ['strength', 'weight-loss', 'conditioning', 'competition'];
$allowedMemberships = ['Basic', 'Pro', 'Elite'];

if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Please enter a valid name, email, and message.']);
    exit;
}

if (!in_array($goal, $allowedGoals, true)) {
    $goal = 'strength';
}

if (!in_array($membership, $allowedMemberships, true)) {
    $membership = 'Pro';
}

try {
    $stmt = $pdo->prepare(
        'INSERT INTO contact_messages (name, email, goal, membership, message)
         VALUES (:name, :email, :goal, :membership, :message)'
    );

    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':goal' => $goal,
        ':membership' => $membership,
        ':message' => $message,
    ]);

    echo json_encode([
        'success' => true,
        'message' => "Thanks, {$name}! Your request has been saved. We'll be in touch soon."
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Could not save your request. Please try again.'
    ]);
}
