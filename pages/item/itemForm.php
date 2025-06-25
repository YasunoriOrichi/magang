<?php
require_once '../../config/BaseController.php';
$controller = new BaseController();
$conn = getConnection();
$id = $_GET['id'] ?? null;
$isEdit = false;

if ($id != null) {
    $title = "Edit Item";
    $isEdit = true;
    $sql = "SELECT * FROM item WHERE ID = '$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();    
  } else {
    $title = "Tambah Item";
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wevelope | Item Form</title>
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

      <!-- NAVIGATION BAR -->
      <?php require '../../component/navbar.php'?>

      <!-- SIDEBAR NAVIGATION -->
      <?php $activePage = 'item';
      require '../../component/sidebar.php'?>

      <!-- MAIN CONTENT -->
      <main class="app-main">

        <!-- JUDUL / HEADER -->
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row mb-3">
              <div class="col-sm-6"><h3 class="mb-0">Item</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="item.php">Item</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                </ol>
              </div>
            </div> <!--end::Row-->
            <?php require '../../component/notification.php'?>

        <!-- FORM ITEM -->
        <div class="container-fluid">
          <div class="row">
            <div class="card card-primary card-outline mb-4">
              <!-- HEADER -->
              <div class="card-header">
                <div class="card-title">
                  <?= $title ?>
                </div>
              </div>
              <!-- BODY -->
              <form action="<?= $isEdit ? $controller->updateItem() : $controller->addItem() ?>" method="POST">
              <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= $id ?>">
              <?php endif; ?>
                <div class="card-body">
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama Item</label>
                    <input type="text" id="nama" name="nama" value="<?= $row['NAME'] ?? '' ?>" placeholder="Contoh: Dwi Yudhistira" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label for="harga" class="form-label">Harga Item</label>
                    <input type="number" id="harga" name="harga" value="<?= $row['PRICE'] ?? '' ?>" placeholder="Contoh: 15000" class="form-control" required>
                  </div>
                  <div class="mb-3" <?= $isEdit ? '' : 'hidden' ?>>
                    <label for="kode" class="form-label">Kode Item</label>
                    <input type="text" id="kode" name="kode" value="<?= $row['REF_NO'] ?? '' ?>" placeholder="Contoh: Dwi Yudhistira"
                      class="form-control" <?= $isEdit ? 'required' : '' ?>>
                  </div>
                </div>
                <!-- FOOTER -->
                <div class="card-footer">
                <button type="submit" name="action" value="<?= $isEdit ? 'update' : 'add' ?>" class="btn btn-primary">Submit</button>
                </div> <!--END FOOTER-->
              </form> <!--end::Form-->
            </div> <!--end::Quick Example-->
          </div> <!--end::Row-->
        </div> <!--end::Container-->
        </div>
        </div>
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
