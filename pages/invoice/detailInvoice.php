<?php
require_once '../../config/BaseController.php';
$controller = new BaseController();
$conn = getConnection();
$activePage = 'invoice'; // Set the active page for the sidebar
$id;

if (isset($_GET['inv'])) {
    $id = $_GET['inv'];
} else {
  echo "ID tidak ditemukan di URL.";
}

// COMPANY SETTING
$company = "SELECT * FROM setting WHERE COMPANY_ID = 1";
$company_result = $conn->query($company);
$company = $company_result->fetch_assoc();

// INVOICE
$invoice = "SELECT * FROM invoice
            JOIN customer ON invoice.CUSTOMER = customer.ID
            WHERE invoice.ID = '$id'";
$invoice_result = $conn->query($invoice);
if ($invoice_result->num_rows > 0) {
    $row = $invoice_result->fetch_assoc();
    $customer = $row['NAME'];  // Nama customer yang akan ditampilkan di form
    $invoice_no = $row['INVOICE_NO'];  // kode invoice yang akan ditampilkan di form
    $invoice_date = $row['DATE_INVOICE'];  // Tanggal invoice yang akan ditampilkan di form
    $note = $row['NOTE'];  // Keterangan invoice yang akan ditampilkan di form
    $terms = $row['TERMS'];  // Syarat dan ketentuan invoice yang akan ditampilkan di form
    $termsList = explode("\n", $terms); // Pecah berdasarkan baris
}

// CUSTOMER
$query = "SELECT * FROM customer WHERE ID = '$row[CUSTOMER]'";
$resultCustomer = $conn->query($query);
$client = mysqli_fetch_assoc($resultCustomer);

// DETAIL INVOICE
$detail = "SELECT * FROM invoice_detail
        JOIN item ON invoice_detail.ITEM = item.ID
        WHERE invoice_detail.ID_DETAIL = '$id'";
$detail_result = $conn->query($detail);
$details = [];

if ($detail_result->num_rows > 0) {
    while ($item_row = mysqli_fetch_assoc($detail_result)) {
        $details[] = [
            'id_detail_row' => $item_row['ID_DETAIL_ROW'],
            'id_detail' => $item_row['ID_DETAIL'],
            'item' => $item_row['NAME'],
            'unit_price' => $item_row['UNIT_PRICE'],
            'qty' => $item_row['QTY'],
            'total_price' => $item_row['TOTAL_PRICE']
        ];
    }
}

