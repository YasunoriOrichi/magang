<?php
include '../../connect.php';
$activePage = 'supplier'; // Set active page untuk sidebar

$keyword = $_GET['search'] ?? '';
$reset = $_GET['reset'] ?? '';

if ($reset) {
  $keyword = '';
}

$safeKeyword = mysqli_real_escape_string($conn, $keyword);
$whereClause = ($keyword !== '') ? "WHERE NAME LIKE '%$safeKeyword%'" : '';

// Ambil semua hasil pencarian tanpa pagination
$data = mysqli_query($conn, "SELECT * FROM supplier $whereClause");

// Konversi hasil ke array untuk dikirim ke JavaScript
$rows = [];
while ($row = mysqli_fetch_assoc($data)) {
    $rows[] = $row;
}

// 5. Pagination
// 5.1 Hitung total data
$per_page = 5; // Jumlah data per halaman
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
      <?php require '../../component/sidebar.php';?>
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
              <div class="col-sm-6"><h3 class="mb-0">Supplier</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item active" aria-current="page">Supplier</li>
                </ol>
              </div>
            </div> <!--end::Row-->
            <?php include '../../component/notification.php'; ?>
          </div> <!--end::Container-->
        </div>
        <!--end::App Content Header-->

        <!-- TABEL DATA -->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="px-5">

                <!-- PENCARIAN -->
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                  <!--begin::Form-->
                  <form method="GET">
                    <!--begin::Body-->
                    <div class="card-body">
                    <label for="exampleInputEmail1" class="form-label">Pencarian</label>
                    <div class="row">
                      <div class="col-10 mb-3">
                        <input
                          type="search"
                          name="search"
                          class="form-control"
                          id="search"
                          value="<?= htmlspecialchars($keyword) ?>"
                          placeholder="Masukkan Nama Item..."/>
                      </div>
                      <div class="col-1">
                        <button type="submit" class="btn btn-warning mb-3"> Search</button>
                        </div><div class="col-1">
                        <button type="submit" name="reset" value="1" class="btn btn-secondary mb-2 "> Reset</button>
                      </div>
                    </div>
                    </div>
                    <!--end::Body-->
                  </form>
                  <!--end::Form-->
                </div>
                <!--end::Quick Example-->
              
                <!-- /.card -->
                <div class="card mb-4">
                  <div class="card-header">
                  <button type="button" name="id" onclick="window.location.href='supplierAdd.php'" class="btn btn-primary bi-plus-lg"> Tambah</button>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 5%">#</th>
                          <th style="width: 15%">Kode Supplier</th>
                          <th >Nama Supplier</th>
                          <th style="width: 14%">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        if (count($paginated_data) > 0) {
                          foreach ($paginated_data as $row) {
                              echo "<tr class='align-middle'>";
                                echo "<td>" . $row['ID'] . "</td>";
                                echo "<td><div><div style='width: 50%'>" . $row['REF_NO'] . "</div></div></td>";
                                echo "<td>" . $row['NAME'] . "</td>";
                                echo "<td>
                                      <form action='supplierEdit.php' method='GET' style='display:inline-block; margin-right: 1px;'>
                                      <button type='submit' name='id' value='" . $row['ID'] . "' class='btn btn-primary bi-pencil'></button>
                                      </form>
                                      <form action='../../function/supplier/deleteSupplier.php' method='GET' style='display:inline-block; margin-right: 1px;'>
                                      <button onclick=\"return confirm('Apakah kamu yakin ingin menghapus data ini?')\" type='submit' name='ID' value='" . $row['ID'] . "' class='btn btn-danger bi-trash'></button>
                                      </form>
                                     </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center px-4 py-2'>Tidak ada data</td></tr>";
                        }
                        ?>
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
                  </div>
                  <!-- /.CARD-FOOTER -->
                </div> <!-- /.card -->
              </div> <!-- /.col -->
            </div> <!--end::Row-->
          </div> <!--end::Container-->
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
