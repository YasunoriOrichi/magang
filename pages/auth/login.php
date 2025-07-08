<?php
require_once __DIR__ . '/../../config/BaseController.php';
$controller = new BaseController();
$conn = getConnection();

$setting = "SELECT * FROM setting";
$result = $conn->query($setting);
$login = $result->fetch_assoc();

$auth = "SELECT * FROM account WHERE REMEMBER = 'true'";
if (mysqli_fetch_assoc(mysqli_query(getConnection(), $auth)) > 0) {
    $query = "SELECT * FROM account WHERE REMEMBER = 'true'"; // Reset previous remember me status
    $fetch = mysqli_fetch_assoc(mysqli_query(getConnection(), $query));
    $username = $fetch['USERNAME'];
    session_start();
    $_SESSION['username'] = $username;
    header("Location: " . $controller->index()); // Redirect to dashboard
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wevelope | Login</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE 4 | Login Page v2" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
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
    <!-- DECORATIVE -->
    <link rel="stylesheet" href="../../dist/css/auth.css" />
  </head>
  <body class="login-page bg-body-secondary">
    <div class="login-box">
      <?php require_once '../../component/notification.php'; ?> 
      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="#"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover"
          >
            <h1 class="mb-0"><?= $login['COMPANY_NAME'] ?></h1>
          </a>
        </div>
        <div class="card-body login-card-body">
          <p class="login-box-msg">log in to start your session</p>
          <form action="<?= $controller->login() ?>" method="post">
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="username" name="username" type="text" class="form-control" value="" placeholder="" required/>
                <label for="username">Nama pengguna</label>
              </div>
              <div class="input-group-text"><span class="bi bi-person-square"></span></div>
            </div>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="password" name="password" type="password" class="form-control mb-2" placeholder="" required/>
                <label for="password">Kata sandi</label>
              </div>
              <div class="input-group-text mb-1"><span class="bi bi-lock-fill"></span></div>
            </div>
            <div class="row">
              <div class="col">
                <div class="d-grid gap">
                  <button type="submit" class="btn btn-primary">log In</button>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col d-inline-flex align-items-center">
                <div>
                  <p class="mb-1">Lupa kata sandi? <a href="resetPassword.php">Reset password</a></p>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
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
</html>
