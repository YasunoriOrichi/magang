<?php
// Include the database connection file
include '../../connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<script>alert('ID tidak ditemukan.'); window.location.href='invoice.php';</script>";
    exit;
}

// Ambil data invoice
$invoice = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT * FROM invoice 
    JOIN customer ON invoice.CUSTOMER = customer.ID
    WHERE invoice.ID = '$id'
"));

// Pastikan data ditemukan
if (!$invoice === 0) {
    header("Location: invoice.php");
    exit;
}

$customer_id     = $invoice['CUSTOMER'];
$invoice_no      = $invoice['INVOICE_NO'];
$invoice_date    = $invoice['DATE_INVOICE'];
?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Sidebar Mini</title>
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
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg sidebar-mini sidebar-collapse bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <?php require '../../component/navbar.php'?>
      <!--end::Header-->

      <!-- SIDEBAR NAVIGATION -->
      <!--begin::Sidebar-->
      <?php $activePage = 'invoice';
      require '../../component/sidebar.php'?>
      <!--end::Sidebar-->

      <!-- MAIN CONTENT -->
      <!--begin::App Main-->
      <main class="app-main">

        <!-- JUDUL / HEADER -->
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Edit Invoice</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="invoice.php">Invoice</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Invoice</li>
                </ol>
              </div>
            </div> <!--end::Row-->
          </div> <!--end::Container-->
        </div>
        <!--end::App Content Header-->

        <!-- EDIT INVOICE -->
        <!--begin::App Content-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row g-0">
              <!--begin::Col-->
              <div class="col-12">
              </div>
              <!--end::Col-->
              <!--begin::Col-->
              <div class="px-5">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Header-->
                  <div class="card-header"><div class="card-title">Edit Invoice</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="../../function/invoice/updateInvoice.php" method="POST">
                    <?php if ($isEdit): ?>
                      <input type="hidden" name="id_detail" value="<?= $id_detail_row ?>">
                    <?php endif; ?>
                    <div class="card-body">
                      <!-- KODE INVOICE -->
                      <div class="mb-3">
                        <label for="customer" class="form-label">Kode Invoice</label>
                        <input type="text" class="form-control" id="invoice_no" name="invoice_no" value="<?= $invoice_no ?>" placeholder="Masukkan kode invoice..." required="">
                      </div>
                      <!-- NAMA KUSTOMER -->
                      <div class="mb-3">
                        <label for="customer" class="form-label">Nama Kustomer</label>
                        <select class="form-select" id="kustomer" name="kustomer" required="">
                          <option selected="" disabled="" value="" hidden>Pilih kustomer</option>
                          <?php
                            $query = mysqli_query($conn, "SELECT * FROM customer");
                            while ($data = mysqli_fetch_assoc($query)) {
                              $selected = ($data['ID'] == $customer_id) ? 'selected' : '';
                              echo "<option value='" . $data['ID'] . "' $selected>" . $data['NAME'] . "</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <!-- TANGGAL DIBUAT -->
                      <div class="mb-3">
                        <label for="customer" class="form-label">Tanggal Dibuat</label>
                        <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="<?= $invoice_date ?>" required=""> 
                      </div>
                    </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" name="id" value="<?= $id ?>" class="btn btn-primary">Submit</button>
                    </div> <!--end::Footer-->
                  </form> <!--end::Form-->
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

    <script>
  function addItem() {
    const item = document.createElement('div');
    item.className = 'row mb-3';
    item.innerHTML = `
    <div class="row" id="items">
      <div class="col-3 mb-3">
        <select class="form-select" name="item[]" required="">
          <option selected="" disabled="" value="">Pilih nama item</option>
          <?php
            $query = mysqli_query($conn, "SELECT * FROM item");
            while ($data = mysqli_fetch_assoc($query)) {
              echo "<option value='" . $data['ID'] . "'>" . $data['NAME'] . "</option>";
            }
          ?>
        </select>
        </div>
      <div class="col-3">
        <input type="number" name="jumlah[]" placeholder="Contoh: 10" class="form-control">
      </div>
      <div class="col-3">
        <input type="number" name="harga[]" placeholder="Kosongkan untuk harga default" class="form-control">
      </div>
      <div class="col-3">
        <a href="#" onclick="removeItem(this)">- Hapus Item</a>
      </div>
    </div>
    `;
    document.getElementById('items').appendChild(item);
  }

  function removeItem(button) {
    const itemRow = button.closest('.row');
    itemRow.remove();
  }
    </script>

    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>