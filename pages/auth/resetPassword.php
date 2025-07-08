<?php
require_once '../../config/BaseController.php';
$controller = new BaseController();
$conn = getConnection();

$verify = $_GET['vrf'] ?? null;
$token = $_GET['token'] ?? null;

$query = "SELECT * FROM setting";
$result = $conn->query($query);
$login = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Wevelope | Forgot Password</title>
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
    <!-- DECORATICE -->
    <link rel="stylesheet" href="../../dist/css/auth.css" />
  </head>
  <body class="login-page bg-body-secondary">
    <div class="login-box">

      <?php require_once '../../component/notification.php'; ?>

      <div class="card card-outline card-primary">
        <div class="card-header">
          <a
            href="#"
            class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
            <h1 class="mb-0"><?= $login['COMPANY_NAME'] ?></h1>
          </a>
        </div>

        <?php if ($verify == null && $token == null): ?>

        <form action="<?= $controller->emailVerify() ?>" method="POST">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Masukkan alamat email yang anda gunakan untuk mendaftar</p>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="email" name="email" type="email" class="form-control mb-2" value="" placeholder="" <?= $verify == null ? '' : 'required' ?>/>
                <label for="email">E-mail</label>
              </div>
              <div class="input-group-text mb-2"><span class="bi bi-person-square"></span></div>
            </div>
            <div class="row">
              <div class="col">
                <a href="login.php" type="submit" class="btn btn-primary bi-arrow-left"> Kembali</a>
              </div>
              <div class="col text-end">
                <button type="submit" class="btn btn-primary text-start">Kirim</button>
              </div>
            </div>
          </div>
        </form>

        <?php elseif ($verify == '1'): ?>

        <form action="<?= $controller->verifyCode() ?>" method="POST">
          <div class="card-body login-card-body">
            <p class="login-box-msg mb-4">Kami telah mengirim link untuk merubah kata sandi anda. Silahkan cek E-mail Anda!</p>
            <div class="row mb">
              <div class="col">
                <a href="resetPassword.php" type="submit" class="btn btn-primary bi-arrow-left"> Kembali</a>
              </div>
              <!-- <div class="col text-end">
                <a href="https://mail.google.com/mail/u/0/#inbox" class="btn btn-primary bi-arrow-left"> Periksa</a>
              </div> -->
              <div class="col text-end">
                <a href="https://mailtrap.io/inboxes/3861576/messages/4973160114" target="_blank" class="btn btn-primary bi-envelope"> Periksa</a>
              </div>
            </div>
          </div>
        </form>

        <?php elseif ($token != null): ?>

        <form action="<?= $controller->resetPassword() ?>" method="POST">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Masukkan kata sandi baru anda</p>
            <div class="input-group mb-1">
              <div class="form-floating">
                <input id="new_password" name="new_password" type="password" class="form-control" value="" placeholder="" <?= $verify == '1' ? 'required' : '' ?>/>
                <label for="new_password">Password baru</label>
              </div>
              <div class="input-group-text"><span class="bi bi-lock"></span></div>
            </div>
            <div class="row">
              <div class="col">
                <a href="#" type="submit" class="btn btn-primary bi-arrow-left"> Kembali</a>
              </div>
              <div class="col text-end">
                <button type="submit" class="btn btn-primary text-start">Ubah sandi</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <?php endif; ?>

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
