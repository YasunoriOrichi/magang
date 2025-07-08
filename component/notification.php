<?php

$alerts = [
    'used'           => ['type' => 'danger',  'title' => 'WARNING!', 'message' => 'Gagal menghapus data. Data sedang digunakan.'],
    'deleted'        => ['type' => 'success', 'title' => 'SUCCESS!', 'message' => 'Data berhasil dihapus!'],
    'error_delete'   => ['type' => 'danger',  'title' => 'ERROR!',   'message' => 'Terjadi kesalahan saat menghapus data.'],
    'error_add'      => ['type' => 'danger',  'title' => 'ERROR!',   'message' => 'Terjadi kesalahan saat menambahkan data baru.'],
    'invalid'        => ['type' => 'danger',  'title' => 'INVALID!', 'message' => 'Data tidak ditemukan.'],
    'added'          => ['type' => 'success', 'title' => 'SUCCESS!', 'message' => 'Data berhasil ditambahkan!'],
    'duplicate'      => ['type' => 'danger',  'title' => 'ERROR!',   'message' => 'Data sudah ada.'],
    'updated'        => ['type' => 'success', 'title' => 'SUCCESS!', 'message' => 'Data berhasil diperbarui!'],
    'imported'       => ['type' => 'success', 'title' => 'SUCCESS!', 'message' => 'Data berhasil diimport!'],
    'login_success'  => ['type' => 'success', 'title' => 'WELCOME!', 'message' => 'Selamat datang!'],
    'login_failed'   => ['type' => 'danger',  'title' => 'ERROR!',   'message' => 'Login gagal! Username atau password salah!'],
    'unregistered'   => ['type' => 'danger',  'title' => 'ERROR!',   'message' => 'E-mail tidak terdaftar!'],
    'timed_out'      => ['type' => 'danger',  'title' => 'TIMED OUT!',   'message' => 'Sesi anda telah berakhir! Silakan login kembali!'],
    'reset_success'  => ['type' => 'success', 'title' => 'SUCCESS!', 'message' => 'Password berhasil direset! Silakan login dengan password baru!'],
];

if (isset($_SESSION['alert']) && array_key_exists($_SESSION['alert'], $alerts)) :
    $alert = $alerts[$_SESSION['alert']];
    unset($_SESSION['alert']); // Hapus supaya tidak muncul saat refresh
?>
    <div class="alert alert-<?= $alert['type']; ?> alert-dismissible fade show" role="alert">
        <strong><?= $alert['title']; ?></strong> <?= $alert['message']; ?>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
    </div>
<?php endif; ?>
