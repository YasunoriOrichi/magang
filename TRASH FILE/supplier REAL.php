<?php
// Include the database connection file
include '../connect.php';
// Fetch data from the database
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
          <a href="customer.php" class="hover:text-yellow-400">Customer</a>
          <a href="supplier.php" class="text-yellow-400">Supplier</a>
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
      <a href="customer.php" class="block py-2 px-4 rounded hover:bg-gray-700 hover:text-yellow-400">Customer</a>
      <a href="supplier.php" class="block py-2 px-4 rounded bg-gray-700 text-yellow-400">Supplier</a>
      <a href="itemCustomer.php" class="block py-2 px-4 rounded hover:bg-gray-700 hover:text-yellow-400">Item Customer</a>
    </nav>
  </aside>

  <!-- Main Content -->
  <div class="p-6 max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Kelola Supplier</h1>
  
    <!-- Form Tambah Item -->
    <div class="bg-gray-800 text-white rounded-xl shadow-md p-6 mb-8">
      <h2 class="text-lg font-semibold mb-4">Tambah Supplier Baru</h2>
      <form action="../function/addSupplier.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="nama" class="block mb-1 text-sm font-medium">Nama Supplier</label>
          <input type="text" id="nama" name="nama" placeholder="Contoh: Dwi Yudhistira"
            class="w-full px-12 py-2 rounded-md bg-gray-700 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
        </div>
        <div class="flex items-end">
          <button type="submit"
            class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-md w-full">Tambah</button>
        </div>
      </form>
    </div>
  
    <!-- Daftar Item -->
    <div class="bg-white rounded-xl shadow-md p-6">
      <h2 class="text-lg font-semibold mb-4 text-gray-800">Daftar Item</h2>
      <table class="table-auto w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">No Reff</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Edit</th>
            <th class="px-4 py-2">Hapus</th>
          </tr>
        </thead>
        <tbody>
        <?php
          // Fetch data from the database
          $query = "SELECT * FROM supplier";
          $result = mysqli_query($conn, $query);

          // Check if there are results
          if (mysqli_num_rows($result) > 0) {
              // Loop through the results and display them in the table
              while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr class='hover:bg-gray-100'>";
                  echo "<td class='px-4 py-2'>" . $row['ID'] . "</td>";
                  echo "<td class='px-4 py-2'>" . $row['REF_NO'] . "</td>";
                  echo "<td class='px-4 py-2'>" . $row['NAME'] . "</td>";
                  echo "<td>
                        <form action='supplierEdit.php' method='GET'>
                        <button type='submit' name='ID' value='" . $row['ID'] . "'
                            class='bg-blue-400 hover:bg-blue-500 text-black font-semibold px-2 py-1 rounded-md w-full'>
                            Edit
                        </button>
                        </form>
                        </td>";
                  echo "<td>
                        <form action='../function/deleteSupplier.php' method='GET'>
                        <button type='submit' name='ID' value='" . $row['ID'] . "'
                            class='bg-red-400 hover:bg-red-500 text-black font-semibold px-2 py-1 rounded-md w-full'>
                            Delete
                        </button>
                        </form>
                        </td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='5' class='text-center px-4 py-2'>Tidak ada data</td></tr>";
          }
          ?>
      </tbody>
      </table>
    </div>
  </div>
  </div>
  
</div>

</body>
</html>