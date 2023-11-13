<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Poppins font from Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap 5 Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Style.css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center text-center">
           <!-- Navbar -->
            <nav class="navbar navbar-expand-md bg-dark sticky-top" data-bs-theme="dark">
                <a class="navbar-brand ms-5" href="index.php"><i></i> Polyalphabetic</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-house-door"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php"><i class="bi bi-person-circle"></i> Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php"><i class="bi bi-envelope"></i> Contact</a>
                        </li>
                    </ul>
                    <span class="navbar-item me-5">
                        <a class="nav-link active text-white" href="admin/"><i class="bi bi-box-arrow-in-right"></i> Login Admin</a>
                    </span>
                </div>
            </nav>
            <div class="col-md-5 mt-5">
                <h4>Logika Polyalphabetic.</h4>
                <form method="post" action="">
                        <div class="form-group">
                            <label for="plainText">Masukkan Teks:</label>
                            <input type="text" class="form-control" name="plainText" id="plainText" required>
                        </div>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="action" id="encryptRadio" value="encrypt" required>
                            <label class="form-check-label" for="encryptRadio">Encrypt</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="action" id="decryptRadio" value="decrypt" required>
                            <label class="form-check-label" for="decryptRadio">Decrypt</label>
                        </div>
                        <div class="mt-3">
                            <button type="submit" name="submit" class="btn btn-dark">Proses</button>
                        </div>
                    </form>
                <!-- Fungsi polyalphabetic -->
                <?php
                $key = "dean";
                function Encrypt($plainText, $key) {
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
                

                if (isset($_POST['submit'])) {
                    $plainText = $_POST['plainText'];
                    $key = "dean";
                    $action = $_POST['action'];
                    $resultText = '';
                    
                    if ($action == "encrypt") {
                        $resultText = Encrypt($plainText, $key);
                        $resultTitle = "Hasil Encrypt:";
                    } else {
                        $resultText = Decrypt($plaintext, $key);
                        $resultTitle = "Hasil Decrypt:";
                    }
                ?>
                    <div class="mt-4">
                        <h4 class="text-center"><?= $resultTitle ?></h4>
                        <p class="text-center alert alert-success"><?= $resultText ?></p>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="mt-2 bg-info fixed-bottom text-center bg-dark">
        <p class="text-white">Midterm Exam.</p>
    </footer>
    <!-- Bootstrap 5 JS and Popper.js (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>