<?php
// Include the database connection file
include '../../connect.php';
    // Ambil ID customer dari URL
    $id = $_GET['ID'];
    // Query untuk mengambil data customer berdasarkan ID
    $sql = "SELECT * FROM item WHERE ID = '$id'";
    $result = $conn->query($sql);

    // Cek apakah data ditemukan
    if ($result->num_rows > 0) {
        // Ambil data customer
        $row = $result->fetch_assoc();
        $id = $row['ID'];  // ID customer yang akan ditampilkan di form
        $nama = $row['NAME'];  // Nama customer yang akan ditampilkan di form
        $ref_no = $row['REF_NO'];  // Nomor referensi customer yang akan ditampilkan di form
        $harga = $row['PRICE'];  // Harga customer yang akan ditampilkan di form

    } else {
        echo "Customer tidak ditemukan.";
        echo "<script>window.location.href='item.php';</script>";
        exit;
    }
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
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="../dashboard/index.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="../../../dist/assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">AdminLTE 4</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item">
                <a href="../dashboard/index.php" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <!-- ITEM -->
              <li class="nav-item menu-open">
                <a href="../item/item.php" class="nav-link">
                  <i class="nav-icon bi bi-ui-checks-grid"></i>
                  <p>
                    Item
                  </p>
                </a>
              </li>
              <!-- CUSTOMER -->
              <li class="nav-item">
                <a href="../customer/customer.php" class="nav-link">
                  <i class="nav-icon bi bi-clipboard-fill"></i>
                  <p>
                    Customer
                  </p>
                </a>
              </li>
              <!-- SUPPLIER -->
              <li class="nav-item">
                <a href="../supplier/supplier.php" class="nav-link">
                <i class="nav-icon bi bi-box-seam-fill"></i>
                <p>
                    Supplier
                  </p>
                </a>
              </li>
              <!-- ITEM CUSTOMER -->
              <li class="nav-item">
                <a href="../itemCustomer/itemCustomer.php" class="nav-link">
                <i class="nav-icon bi bi-pencil-square"></i>
                <p>Item Customer</p>
                </a>
              </li>
              <!-- INVOICE -->
              <li class="nav-item">
                <a href="../invoice/invoice.php" class="nav-link">
                  <i class="nav-icon bi bi-filetype-js"></i>
                  <p>
                    Invoice
                  </p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
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
              <div class="col-sm-6"><h3 class="mb-0">Edit Item</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="item.php">Item</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Item</li>
                </ol>
              </div>
            </div> <!--end::Row-->
            <!-- begin::notifikasi berhasil / gagal -->
            <?php if (isset($_GET['status'])): ?>
              <?php if ($_GET['status'] == 'dipakai'): ?>
                  <div class="alert alert-danger" role="alert">
                      <b>ERROR NOTE: </b> Gagal mengubah data. Data sedang digunakan.
                  </div>
              <?php elseif ($_GET['status'] == 'berhasil'): ?>
                  <div class="alert alert-success" role="alert">
                      Data berhasil dihapus.
                  </div>
              <?php elseif ($_GET['status'] == 'error'): ?>
                  <div class="alert alert-warning" role="alert">
                      Terjadi kesalahan saat menghapus data.
                  </div>
              <?php elseif ($_GET['status'] == 'invalid'): ?>
                  <div class="alert alert-warning" role="alert">
                      ID tidak ditemukan.
                  </div>
              <?php endif; ?>
              <script>
                  // Setelah alert ditampilkan, redirect ke halaman yang sama tanpa query string
                  window.history.replaceState(null, null, window.location.pathname);
              </script>
          <?php endif; ?>
          <!-- end::notifikasi berhasil / gagal -->
          </div> <!--end::Container-->
        </div>
        <!--end::App Content Header-->

        <!-- EDIT ITEM -->
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
                  <div class="card-header"><div class="card-title">Edit Item</div></div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="../../function/item/updateItem.php" method="POST">
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="name" class="form-label">Nama Item</label>
                        <input type="text" id="nama" name="nama" value="<?= $row['NAME'] ?>" placeholder="Contoh: Dwi Yudhistira" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="name" class="form-label">Harga Item</label>
                        <input type="number" id="harga" name="harga" value="<?= $row['PRICE'] ?>" placeholder="Contoh: 15000" class="form-control">
                      </div>
                      <div class="mb-3">
                        <label for="kode" class="form-label">Kode Item</label>
                        <input type="text" id="kode" name="kode" value="<?= $ref_no ?>" placeholder="Contoh: Dwi Yudhistira" class="form-control">
                      </div>
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" name="id" value= <?= $row['ID'] ?> class="btn btn-primary">Submit</button>
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
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
