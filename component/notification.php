                <!-- begin::notifikasi berhasil / gagal -->
                <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] == 'used'): ?>
                        <div class="alert alert-danger" role="alert">
                            <b>WARNING!</b> Gagal menghapus data. Data sedang digunakan.
                        </div>
                    <?php elseif ($_GET['status'] == 'deleted'): ?>
                        <div class="alert alert-success" role="alert">
                            <b>SUCCESS!</b> Data berhasil dihapus!
                        </div>
                    <?php elseif ($_GET['status'] == 'error_delete'): ?>
                        <div class="alert alert-warning" role="alert">
                            <b>ERROR!</b> Terjadi kesalahan saat menghapus data.
                        </div>
                    <?php elseif ($_GET['status'] == 'error_add'): ?>
                        <div class="alert alert-warning" role="alert">
                            <b>ERROR!</b> Terjadi kesalahan saat menambahkan data baru.
                        </div>
                    <?php elseif ($_GET['status'] == 'invalid'): ?>
                        <div class="alert alert-warning" role="alert">
                            <b>INVALID!</b> Data tidak ditemukan.
                        </div>
                    <?php elseif ($_GET['status'] == 'added'): ?>
                        <div class="alert alert-warning" role="alert">
                            <b>SUCCESS!</b> Data berhasil ditambahkan!
                        </div>
                    <?php endif; ?>
                    <script>
                        // Setelah alert ditampilkan, redirect ke halaman yang sama tanpa query string
                        window.history.replaceState(null, null, window.location.pathname);
                    </script>
                <?php endif; ?>
                <!-- end::notifikasi berhasil / gagal -->