<?php
// Fungsi untuk membersihkan input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Periksa apakah ada data yang dikirimkan dari formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean input dari form
    $nama = clean_input($_POST['nama']);
    $email = clean_input($_POST['email']);
    $pesan = clean_input($_POST['pesan']);

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email tidak valid");
    }

    // Alamat email tujuan (ganti dengan alamat email yang ingin menerima pesan)
    $tujuan = "ceunahteuing@gmail.com";

    // Subjek email
    $subjek = "Pesan dari Formulir Kontak";

    // Isi pesan email
    $isi_pesan = "Nama: $nama\n\n";
    $isi_pesan .= "Email: $email\n\n";
    $isi_pesan .= "Pesan:\n$pesan\n";

    // Header email
    $header = "From: $email";

    // Kirim email
    if (mail($tujuan, $subjek, $isi_pesan, $header)) {
        // Jika email berhasil dikirim, arahkan pengguna ke URL tertentu
        header("Location: https://lmydblog.blogspot.com/p/thank-you.html");
        exit;
    } else {
        echo "<p>Maaf, terjadi kesalahan saat mengirim pesan.</p>";
    }
} else {
    // Jika bukan metode POST, mungkin ada yang mencoba mengakses langsung file ini
    echo "<p>Halaman ini tidak dapat diakses langsung.</p>";
}
?>
