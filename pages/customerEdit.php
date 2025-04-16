<?php
// Include the database connection file
include '../connect.php';
    // Ambil ID customer dari URL
    $id = $_GET['ID'];
    // Query untuk mengambil data customer berdasarkan ID
    $sql = "SELECT * FROM customer WHERE ID = '$id'";
    $result = $conn->query($sql);

    // Cek apakah data ditemukan
    if ($result->num_rows > 0) {
        // Ambil data customer
        $row = $result->fetch_assoc();
        $id = $row['ID'];  // ID customer yang akan ditampilkan di form
        $nama = $row['NAME'];  // Nama customer yang akan ditampilkan di form
        $ref_no = $row['REF_NO'];  // Nomor referensi customer yang akan ditampilkan di form

    } else {
        echo "Customer tidak ditemukan.";
        echo "<script>window.location.href='customer.php';</script>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Home</title>
</head>
<body class="bg-gray-100">

  <nav class="bg-gray-800 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <div class="flex items-center">
          <span class="text-xl font-bold">MyApp</span>
        </div>
        <div class="hidden md:flex space-x-6">
          <a href="index.php" class="hover:text-yellow-400">Dashboard</a>
          <a href="item.php" class="hover:text-yellow-400">Item</a>
          <a href="customer.php" class="text-yellow-400">Customer</a>
          <a href="supplier.php" class="hover:text-yellow-400">Supplier</a>
          <!-- Foto Profil -->
          <div class="relative">
            <img src="https://i.pravatar.cc/40?img=12" alt="Admin"
                class="w-8 h-8 rounded-full border-2 border-yellow-400 hover:scale-105 transition-transform duration-200">
          </div>
        </div>
        <div class="md:hidden">
          <!-- Hamburger -->
          <button id="menu-btn" class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>
    </nav>

  <!-- Sidebar -->
  <div class="flex">
  <aside id="sidebar" class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2 hidden md:block min-h-screen">
    <nav class="space-y-4">
      <a href="index.php" class="block py-2 px-4 rounded hover:bg-gray-700 hover:text-yellow-400">Dashboard</a>
      <a href="item.php" class="block py-2 px-4 rounded hover:bg-gray-700 hover:text-yellow-400">Item</a>
      <a href="customer.php" class="block py-2 px-4 rounded bg-gray-700 text-yellow-400">Customer</a>
      <a href="supplier.php" class="block py-2 px-4 rounded hover:bg-gray-700 hover:text-yellow-400">Supplier</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="p-6 max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Kustomer</h1>

        <!-- Data Kustomer Sebelumnya -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
      <h2 class="text-lg font-semibold mb-4 text-gray-800">Data Kustomer Sebelumnya</h2>
      <table class="table-auto w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">No Reff</th>
            <th class="px-4 py-2">Nama</th>
          </tr>
        </thead>
        <tbody>
          <th class="px-4 py-2"><?= $id ?></th>
          <th class="px-4 py-2"><?= $ref_no ?></th>
          <th class="px-4 py-2"><?= $nama ?></th>
        </tbody>
      </table>
    </div>
  
    <!-- Form Tambah Item -->
    <div class="bg-gray-800 text-white rounded-xl shadow-md p-6">
      <h2 class="text-lg font-semibold mb-4">Perbarui Data Kustomer</h2>
      <form action="../function/updateCustomer.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="nama" class="block mb-1 text-sm font-medium">Nama Kustomer yang Baru</label>
          <input type="text" id="nama" name="nama" placeholder="Contoh: Dwi Yudhistira"
            class="w-full px-12 py-2 rounded-md bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div class="flex items-end">
          <button type="submit" name="id" value= <?= $row['ID'] ?>
            class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-md w-full">Perbarui</button>
        </div>
      </form>
    </div>
  </div>
  </div>
</div>
</body>
</html>