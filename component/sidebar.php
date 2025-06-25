<?php
$query = "SELECT * FROM setting";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
          <a href="../dashboard/index.php" class="brand-link">
            <img
              src="<?= BASE_PATH . $row['COMPANY_LOGO'] ?>"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <span class="brand-text fw-light"><?= $row['COMPANY_NAME'] ?></span>
          </a>
        </div>
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item <?= ($activePage == 'dashboard') ? 'menu-open' : '' ?>">
                <a href="../dashboard/index.php" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <!-- ITEM -->
              <li class="nav-item <?= ($activePage == 'item') ? 'menu-open' : '' ?>">
                <a href="../item/item.php" class="nav-link">
                  <i class="nav-icon bi bi-box-seam"></i>
                  <p>
                    Item
                  </p>
                  </a>
              </li>
              <!-- CUSTOMER -->
              <li class="nav-item <?= ($activePage == 'customer') ? 'menu-open' : '' ?>">
                <a href="../customer/customer.php" class="nav-link">
                  <i class="nav-icon bi bi-person-fill"></i>
                  <p>
                    Customer
                  </p>
                </a>
              </li>
              <!-- SUPPLIER -->
              <li class="nav-item <?= ($activePage == 'supplier') ? 'menu-open' : '' ?>">
                <a href="../supplier/supplier.php" class="nav-link">
                  <i class="nav-icon bi bi-truck"></i>
                  <p>
                    Supplier
                  </p>
                </a>
              </li>
              <!-- ITEM CUSTOMER -->
              <li class="nav-item <?= ($activePage == 'item customer') ? 'menu-open' : '' ?>">
                <a href="../itemCustomer/itemCustomer.php" class="nav-link">
                  <i class="nav-icon bi bi-clipboard"></i>
                  <p>
                    Item Customer
                  </p>
                </a>
              </li>
              <!-- INVOICE -->
              <li class="nav-item <?= ($activePage == 'invoice') ? 'menu-open' : '' ?>">
                <a href="../invoice/invoice.php" class="nav-link">
                  <i class="nav-icon bi bi-file-earmark-text"></i>
                  <p>
                    Invoice
                  </p>
                </a>
              </li>
              <!-- OMSET -->
              <li class="nav-item <?= ($activePage == 'omset') ? 'menu-open' : '' ?>">
                <a href="../omset/omset.php" class="nav-link">
                  <i class="nav-icon bi bi-cash-stack"></i>
                  <p>
                    Omset
                  </p>
                </a>
              </li>
              <!-- BEST SELLER -->
              <li class="nav-item <?= ($activePage == 'best seller') ? 'menu-open' : '' ?>">
                <a href="../bestSeller/bestSeller.php" class="nav-link">
                  <i class="nav-icon bi bi-fire"></i>
                  <p>
                    Best Seller
                  </p>
                </a>
              </li>
              <!-- PAYMENT -->
              <li class="nav-item <?= ($activePage == 'payment') ? 'menu-open' : '' ?>">
                <a href="../payment/payment.php" class="nav-link">
                  <i class="nav-icon bi bi-credit-card"></i>
                  <p>
                    Payment
                  </p>
                </a>
              </li>
              <!-- TUNGGAKAN -->
              <li class="nav-item <?= ($activePage == 'tunggakan') ? 'menu-open' : '' ?>">
                <a href="../tunggakan/tunggakan.php" class="nav-link">
                  <i class="nav-icon bi bi-calendar"></i>
                  <p>
                    Tunggakan
                  </p>
                </a>
              </li>
              <!-- SETTING -->
              <li class="nav-item <?= ($activePage == 'setting') ? 'menu-open' : '' ?>">
                <a href="../setting/setting.php" class="nav-link">
                  <i class="nav-icon bi bi-building-gear"></i>
                  <p>
                    Profil Perusahaan
                  </p>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </aside>