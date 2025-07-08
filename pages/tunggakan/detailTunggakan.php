<?php
require_once '../../config/BaseController.php';
$controller = new BaseController();
$conn = getConnection();
$activePage = 'tunggakan'; // Set the active page for the sidebar
$id;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
  echo "ID tidak ditemukan di URL.";
}

// Query untuk mendapatkan data invoice berdasarkan ID
$payment = "SELECT * FROM payment WHERE payment.INVOICE_ID = '$id'";
$payment = $conn->query($payment);

$invoice = "SELECT * FROM invoice
            INNER JOIN customer ON invoice.CUSTOMER = customer.ID
            WHERE invoice.ID = '$id'";
$invoice = $conn->query($invoice);
$invoice = mysqli_fetch_assoc($invoice);
?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wevelope | Detail Invoice</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../../../dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
  </head>
  <body class="layout-fixed sidebar-expand-lg sidebar-mini sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
      <!-- NAVIGATION BAR -->
      <?php require '../../component/navbar.php'?>

      <!-- SIDEBAR NAVIGATION -->
      <?php require '../../component/sidebar.php';?>

      <!-- MAIN CONTENT -->
      <main class="app-main">

        <!-- JUDUL / HEADER -->
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row mb-3">
              <div class="col-sm-6"><h3 class="mb-0">Detail Tunggakan</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="invoice.php">Invoice</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail Invoice</li>
                </ol>
              </div>
            </div> <!--end::Row-->
            <?php require_once '../../component/notification.php' ?>

            <!-- TABEL INVOICE -->
            <div class="container-fluid">
              <div class="row">
                <div class="card card-primary card-outline mb-4">
                  <div class="card-header">
                    <div class="card-title">
                      <a name="id" href="<?= BASE_PATH . "/pages/tunggakan/tunggakan.php" ?>" class="btn btn-primary bi-arrow-left"> Kembali</a>
                    </div>
                  </div>
                  <!-- BODY -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-2 mb-3">
                        <label class="form-label">Nama Kustomer</label>
                      </div>
                      <div class="col-3 mb-3">
                        <label class="form-label">: <?= $invoice['NAME']?></label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-2 mb-3">
                        <label for="kode" class="form-label">Kode Invoice</label>
                      </div>
                      <div class="col-3 mb-3">
                        <label for="name" class="form-label">: <?= $invoice['INVOICE_NO'] ?></label>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body" id="cetak">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 3%">No</th>
                          <th style="width: 15%;">Invoice</th>
                          <th style="width: 10%;">Dibayar</th>
                          <th style="width: 17%">Tanggal Pembayaran</th>
                          <th style="width: 20%;">Catatan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $no = 1; // Initialize row number
                          $total = 0; // Initialize total price

                          if (mysqli_num_rows($payment) > 0):
                            foreach ($payment as $payments): ?>
                              <tr class='align-middle'>
                                <td><?= $no ?></td>
                                <td><?= $invoice['INVOICE_NO'] ?></td>
                                <td>Rp<?= number_format($payments['PAID'], 0, ',', '.') ?></td>
                                <td><?= $payments['PAYMENT_DATE'] ?></td>
                                <td><?= $payments['NOTE']?></td>
                              </tr>
                            <?php 
                              $no++; // Increment row number
                            endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan='4' class='text-center px-4 py-2'>Tidak ada data</td></tr>
                            <?php endif ?>
                    </tbody>
                  </table>
                </div> <!-- /.col -->
              </div> <!--end::Quick Example-->
            </div>
          </div> <!--end::Row-->
        </div> <!--end::Container-->
      </main> <!--end::App Main-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../../../dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
