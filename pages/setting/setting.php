<?php
require_once '../../config/BaseController.php'; // Include file koneksi
$controller = new BaseController(); // Inisialisasi controller
$activePage = 'setting'; // Set active page for sidebar
$conn = getConnection(); // Koneksi ke database

$query = "SELECT * FROM setting";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>


<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wevelope | Pengaturan Perusahaan</title>
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
    <!-- CSS STYLE -->
    <style>
    .logo-img {
      width: 150px;
      height: 200; /* atau height: 100px jika ingin batas tinggi */
      object-fit: contain; /* biar tidak ketarik */
    }
    </style>
  </head>
  <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
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
              <div class="container-fluid">
              <?php include '../../component/notification.php'; ?>
              </div>
              <div class="col-sm-6"><h3 class="mb-0">Pengaturan Perusahaan</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item active" aria-current="page">Pengaturan Perusahaan</li>
                </ol>
              </div>
            </div>
            <!-- NOTIFICATION -->
            <?php include '../../component/notification.php'; ?>

            <div class="row">
              <div class="col">
                <!-- CARD -->
                <div class="card card-info mb-4">
                  <div class="card-header">
                    <h3 class="card-title">DETAIL PERUSAHAAN</h3>
                  </div>
                  <!-- BODY -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-4 mb-3">
                        <label for="kode" class="form-label">Nama Perusahaan</label>
                      </div>
                      <div class="col-4 mb-3">
                        <label for="name" class="form-label">: <?= $row['COMPANY_NAME'] ?></label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-4 mb-3">
                        <label class="form-label">Alamat</label>
                      </div>
                      <div class="col-4 mb-3">
                        <label class="form-label">: <?= $row['COMPANY_ADDRESS'] ?></label>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-4">
                        <label class="form-label">Nomor Telepon</label>
                      </div>
                      <div class="col-4 mb-3">
                        <label class="form-label">: <?= $row['COMPANY_PHONE'] ?></label>
                      </div>
                    </div> <!-- Table Row -->

                    <div class="row">
                      <div class="col-4">
                        <label class="form-label">E-mail</label>
                      </div>
                      <div class="col-4 mb-3">
                        <label class="form-label">: <?= $row['COMPANY_EMAIL'] ?></label>
                      </div>
                    </div> <!-- Table Row -->
                  </div> <!-- Card Header -->
                  <div class="card-footer text-end">
                    <a href="<?= $controller->formSettingDetail() ?>" class="btn btn-primary bi-pencil-square"> Edit</a>
                  </div>
                </div> <!-- Row-->
              </div>
              <div class="col">
              <!-- CARD -->
                <div class="card card-info mb-4">
                  <div class="card-header">
                    <h3 class="card-title">LOGO PERUSAHAAN</h3>
                  </div>
                  <!-- BODY -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-5 mb-3">
                        <label for="kode" class="form-label">Logo Perusahaan</label>
                        <img src="<?= $row['COMPANY_LOGO'] ?>" class="logo-img">
                      </div>
                      <div class="col-5 mb-3">
                        <label for="kode" class="form-label">Tanda Tangan Perusahaan</label>
                        <img src="<?= $row['COMPANY_SIGNATURE'] ?>" class="logo-img">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-end">
                  <a href="<?= $controller->formSettingLogo() ?>" class="btn btn-primary bi-pencil-square"> Edit</a>
                  </div>
                </div> <!-- Row-->
              </div>
            </div>
          </div> <!-- Container -->
        </div> <!-- App Content Header -->
      </main> <!-- App Main -->
    </div> <!-- APP WRAPPER -->

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
