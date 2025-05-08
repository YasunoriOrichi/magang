      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="../dashboard/index.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="../../../dist/assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Wevelope</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
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
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->