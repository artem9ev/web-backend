<?php
include('SecretData.php');
$servername = "localhost";
$username = user;
$password = pass;
$dbname = user;

$fio = $phone = $email = $birthdate = $gender = '';
$fio = $_POST['fio'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];
$bio = $_POST['biography'];
$langs = isset($_POST['selections']) ? (array)$_POST['selections'] : [];
$langs_check = ['lua', 'c', 'c++', 'c#', 'php', 'phyton', 'java', 'js', 'ruby', 'go'];


function checkLangs($langs, $langs_check) {
    for ($i = 0; $i < count($langs); $i++) {
        $isTrue = FALSE;
        for ($j = 0; $j < count($langs_check); $j++) {
            if ($langs[$i] === $langs_check[$j]) {
                $isTrue = TRUE;
                break;
            }
        }
        if ($isTrue === FALSE) return FALSE;
    }
    return TRUE;
}


if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo 'This script only works with POST queries';
    exit();
}

$errors = FALSE;

if (empty($_POST['fio']) || !preg_match('/^[а-яА-ЯёЁa-zA-Z\s-]{1,150}$/u', $_POST['fio'])) {
    $errors = TRUE;
    print (" mistake in fio ");
}

if (empty($phone) || !preg_match('/^[0-9+]+$/', $phone)) {
    $errors = TRUE;
    print (" mistake in phone ");
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors = TRUE;
    print (" mistake in mail ");
}


$dateObject = DateTime::createFromFormat('Y-m-d', $birthdate);
if ($dateObject === false || $dateObject->format('Y-m-d') !== $birthdate) {
    $errors = TRUE;
    print (" mistake in date ");
    //добавить проверку на 0
}

if ($gender != 'male' && $gender != 'female') {
    $errors = TRUE;
    print (" mistake in male ");
}

/*
if (!checkLangs($langs, $langs_check)) {
    $errors = TRUE;
    print (" mistake in check ");
}*/

if(empty($_POST['check'])){
    $errors = TRUE;
    print (" mistake in check ");
}

if ($errors === TRUE) {
    echo 'mistake';
    exit();
}

try {
    $conn = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully ";
    $sql = "INSERT INTO Request (fio, phone, email, birthdate, gender, biography)
VALUES ('$fio', '$phone', '$email', '$birthdate', '$gender', '$bio')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $lastId = $conn->lastInsertId();

    for ($i = 0; $i < count($langs); $i++) {
        $sql = "SELECT id_lang FROM Proglang_name WHERE name_lang = :langName";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':langName', $langs[$i]);
        $stmt->execute();
        $result = $stmt->fetch();
        $lang_id = $result['id_lang'];
        $sql = "INSERT INTO Feedback (id, id_lang) VALUES ($lastId, $lang_id)";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    echo nl2br("\nNew record created successfully");
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$conn = null;
?>