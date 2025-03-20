<?php
require_once "app/Libraries/database.php";
require_once "app/Models/Model_mhs.php";
require_once "app/Controllers/Mahasiswa.php";

use Controllers\Mahasiswa;

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validasi ID

    if ($id) {
        $controller = new Mahasiswa();
        if ($controller->delete($id)) {
            header("Location: index.php?status=success");
            exit;
        } else {
            echo "Gagal menghapus data.";
            exit;
        }
    } else {
        echo "ID tidak valid.";
        exit;
    }
} else {
    echo "Tidak ada ID yang dikirim.";
    exit;
}