<?php
// Połączenie z bazą danych
$host = "localhost"; // lub adres serwera
$user = "nazwa_uzytkownika";
$password = "haslo";
$database = "nazwa_bazy";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
  die("Błąd połączenia: " . $conn->connect_error);
}

// Odbieranie danych z formularza
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // szyfrowanie hasła

// Zapis do bazy danych
$sql = "INSERT INTO accounts (name, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
  echo "Konto utworzone pomyślnie!";
} else {
  echo "Błąd: " . $stmt->error;
}

$conn->close();
?>
