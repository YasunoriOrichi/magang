<?php
require_once '../../config/BaseController.php';
require_once '../../function/payment.php';
$controller = new BaseController();
$conn = getConnection();
$activePage = 'tunggakan';

// Ambil data filter dari GET
$keyword = $_GET['keyword'] ?? '';
$customer  = $_GET['customer']  ?? '';
$reset = $_GET['reset'] ?? '';

// Reset: kosongkan semua
if ($reset) {
  $keyword = '';
  $customer = '';
}

// Ambil daftar customer untuk selectbox
$customers = mysqli_query($conn, "SELECT * FROM customer");

$query = "SELECT 
              invoice.ID AS INVOICE_ID,
              customer.*,
              COUNT(invoice.CUSTOMER) AS INVOICE_COUNT,
              SUM(invoice_detail.TOTAL_PRICE) AS UNPAID,
              (
                  SELECT SUM(p2.PAID) AS TOTAL_PAID
                  FROM payment p2
                  WHERE p2.INVOICE_ID IN (
                      SELECT i2.ID FROM invoice i2 WHERE i2.CUSTOMER = customer.ID
                  )
              ) AS TOTAL_PAID
          FROM customer
          INNER JOIN invoice ON invoice.CUSTOMER = customer.ID
          LEFT JOIN invoice_detail ON invoice.ID = invoice_detail.ID_DETAIL
          WHERE 1=1"; // 1=1 untuk memudahkan penambahan kondisi

if ($keyword !== '') {
  $safeKeyword = mysqli_real_escape_string($conn, $keyword);
  $query .= " AND customer.NAME LIKE '%$safeKeyword%'";
}
if ($customer !== '') {
  $safeCustomer = (int)$customer;
  $query .= " AND customer.ID = '$safeCustomer'";
}

$query .= " GROUP BY customer.ID ORDER BY invoice.ID ASC";

$result = mysqli_query($conn, $query);
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
}

// 5. Pagination
// 5.1 Hitung total data
$per_page = 20; // Jumlah data per halaman
$total_data = count($rows);
$total_pages = ceil($total_data / $per_page);

// 5.2 Ambil halaman saat ini dari URL (?page=2), default ke 1
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($page, $total_pages)); // Biar aman

// 5.3 Hitung offset array
$start = ($page - 1) * $per_page;
$paginated_data = array_slice($rows, $start, $per_page);

?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wevelope | Payment</title>
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

        <div class="app-content-header">
          <div class="container-fluid">
            <!-- JUDUL / HEADER -->
            <div class="row mb-3">
              <div class="col-sm-6"><h3 class="mb-0">Tunggakan</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item active">Tunggakan</li>
                </ol>
              </div>
            </div>
            <!-- NOTIFICATION -->
            <?php include '../../component/notification.php'; ?>

              <!-- PENCARIAN -->
              <div class="card card-primary card-outline mb-4">
                <form method="GET">
                  <!-- BODY -->
                  <div class="card-body">
                    <div class="row">
                      <!-- KEYWORD -->
                      <div class="col-5">
                        <label for="keyword" class="form-label">Kata Kunci</label>
                        <input
                          type="search"
                          name="keyword"
                          class="form-control"
                          id="search"
                          value="<?= htmlspecialchars($keyword) ?>"
                          placeholder="Masukkan Kata Kunci..."/>
                      </div>
                      <div class="col-5">
                        <label for="customer" class="form-label">Nama Kustomer</label>
                        <select name="customer" class="form-select">
                          <option value="" <?= $customer == '' ? 'selected' : '' ?> > Pilih Kustomer </option>
                          <?php
                          while ($row = mysqli_fetch_assoc($customers)) {
                              $selected = ($customer == $row['ID']) ? 'selected' : '';
                              echo "<option value='" . $row['ID'] . "' $selected>" . htmlspecialchars($row['NAME']) . "</option>";
                          }
                          ?>
                        </select>
                      </div>
                      <input type="hidden" name="page" value="1"> <!-- 🔧 penting: reset ke page 1 -->
                      <!-- TOMBOL SEARCH -->
                      <div class="col-1">
                        <label class="form-label" style="color: white;">submit</label>
                        <button type="submit" class="btn btn-warning"> Search</button>
                      </div>
                      <!-- TOMBOL RESET -->
                      <div class="col-1">
                      <label class="form-label" style="color: white;">reset</label>
                        <button type="submit" name="reset" value="1" class="btn btn-secondary mb-2 "> Reset</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              
              <!-- /.card -->
              <div class="card mb-4">
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 5px">No</th>
                        <th>Nama Kostumer</th>
                        <th>Total Harus Dibayar</th>
                        <th>Total Sudah Dibayar</th>
                        <th>Sisa Tunggakan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if (count($paginated_data) > 0): $no = 1; ?>
                      <?php foreach ($paginated_data as $row): ?>
                        <tr class='align-middle'>
                          <td><?= $row['INVOICE_ID'] ?></td>
                          <td><?= $row['NAME'] ?></td>
                          <td>Rp <?= number_format($row['UNPAID'], 0, ',', '.') ?></td>
                          <td>Rp <?= number_format($row['TOTAL_PAID'], 0, ',', '.') ?></td>
                          <td>Rp <?= number_format($row['UNPAID'] - $row['TOTAL_PAID'], 0, ',', '.') ?></td>
                          <td>
                            <a href="<?= BASE_PATH . '/pages/tunggakan/detailTunggakan.php?id=' . $row['INVOICE_ID']?>" class="btn btn-primary bi-info-circle"></a>
                          </td>
                        </tr>
                      <?php $no++; endforeach; ?>
                    <?php else: ?>
                      <tr><td colspan='4' class='text-center px-4 py-2'>Tidak ada data</td></tr>
                    <?php endif; ?>
                    </tbody>
                  </table>
                </div> <!-- /.card-body -->
              <!-- CARD-FOOTER -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-end">

                <!-- Tombol Previous -->
                <?php if ($page > 1): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($keyword) ?>">«</a>
                  </li>
                <?php else: ?>
                  <li class="page-item disabled"><a class="page-link">«</a></li>
                <?php endif; ?>

                <!-- Nomor Halaman -->
                <?php
                  for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $page) {
                      echo "<li class='page-item active'><a class='page-link' href='#'>$i</a></li>";
                    } else {
                      echo "<li class='page-item'><a class='page-link' href='?page=$i&search=" . urlencode($keyword) . "'>$i</a></li>";
                    }
                  }
                ?>

                <!-- Tombol Next -->
                <?php if ($page < $total_pages): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($keyword) ?>">»</a>
                  </li>
                <?php else: ?>
                  <li class="page-item disabled"><a class="page-link">»</a></li>
                <?php endif; ?>

                </ul>
              </div> <!-- /.CARD-FOOTER -->
            </div> <!-- CARD -->
          </div> <!-- Container Fluid -->
        </div> <!-- App Content Header -->
      </main> <!--end::App Main-->
    </div> <!--end::App Wrapper-->
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