// PAYMENT
$payment = "SELECT SUM(PAID) AS PAYMENT FROM payment WHERE INVOICE_ID = '$id'";
$payment_result = $conn->query($payment);
$payment = $payment_result->fetch_assoc();
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
  <style>
    .logo-img {
      width: 120px;
      height: 120px; /* atau height: 100px jika ingin batas tinggi */
      object-fit: contain; /* biar tidak ketarik */
      margin-bottom: 20px;
    }

    .signature-img {
      width: 200px;
      height: 200; /* atau height: 100px jika ingin batas tinggi */
      object-fit: contain; /* biar tidak ketarik */
    }

    .line {
      border: none;
      height: 2px;
      background-color: black;
    }
  </style>

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
              <div class="col-sm-6"><h3 class="mb-0">Detail Invoice</h3></div>
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
                      <a name="id" href="<?= BASE_PATH . "/pages/invoice/invoice.php" ?>" class="btn btn-primary bi-arrow-left"> Kembali</a>
                    </div>
                  </div>
                  <!-- BODY -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <img src="<?= BASE_PATH . $company['COMPANY_LOGO'] ?>" class="logo-img" alt="Logo Perusahaan">
                      </div>
                      <div class="col-3 mt-4">
                        <div class="row">
                        <div class="col">
                          <label class="form-label">Referensi</label>
                          <label class="form-label">Tanggal</label>
                        </div>
                        <div class="col">
                        <label class="form-label">: <?= $invoice_no ?></label>
                        <label class="form-label">: <?= $invoice_date ?></label>
                        </div>
                        </div>
                      </div>
                    </div>

                    <div class="row mt-4">
                    <div class="col">
                        <label class="form-label"><b>Info Perusahaan</b></label>
                        <hr class="line">
                        <label class="form-label" style="color: blue"><?= strtoupper($company['COMPANY_NAME']) ?></label><br>
                        <label class="form-label">Alamat: <?= $company['COMPANY_ADDRESS'] ?></label><br>
                        <label class="form-label">No. Telp: <?= $company['COMPANY_PHONE'] ?></label><br>
                        <label class="form-label">E-mail: <?= $company['COMPANY_EMAIL'] ?></label>
                    </div>

                    <div class="col">
                        <label class="form-label"><b>Tagihan Untuk</b></label>
                        <hr class="line">
                        <label class="form-label" style="color: blue"><?= strtoupper($customer) ?></label><br>
                        <label class="form-label">No. Telp: <?= $client['NUMBER'] ?></label><br>
                        <label class="form-label">E-mail: <?= $client['EMAIL'] ?></label><br>
                    </div>
                    </div>
                    <a name="id" href="<?= $controller->formUpdateInvoice() . $id ?>" class="btn btn-primary bi-pencil-square"> Edit Info</a>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body" id="cetak">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 3%">No</th>
                          <th style="width: 15%;">Nama Item</th>
                          <th style="width: 10%;">Jumlah Item</th>
                          <th style="width: 17%">Harga Satuan</th>
                          <th style="width: 20%;">Total Harga</th>
                          <th style="width: 9%">Setting</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $no = 1; // Initialize row number
                          $total = 0; // Initialize total price

                          if (mysqli_num_rows($detail_result) > 0):
                            foreach ($details as $detail): ?>
                              <tr class='align-middle'>
                                <td><?= $no ?></td>
                                <td><?= $detail['item'] ?></td>
                                <td><?= $detail['qty'] ?></td>
                                <td>Rp<?= number_format($detail['unit_price'], 0, ',', '.') ?></td>
                                <td>Rp<?= number_format($detail['total_price'], 0, ',', '.') ?></td>
                                <td>
                                  <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle bi-gear" data-bs-toggle="dropdown" aria-expanded="false"> </a>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="<?= $controller->formUpdateDetailInvoice() . $detail['id_detail_row']?>">Edit</a></li>
                                      <li><a class="dropdown-item" href="<?= $controller->deleteDetailInvoice() . "&inv=" . $id . "&id=" . $detail['id_detail_row']?>" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')">Delete</a></li>
                                    </ul>
                                  </div>
                                  <!-- <a href="<?= $controller->formUpdateDetailInvoice() . $detail['id_detail_row']?>" class='btn btn-primary mb-2 bi-pencil'></a>
                                  <a href="<?= $controller->deleteDetailInvoice() . "&inv=" . $id . "&id=" . $detail['id_detail_row']?>" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')" class='btn btn-danger mb-2 bi-trash'></a> -->
                                </td>
                              </tr>
                            <?php 
                              $no++; // Increment row number
                              $total += $detail['total_price']; // Add to total price
                            endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan='4' class='text-center px-4 py-2'>Tidak ada data</td></tr>
                            <?php endif ?>
                            <tr>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row mt-3">
                    <div class="col mb-4">
                      <a name="id" href="<?= $controller->formAddDetailInvoice() . $id ?>" class="btn btn-primary bi-plus-circle"> Tambah Item</a>
                    </div>
                    <div class="col-3">
                      <div class="row">
                        <div class="col">
                          <label>Total</label><br>
                          <label>Dibayar</label><br>
                          <label>Tagihan</label>
                        </div>
                        <div class="col">
                          <label>: Rp<?= number_format($total, 0, ',', '.') ?></label><br>
                          <label>: Rp<?= number_format($payment['PAYMENT'], 0, ',', '.') ?></label><br>
                          <label>: Rp<?= number_format($total - $payment['PAYMENT'], 0, ',', '.') ?></label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-5">
                    <div class="col">
                      <div class="row mb-5">
                        <label><b>KETERANGAN:</b></label><hr class="line">
                        <label><?= $note != null ? $note : 'Tidak ada keterangan' ?></label>
                      </div>
                      <div class="row">
                        <label><b>SYARAT & KETENTUAN:</b></label><hr class="line">
                        <label>
                          <?php foreach ($termsList as $term): ?>
                            <li><?= $term != null ? htmlspecialchars(trim($term)) : 'Tidak ada syarat dan ketentuan' ?></li>
                          <?php endforeach; ?>
                        </label>
                      </div>
                    </div>
                    <div class="col">
                      <div class="row">
                        <div class="text-center">
                          <p><strong><?= $invoice_date ?></strong></p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="text-center">
                          <p><img class="signature-img" src="<?= $company['COMPANY_SIGNATURE'] ?>" alt="Tanda Tangan"></p>
                          <p><strong>Nevil Nurseri</strong></p>
                        </div>
                      </div>
                    </div>
                  </div>
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
