      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <div class="sidebar-brand">
          <a href="../dashboard/index.php" class="brand-link">
            <img
              src="../../../dist/assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <span class="brand-text fw-light">Wevelope</span>
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
                  <i class="nav-icon bi bi-ui-checks-grid"></i>
                  <p>
                    Item
                  </p>
                  </a>
              </li>
              <!-- CUSTOMER -->
              <li class="nav-item <?= ($activePage == 'customer') ? 'menu-open' : '' ?>">
                <a href="../customer/customer.php" class="nav-link">
                  <i class="nav-icon bi bi-clipboard-fill"></i>
                  <p>
                    Customer
                  </p>
                </a>
              </li>
              <!-- SUPPLIER -->
              <li class="nav-item <?= ($activePage == 'supplier') ? 'menu-open' : '' ?>">
                <a href="../supplier/supplier.php" class="nav-link">
                  <i class="nav-icon bi bi-box-seam-fill"></i>
                  <p>
                    Supplier
                  </p>
                </a>
              </li>
              <!-- ITEM CUSTOMER -->
              <li class="nav-item <?= ($activePage == 'item customer') ? 'menu-open' : '' ?>">
                <a href="../itemCustomer/itemCustomer.php" class="nav-link">
                  <i class="nav-icon bi bi-pencil-square"></i>
                  <p>
                    Item Customer
                  </p>
                </a>
              </li>
              <!-- INVOICE -->
              <li class="nav-item <?= ($activePage == 'invoice') ? 'menu-open' : '' ?>">
                <a href="../invoice/invoice.php" class="nav-link">
                  <i class="nav-icon bi bi-filetype-js"></i>
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
            </ul>
          </nav>
        </div>
      </aside>