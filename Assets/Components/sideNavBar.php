<head>
  <!-- Include FontAwesome stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <!-- Include your custom stylesheet -->
  <link rel="stylesheet" href="../CSS/sideNavBar.css" />

  <script>
    document.querySelector('.toggle-btn').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('expand');
    });
  </script>
</head>

<body>
  <div class="wrapper">
    <!-- side bar-->
    <aside id="sidebar">
      <div class="d-flex" style="font-size: 20px;">
        <button class="toggle-btn" type="button" style="font-size: 24px;">
          <i class="fas fa-bars fa-2x"></i>
        </button>
        <div class="sidebar-logo" style="font-size: 24px;">
          <a href="#">ByteForce</a>
        </div>
      </div>

      <!-- side bar navigation-->
      <ul class="sidebar-nav" style="font-size: 18px;">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link" style="font-size: 18px;">
            <i class="fas fa-tachometer-alt fa-2x"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a
            href="../Pages/item.php"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#item"
            aria-expanded="false"
            aria-controls="item"
            style="font-size: 18px;"
          >
            <i class="fas fa-box fa-2x"></i>
            <span>Items</span>
          </a>
          <ul
            id="item"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
            style="font-size: 18px;"
          >
            <li class="sidebar-item">
              <a href="../PHP/itemAdd.php" class="sidebar-link" style="font-size: 18px;">Items</a>
            </li>
          </ul>
        </li>

        <!-- category -->
        <li class="sidebar-item">
          <a
            href="../Pages/category.php"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#category"
            aria-expanded="false"
            aria-controls="category"
            style="font-size: 18px;"
          >
            <i class="fas fa-tags fa-2x"></i>
            <span>Categories</span>
          </a>
          <ul
            id="category"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
            style="font-size: 18px;"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">Category</a>
            </li>
          </ul>
        </li>

        <!-- supplier -->
        <li class="sidebar-item">
          <a
            href="../Pages/supplier.php"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#supplier"
            aria-expanded="false"
            aria-controls="supplier"
            style="font-size: 18px;"
          >
            <i class="fas fa-store fa-2x"></i>
            <span>Suppliers</span>
          </a>
          <ul
            id="supplier"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
            style="font-size: 18px;"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">Suppliers</a>
            </li>
          </ul>
        </li>

        <!-- customer -->
        <li class="sidebar-item">
          <a
            href="../Pages/customer.php"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#customer"
            aria-expanded="false"
            aria-controls="customer"
            style="font-size: 18px;"
          >
            <i class="fas fa-users fa-2x"></i>
            <span>Customer</span>
          </a>
          <ul
            id="customer"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
            style="font-size: 18px;"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">Customers</a>
            </li>
          </ul>
        </li>

        <!-- orders -->
        <li class="sidebar-item">
          <a
            href="../Pages/order.php"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#orders"
            aria-expanded="false"
            aria-controls="orders"
            style="font-size: 18px;"
          >
            <i class="fas fa-shopping-cart fa-2x"></i>
            <span>Orders</span>
          </a>
          <ul
            id="orders"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
            style="font-size: 18px;"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">Orders</a>
            </li>
          </ul>
        </li>

        <li class="sidebar-item">
          <a href="#" class="sidebar-link" style="font-size: 18px;">
            <i class="fas fa-cogs fa-2x"></i>
            <span>Settings</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer" style="font-size: 18px;">
        <a href="#" class="sidebar-link" style="font-size: 18px;">
          <i class="fas fa-sign-out-alt fa-2x"></i>
          <span>Logout</span>
        </a>
      </div>
    </aside>
  </div>
</body>
