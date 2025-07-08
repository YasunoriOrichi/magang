<?php
include '../../config/BaseController.php';
$controller = new BaseController();
$conn = getConnection();

$isEdit = false;

$inv = $_GET['inv'] ?? null;
$id = $_GET['id'] ?? null;
  if ($id != null) {
    $isEdit = true;
    $title = "Edit Item Invoice";
    $query = mysqli_query(
$conn, 
"SELECT * FROM invoice_detail
        JOIN item ON invoice_detail.ITEM = item.ID
        WHERE ID_DETAIL_ROW = '$id'");
    $detail = mysqli_fetch_assoc($query);

    $item_id         = $detail['ITEM'];
    $item_name       = $detail['NAME'];
    $qty             = $detail['QTY'];
    $unit_price      = $detail['UNIT_PRICE'];
    $inv             = $detail['ID_DETAIL'];
  } else {
    $title = "Tambah Item Invoice";
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wevelope | Detail Invoice Form</title>
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
      <?php require_once '../../component/navbar.php'?>

      <!-- SIDEBAR NAVIGATION -->
      <?php require_once '../../component/sidebar.php'?>

      <!-- MAIN CONTENT -->
      <main class="app-main">

        <!-- JUDUL / HEADER -->
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row mb-3">
              <div class="col-sm-6"><h3 class="mb-0"><?= $title ?></h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Invoice</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                </ol>
              </div>
            </div> <!--end::Row-->
            <?php require '../../component/notification.php'?>

        <!-- EDIT INVOICE -->
        <div class="container-fluid">
          <div class="row">
              <div class="card card-primary card-outline mb-4">
                <div class="card-header"><div class="card-title">Data Item Invoice</div></div>
                  <form action="<?= $isEdit ? $controller->updateDetailInvoice() : $controller->addDetailInvoice() ?>" method="POST">
                    <?php if ($isEdit): ?>
                      <input type="hidden" name="id" value="<?= $id ?>">
                    <?php endif; ?>
                    <div class="card-body">
                      <div class="row" id="items">
                      <!-- NAMA ITEM -->
                      <div class="mb-3">
                        <label for="item" class="form-label">Nama Item</label>
                        <select class="form-select" id="item" name="item" required="">
                          <option <?= $isEdit ? '' : 'selected' ?> disabled>Pilih item</option>
                          <?php
                            $query = mysqli_query($conn, "SELECT * FROM item");
                            while ($data = mysqli_fetch_assoc($query)): 
                              $selected = ($data['ID'] == $item_id) ? 'selected' : ''; ?>
                              <option value="<?= $data['ID'] ?>" <?= $selected ?>><?= $data['NAME'] ?></option>
                            <?php endwhile; ?>
                        </select>
                      </div>
                      <!-- JUMLAH ITEM -->
                      <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $qty ?? '' ?>" placeholder="Masukkan jumlah item..." required>
                      </div>
                      <!-- HARGA SATUAN -->
                      <div class="mb-3">
                        <label for="harga" class="form-label">Harga Satuan (Opsional)</label>
                        <input type="number" class="form-control" id="harga" name="harga" value="<?= $unit_price ?? '' ?>" placeholder="Masukkan harga item"> 
                      </div>
                    </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" name="inv" value="<?= $inv ?>" class="btn btn-primary">Submit</button>
                    </div> <!--end::Footer-->
                  </form> <!--end::Form-->
                </div> <!--end::Quick Example-->
              </div> <!--end::Col-->
            </div> <!--end::Row-->
            </div>
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
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>