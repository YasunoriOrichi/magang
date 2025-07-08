<?php
require_once '../../config/BaseController.php';
$controller = new BaseController();
$conn = getConnection();

$query = "SELECT * FROM setting WHERE COMPANY_ID = '1'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wevelope | Customer Form</title>
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
      <?php $activePage = 'setting';
      require '../../component/sidebar.php'?>

      <!-- MAIN CONTENT -->
      <main class="app-main">

        <!-- JUDUL / HEADER -->
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row mb-3">
              <div class="col-sm-6"><h3 class="mb-0">Edit Logo dan Tanda Tangan</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="setting.php">Pengaturan Perusahaan</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Form Pengaturan Perusahaan</li>
                </ol>
              </div>
            </div> <!--end::Row-->
            <?php require '../../component/notification.php'?>

            <?php if ($_GET['action'] == 'detail'): ?>
            <!-- FORM DETAIL -->
            <div class="container-fluid">
              <div class="row">
                <div class="card card-primary card-outline mb-4">
                  <div class="card-header"><div class="card-title">Form Pengaturan Perusahaan</div></div>
                  <form action="<?= $controller->updateSetting('detail') ?>" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="card-body">
                        <div class="mb-3 ">
                            <label for="company" class="form-label">Nama Perusahaan</label><br>
                            <input type="text" name="company" class="form-control" value="<?= $row['COMPANY_NAME'] ?>" placeholder="Masukkan Nama Perusahaan" required>
                        </div>
                        <div class="mb-3 ">
                            <label for="address" class="form-label">Alamat Perusahaan</label><br>
                            <input type="text" name="address" class="form-control" value="<?= $row['COMPANY_ADDRESS'] ?>" placeholder="Masukkan Alamat Perusahaan" required>
                        </div>
                        <div class="mb-3 ">
                            <label for="phone" class="form-label">Nomor Perusahaan</label><br>
                            <input type="number" name="phone" class="form-control" value="<?= $row['COMPANY_PHONE'] ?>" placeholder="Masukkan Nomor Perusahaan" require>
                        </div>
                        <div class="mb-3 ">
                            <label for="email" class="form-label">E-mail Perusahaan</label><br>
                            <input type="email" name="email" class="form-control" value="<?= $row['COMPANY_EMAIL'] ?>" placeholder="masukkan E-mail Perusahaan" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Logo</button>
                    </div>
                  </form> <!--end::Form-->
                </div> <!-- CARD -->
              </div>
            </div>

            <?php elseif ($_GET['action'] == 'logo'): ?>
            <!-- FORM LOGO -->
            <div class="container-fluid">
              <div class="row">
                <div class="card card-primary card-outline mb-4">
                  <div class="card-header"><div class="card-title">Form Pengaturan Perusahaan</div></div>
                  <form action="<?= $controller->updateSetting('logo') ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="card-body">
                        <div class="mb-3 ">
                            <label for="logo" class="form-label">Upload Logo Perusahaan:</label><br>
                            <input type="file" name="logo" accept="image/*" class="form-control" required>
                            <h6>Disarankan: 500 x 500</h6>
                        </div>
                        <div class="mb-3 ">
                            <label for="signature" class="form-label">Upload Tanda Tangan:</label><br>
                            <input type="file" name="signature" accept="image/*" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Simpan Logo</button>
                    </div>
                  </form> <!--end::Form-->
                </div> <!-- CARD -->
              </div>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </main> <!--end::App Main-->
    </div>
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
