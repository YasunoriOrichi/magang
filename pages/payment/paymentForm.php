<?php
include '../../config/BaseController.php';
$controller = new BaseController();
$conn = getConnection();

$isEdit = false;
$invoice_id = $_POST['inv'] ?? $_GET['inv'] ?? null;
$payment_id = $_GET['id'] ?? null;
if ($payment_id != null) {
    $payment_id = $_GET['id'];
    $isEdit = true;
    $title = "Edit Payment";

} else {
  $title = "Tambah Payment";
}

// Ambil data invoice
$query = "SELECT * FROM payment WHERE PAYMENT_ID = '$payment_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$unpaid = "SELECT
              SUM(TOTAL_PRICE) AS UNPAID
              FROM invoice_detail
              WHERE ID_DETAIL = '$invoice_id'";
$result = mysqli_query($conn, $unpaid);
$unpaid = mysqli_fetch_assoc($result);

$paid = "SELECT 
              SUM(PAID) AS TOTAL_PAID
              FROM payment
              WHERE INVOICE_ID = '$invoice_id'";
$result = mysqli_query($conn, $paid);
$paid = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wevelope | Payment Form</title>
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
  <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
      <?php require '../../component/navbar.php'?>

      <!-- SIDEBAR NAVIGATION -->
      <?php $activePage = 'payment';
      require '../../component/sidebar.php'?>

      <!-- MAIN CONTENT -->
      <main class="app-main">

        <!-- JUDUL / HEADER -->
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row mb-3">
              <div class="col-sm-6"><h3 class="mb-0"><?= $title ?></h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="invoice.php">Invoice</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                </ol>
              </div>
            </div> <!--end::Row-->
            <?php require '../../component/notification.php'?>

            <!-- EDIT INVOICE -->
            <div class="container-fluid">
              <div class="row">
                <div class="card card-primary card-outline mb-4">
                  <div class="card-header"><div class="card-title"><?= $title ?></div></div>
                  <?php if ($invoice_id == null): ?>
                  <form action="?" method="GET">
                    <div class="card-body">
                      <!-- NAMA KUSTOMER & INVOICE NO -->
                      <div class="mb-3">
                        <label for="invoice" class="form-label">Invoice</label>
                        <select class="form-select" id="invoice" name="inv" required>
                          <option value="" <?= $isEdit ? '' : 'selected' ?> disabled>Pilih invoice</option>
                          <?php
                            $query = mysqli_query($conn, "SELECT invoice.ID AS INVOICE_ID, invoice.INVOICE_NO, customer.ID AS CUSTOMER_ID, customer.NAME FROM invoice
                            JOIN customer ON invoice.CUSTOMER = customer.ID");
                            while ($data = mysqli_fetch_assoc($query)) : ?>
                              <option value="<?= $data['INVOICE_ID'] ?>"><?= $data['INVOICE_NO'] . " - " . $data['NAME'] ?></option>
                          <?php endwhile; ?>
                        </select>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div> <!--end::Footer-->
                  </form>
                  <?php else: ?>
                  <form action="<?= $isEdit ? $controller->updatePayment() . $payment_id : $controller->addPayment() . $invoice_id?>" method="POST">
                    <div class="card-body">
                      <!-- ID -->
                      <?php if ($isEdit): ?>
                        <input type="hidden" name="id" value="<?= $payment_id ?>">
                      <?php endif; ?>
                      <?php
                            $query = mysqli_query($conn, "SELECT * FROM payment
                            WHERE PAYMENT_ID = '$payment_id'");
                            $data = mysqli_fetch_assoc($query);?>
                      <!-- TANGGAL DIBUAT -->
                      <div class="mb-3">
                        <label for="date" class="form-label">Tanggal Pembayaran<b style="color: red">*</b></label>
                        <input type="date" class="form-control" id="date" name="date" value="<?= $data['PAYMENT_DATE'] ?? null ?>" required> 
                      </div>
                      <!-- PEMBAYARAN -->
                      <div class="mb-3">
                        <label for="paid" class="form-label">Nominal Pembayaran<b style="color: red">*</b></label>
                        <input type="number" class="form-control" id="paid" name="paid" placeholder="Masukkan nominal pembayaran" value="<?= $data['PAID'] ?? null ?>" required>
                        <label class="form-label">*Tagihan yang belum dibayar Rp<?= number_format($unpaid['UNPAID'] - $paid['TOTAL_PAID'], 0, ',', '.') ?></label> 
                      </div>
                      <!-- CATATAN -->
                       <div class="mb-3">
                        <label for="note" class="form-label">Catatan</label>
                        <textarea class="form-control" id="note" name="note" placeholder="Masukkan catatan..." rows="3"><?= $data['NOTE'] ?? null ?></textarea>
                       </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div> <!--end::Footer-->
                  </form> <!--end::Form-->
                  <?php endif; ?>
                </div> <!-- CARD -->
              </div> <!--end::Quick Example-->
            </div> <!--end::Col-->
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
</html>