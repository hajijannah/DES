<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $key = "abcdefgh";
    $iv = "12345678";

    if (isset($_POST["data"])) {
        $data = $_POST["data"];
        $encryptedData = des_encrypt($data, $key, $iv);
        
        // Menampilkan hasil enkripsi
        echo '<div style="text-align: center; margin-top: 20px; padding: 20px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.8); overflow-y: auto; max-height: 300px;">';
        echo '<h3 style="color: #3498db;">Hasil Enkripsi:</h3>';
        echo '<textarea id="encryptedResult" rows="10" cols="50">' . base64_encode($encryptedData) . '</textarea>';
        echo '</div>';
    } elseif (isset($_POST["encrypted_data"])) {
        $encryptedData = base64_decode($_POST["encrypted_data"]);
        $decryptedData = des_decrypt($encryptedData, $key, $iv);
        
        // Menampilkan hasil dekripsi
        echo '<div style="text-align: center; margin-top: 20px; padding: 20px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.8); overflow-y: auto; max-height: 300px;">';
        echo '<h3 style="color: #3498db;">Hasil Dekripsi:</h3>';
        echo '<textarea id="decryptedResult" rows="10" cols="50">' . $decryptedData . '</textarea>';
        echo '</div>';
    }

    // Tombol Kembali dan Tombol Copy disampingnya
    echo '<div style="text-align: center; margin-top: 20px;">
            <a href="index.html"><button style="background-color: #3498db; color: #ffffff; border: none; padding: 10px 20px; font-size: 18px; cursor: pointer;">Kembali</button></a>';
    
    // Tombol Copy disamping Tombol Kembali
    if (isset($_POST["data"])) {
        echo '<button onclick="copyText(\'encryptedResult\')">Copy</button>';
    } elseif (isset($_POST["encrypted_data"])) {
        echo '<button onclick="copyText(\'decryptedResult\')">Copy</button>';
    }
    
    echo '</div>';
}

function des_encrypt($data, $key, $iv) {
    return openssl_encrypt($data, 'DES-CBC', $key, 0, $iv);
}

function des_decrypt($data, $key, $iv) {
    return openssl_decrypt($data, 'DES-CBC', $key, 0, $iv);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Proses</title>
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url("naruto.jpg");
            background-size: cover;
            background-repeat: repeat;
            background-attachment: fixed;
            font-family: 'poppins';
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2 {
            font-size: 28px;
            margin-top: 30px;
        }

        label {
            display: block;
            font-size: 18px;
            margin-top: 20px;
        }

        textarea {
            width: 80%;
            padding: 20px;
            border: 1px solid #888888;
            background-color: #2d2d2d;
            color: #ffffff;
            font-size: 16px;
            margin-top: 10px;
        }

        textarea#encryptedResult,
        textarea#decryptedResult {
            height: 300px; /* Ubah tinggi sesuai kebutuhan */
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>

    <script>
        // Fungsi untuk menyalin teks ke clipboard
        function copyText(elementId) {
            const textToCopy = document.getElementById(elementId);
            const textArea = document.createElement("textarea");
            textArea.value = textToCopy.value;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy");
            document.body.removeChild(textArea);
            alert("Teks berhasil disalin!");
        }
    </script>
</head>

</html>
