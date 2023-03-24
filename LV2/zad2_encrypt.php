<!DOCTYPE html>
<html>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    Odaberi datoteku (pdf,jpeg,png):
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
<?php

if ($_FILES) {
    $dir = "uploads/";
    $target_file = $dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Provjera je li je datoteka slika ili pdf
    if($imageFileType != "pdf" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "Dozvoljeni su samo PDF, JPEG i PNG formati.";
        $uploadOk = 0;
    }
    
    // Provjera je li je datoteka uspješno prenesena
    if ($uploadOk == 0) {
        echo "Datoteka nije prenesena.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Datoteka ". basename( $_FILES["fileToUpload"]["name"]). " je uspješno prenesena.";
            
            // Kriptiranje datoteke
            $passphrase = "tajna_lozinka";
            $encrypted_file = "uploads/encrypted_" . basename($_FILES["fileToUpload"]["name"]);
            $input_file = $target_file;
            $fp = fopen($input_file, 'rb');
            $contents = fread($fp, filesize($input_file));
            fclose($fp);
            $cipher = "aes-256-cbc";
            $ivlen = openssl_cipher_iv_length($cipher);
            $iv = openssl_random_pseudo_bytes($ivlen);
            $ciphertext = openssl_encrypt($contents, $cipher, $passphrase, $options=0, $iv);
            $output_file = fopen($encrypted_file, 'wb');
            fwrite($output_file, $iv);
            fwrite($output_file, $ciphertext);
            fclose($output_file);
            // Brisanje nekriptirane datoteke sa servera
            unlink($target_file);
            echo "<br> Datoteka je uspješno kriptirana i spremljena u " . $encrypted_file;
        } else {
            echo "GRESKA prilikom uploada datoteke.";
        }
    }
}

?>
</body>
</html>