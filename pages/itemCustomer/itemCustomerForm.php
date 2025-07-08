<?php
include '../../config/BaseController.php';
$controller = new BaseController();
$conn = getConnection();

$isEdit = false;
$customer_id = '';
$item_id = '';

$id = $_GET['id'] ?? null;
  if ($id != null) {
    $isEdit = true;
    $title = "Edit Item Customer";
    $sql = "SELECT 
            ic.ID,
            ic.REF_NO,
            ic.ITEM,
            ic.CUSTOMER,
            c.NAME AS customerName,
            i.NAME AS itemName,
            ic.PRICE
            FROM itemCustomer ic
            JOIN customer c ON ic.CUSTOMER = c.ID
            JOIN item i ON ic.ITEM = i.ID
            WHERE ic.ID = '$id'";
    $result = $conn->query($sql);

    // Cek apakah data ditemukan
    if ($result->num_rows > 0) {
        // Ambil data customer
        $row = $result->fetch_assoc();
        $id = $row['ID'];  // ID customer yang akan ditampilkan di form
        $customer_id = $row['CUSTOMER'];  // ID customer yang akan ditampilkan di form
        $customer = $row['customerName'];  // Nama customer yang akan ditampilkan di form
        $item_id = $row['ITEM'];
        $item = $row['itemName'];  // Nama item yang akan ditampilkan di form
        $price = $row['PRICE'];  // Harga item yang akan ditampilkan di form
        $ref_no = $row['REF_NO'];  // Nomor referensi customer yang akan ditampilkan di form

        $customer_query = mysqli_query($conn, "SELECT * FROM customer");
        $item_query = mysqli_query($conn, "SELECT * FROM item");
    } else {
        header("Location: itemCustomer.php");
        exit;
    }
  } else {
    $title = "Tambah Item Kustomer";
    $customer_query = mysqli_query($conn, "SELECT * FROM customer");
    $item_query = mysqli_query($conn, "SELECT * FROM item");

  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wevelope | Item Customer Form</title>
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
      <?php $activePage = 'item customer';
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
                <li class="breadcrumb-item"><a href="itemCustomer.php">Item Customer</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
              </ol>
            </div>
          </div> <!--end::Row-->
          <?php require_once '../../component/notification.php' ?>

          <!-- EDIT ITEM KUSTOMER -->
          <div class="container-fluid">
            <div class="row">
              <div class="card card-primary card-outline mb-4">
                <div class="card-header"><div class="card-title">Data Item Kustomer</div></div>
                  <form action="<?= $isEdit ? $controller->updateItemCustomer() : $controller->addItemCustomer() ?>" method="POST">
                    <!-- ID -->
                    <?php if ($isEdit): ?>
                      <input type="hidden" name="id" value="<?= $id ?>">
                    <?php endif; ?>
                    <div class="card-body">
                      <div class="mb-3">
                        <!-- KUSTOMER -->
                        <label for="kustomer" class="form-label">Nama Kustomer</label>
                        <select class="form-select" id="kustomer" name="kustomer" required>
                          <option value="" <?= $isEdit ? '' : 'selected' ?> disabled>Pilih kustomer</option>
                          <?php while ($data = mysqli_fetch_assoc($customer_query)): ?>
                            <option value="<?= $data['ID'] ?>" <?= ($data['ID'] == $customer_id) ? 'selected' : '' ?>>
                              <?= $data['NAME'] ?? 'Pilih kustomer' ?>
                            </option>
                          <?php endwhile; ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <!-- ITEM -->
                        <label for="item" class="form-label">Nama Item</label>
                        <select class="form-select" id="item" name="item" required>
                        <option value="" <?= $isEdit ? '' : 'selected' ?> disabled>Pilih item</option>
                          <?php while ($data = mysqli_fetch_assoc($item_query)): ?>
                            <option value="<?= $data['ID'] ?>" <?= ($data['ID'] == $item_id) ? 'selected' : '' ?>>
                              <?= $data['NAME'] ?? 'Pilih item' ?>
                            </option>
                          <?php endwhile; ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <!-- HARGA -->
                        <label for="harga" class="form-label">Harga Item (Opsional)</label>
                        <input type="number" id="harga" name="harga" value="<?= $price ?? '' ?>" placeholder="Contoh: 15000" class="form-control">
                      </div>
                      <div class="mb-3" <?= $isEdit ? '' : 'hidden' ?>>
                        <!-- NOMOR REFERAL -->
                        <label for="kode" class="form-label" >Kode Item Kustomer</label>
                        <input type="text" id="kode" name="kode" value="<?= $ref_no ?? '' ?>" placeholder="Contoh: Dwi Yudhistira" class="form-control" <?= $isEdit ? 'required' : '' ?>>
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" name="action" value= <?= $isEdit ? 'update' : 'add' ?> class="btn btn-primary">Submit</button>
                    </div> <!--end::Footer-->
                  </form> <!--end::Form-->
                </div> <!--end::Quick Example-->
              </div> <!--end::Col-->
            </div> <!--end::Row-->
          </div>
        </div>
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
