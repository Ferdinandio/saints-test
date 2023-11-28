<?php

include 'auth.php';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$timestamp = date('Y-m-d H:i:s');
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$sql = "INSERT INTO applications (timestamp, name, phone, email) VALUES ('$timestamp', '$name', '$phone', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Данные успешно добавлены в базу данных";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
//// Делаем что-то с полученными данными (например, сохраняем их в базу данных)
//
//// Отправляем ответ обратно
//echo "Спасибо! Ваши данные были получены: Имя: $name, Телефон: $phone, Email: $email";

