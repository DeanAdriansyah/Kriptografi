<?php
$key = "dean";
function Encrypt($plainText, $key) {
    $plainText = "password";
    $alphabet = 'abcdefghijklmnopqrstuvwxyz';
    $encryptedText = '';

    for ($i = 0; $i < strlen($plainText); $i++) {
        $char = $plainText[$i];
        if (strpos($alphabet, $char) !== false) {
            $charIndex = strpos($alphabet, $char);
            $keyChar = $key[$charIndex % strlen($key)];
            $encryptedText .= $keyChar;
        }
    }

    return $encryptedText;
}

if(isset($_POST['submit'])) {
    $plainText = strtolower($_POST['plainText']);

    $abjad = "abcdefghijklmnopqrstuvwxyz";
    $hasil = $key . $abjad;
    $key = implode("", array_unique(str_split($hasil)));

    $hasilEnkripsi = Encrypt(str_replace(" ", "", $plainText), $key);
}


function Decrypt($ciphertext, $key) {
    $alphabet = 'abcdefghijklmnopqrstuvwxyz';
    $decryptedText = '';

    for ($i = 0; $i < strlen($ciphertext); $i++) {
        $char = $ciphertext[$i];
        if (strpos($key, $char) !== false) {
            $charIndex = strpos($key, $char);
            $alphabetIndex = $charIndex % strlen($alphabet);
            $plainChar = $alphabet[$alphabetIndex];
            $decryptedText .= $plainChar;
        }
    }

    return $decryptedText;
}




// Fungsi enkripsi dan dekripsi affine cipher
function registerUser($username, $password) {
    global $conn;

    $hashedPassword = EncryptPassword($password);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
    $conn->query($query);
}

function authenticateUser($username, $password) {
    global $conn;

    $query = "SELECT password FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    $key = "$password";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        $decryptedPassword = Decrypt($username, $key);

        return $password === $decryptedPassword;
    }

    return false;
}
?>
