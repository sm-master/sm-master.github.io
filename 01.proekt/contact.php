<?php
header('Content-Type: application/json; charset=utf-8');

// Збір даних
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

// Масив для помилок
$errors = [];

// Валідація
if (mb_strlen($name) < 3) {
    $errors['name'] = 'Ім’я повинно містити мінімум 3 символи.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Некоректний email.';
}
if (mb_strlen($message) < 5) {
    $errors['message'] = 'Повідомлення повинно містити мінімум 5 символів.';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'errors' => $errors,
    ]);
    exit;
}

// Надсилання пошти
$to = 'your@email.com'; // ← Заміни на свою пошту
$subject = 'Нове повідомлення з сайту SmartMaster';
$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'From: ' . mb_encode_mimeheader($name, 'UTF-8') . " <$email>",
    'Reply-To: ' . $email,
];
$body = "Ім’я: $name\nEmail: $email\n\nПовідомлення:\n$message";

$sent = mail($to, $subject, $body, implode("\r\n", $headers));

if ($sent) {
    echo json_encode([
        'success' => true,
        'message' => 'Ваше повідомлення успішно надіслано!',
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Сталася помилка при надсиланні повідомлення.',
    ]);
}