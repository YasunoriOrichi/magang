<?php
require_once '../config/BaseController.php';

$action = $_GET['action'] ?? null;

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

class Auth {
    private $conn;

    public function __construct() {
        // Include database connection
        $this->conn = getConnection();
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function login($username, $password) {
        $controller = new BaseController();
        $query = "SELECT * FROM account WHERE USERNAME = '$username' AND PASSWORD = '$password'";
        $result = mysqli_query($this->conn, $query);
        if (mysqli_fetch_assoc($result) > 0 ) {
            $query = "UPDATE account SET REMEMBER = 'true' WHERE USERNAME = '$username'";
            mysqli_query($this->conn, $query); // Update remember me status
            
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['alert'] = 'login_success'; // Set session alert for success message  
            header("Location: " . $controller->index()); // Redirect to dashboard
        } else {
            $_SESSION['alert'] = 'login_failed'; // Set session alert for failure message
            header("Location: " . $controller->formLogin()); // Redirect to login page
        }
    }

    public function logout() {
        session_destroy();
        $query = "UPDATE account SET REMEMBER = 'false' WHERE REMEMBER = 'true'"; // Reset previous remember me status
        mysqli_query($this->conn, $query); // Reset previous remember me status
        $controller = new BaseController();
        header("Location: " . $controller->formLogin()); // Redirect to login page
    }

    public function verifyCode() {
        $controller = new BaseController();
        $token = $_GET['token'] ?? null;
        $query = mysqli_query($this->conn, "SELECT * FROM account WHERE RESET_TOKEN = '$token'");

        if (mysqli_num_rows($query) == 0) {
            echo "Link tidak valid atau sudah kadaluarsa.";
        } else {
            header("Location: " . $controller->formResetPassword() . "?vrf=2"); // Redirect to reset password form
        }        
    }

    public function resetPasword() {
        $controller = new BaseController();
        $newPassword = $_POST['new_password'];
        $email = $_SESSION['email_reset'];

        // Update password in the database
        $query = "UPDATE account SET PASSWORD = '$newPassword' WHERE EMAIL = '$email'";
        if (mysqli_query($this->conn, $query)) {
            $_SESSION['alert'] = 'reset_success'; // Set session alert for success message
            header("Location: " . $controller->formLogin()); // Redirect to login page
        } else {
            echo "Gagal mereset password: " . mysqli_error($this->conn);
        }
    }
}

$auth = new Auth();
if ($action == 'login') {
    $auth->login($username, $password);
} elseif ($action == 'logout') {
    $auth->logout();
} elseif ($action == 'verifyCode') {
    $auth->verifyCode();
} elseif ($action == 'resetPassword') {
    $auth->resetPasword();
} else {
    echo "Aksi tidak dikenali.";
}

?>