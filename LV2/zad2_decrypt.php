<?php
$dir = "uploads/";
$file_list = scandir($dir);
$types = array("jpg", "png", "pdf");
echo "Linkovi za preuzimanje datoteka: <br>";

foreach($file_list as $file_name){
    if(strpos($file_name, "encrypted_") === 0) {
        // Dekriptiranje datoteke 
        $encrypted_file = $dir . $file_name;
        $decrypted_file = $dir . str_replace("encrypted_", "decrypted_", $file_name);
        $file_content = file_get_contents($encrypted_file);
        $iv = substr($file_content, 0, openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted_data = substr($file_content, openssl_cipher_iv_length('aes-256-cbc'));
        $key = md5('kljuc');
        $decrypted_data = openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

        file_put_contents($decrypted_file, $decrypted_data);

        $file_type = strtolower(pathinfo($decrypted_file, PATHINFO_EXTENSION));
        if(in_array($file_type, $types)) {
            echo "<a href='" . $decrypted_file . "'>" . $decrypted_file . "</a><br>";
        }
    }
}
?>
