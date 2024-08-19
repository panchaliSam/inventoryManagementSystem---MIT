<head>
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
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
          <i class="lni lni-grid-alt" style="font-size: 24px;"></i>
        </button>
        <div class="sidebar-logo" style="font-size: 24px;">
          <a href="#">ByteForce</a>
        </div>
      </div>

      <!-- side bar navigation-->
      <ul class="sidebar-nav" style="font-size: 18px;">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link" style="font-size: 18px;">
            <i class="lni lni-user" style="font-size: 20px;"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a
            href="#"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#item"
            aria-expanded="false"
            aria-controls="item"
            style="font-size: 18px;"
          >
            <i class="lni lni-protection" style="font-size: 20px;"></i>
            <span>Items</span>
          </a>
          <ul
            id="item"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
            style="font-size: 18px;"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">Add Item</a>
            </li>
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">View Items</a>
            </li>
          </ul>
        </li>

        <!-- category -->
        <li class="sidebar-item">
          <a
            href="#"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#category"
            aria-expanded="false"
            aria-controls="category"
            style="font-size: 18px;"
          >
            <i class="lni lni-protection" style="font-size: 20px;"></i>
            <span>Categories</span>
          </a>
          <ul
            id="category"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
            style="font-size: 18px;"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">Manage Category</a>
            </li>
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">View Category</a>
            </li>
          </ul>
        </li>

        <!-- supplier -->
        <li class="sidebar-item">
          <a
            href="#"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#suplier"
            aria-expanded="false"
            aria-controls="suplier"
            style="font-size: 18px;"
          >
            <i class="lni lni-protection" style="font-size: 20px;"></i>
            <span>Suppliers</span>
          </a>
          <ul
            id="suplier"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
            style="font-size: 18px;"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">Add Supplier</a>
            </li>
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">View Supplier</a>
            </li>
          </ul>
        </li>

        <!-- customer -->
        <li class="sidebar-item">
          <a
            href="#"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#customer"
            aria-expanded="false"
            aria-controls="customer"
            style="font-size: 18px;"
          >
            <i class="lni lni-protection" style="font-size: 20px;"></i>
            <span>Customer</span>
          </a>
          <ul
            id="customer"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
            style="font-size: 18px;"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">Add Customer</a>
            </li>
            <li class="sidebar-item">
              <a href="#" class="sidebar-link" style="font-size: 18px;">View Customer</a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link" style="font-size: 18px;">
            <i class="lni lni-cog" style="font-size: 20px;"></i>
            <span>Settings</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer" style="font-size: 18px;">
        <a href="#" class="sidebar-link" style="font-size: 18px;">
          <i class="lni lni-exit" style="font-size: 20px;"></i>
          <span>Logout</span>
        </a>
      </div>
    </aside>
  </div>
</body>