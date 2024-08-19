<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
    crossorigin="anonymous"
  />
  <link rel="stylesheet" href="../CSS/sideNavBar.css" />
</head>

<body>
  <div class="wrapper">
    <!-- side bar-->
    <aside id="sidebar">
      <div class="d-flex">
        <button class="toggle-btn" type="button">
          <i class="lni lni-grid-alt"></i>
        </button>
        <div class="sidebar-logo">
          <a href="#">ByteForce</a>
        </div>
      </div>

      <!-- side bar nabigation-->
      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="lni lni-user"></i>
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
          >
            <i class="lni lni-protection"></i>
            <span>Items</span>
          </a>
          <ul
            id="item"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">Add Item</a>
            </li>
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">View Items</a>
            </li>
          </ul>
        </li>

        <!--category-->
        <li class="sidebar-item">
          <a
            href="#"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#category"
            aria-expanded="false"
            aria-controls="category"
          >
            <i class="lni lni-protection"></i>
            <span>Categories</span>
          </a>
          <ul
            id="category"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">Manage Category</a>
            </li>
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">View Category</a>
            </li>
          </ul>
        </li>

        <!--suplier -->
        <li class="sidebar-item">
          <a
            href="#"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#suplier"
            aria-expanded="false"
            aria-controls="suplier"
          >
            <i class="lni lni-protection"></i>
            <span>Supliers</span>
          </a>
          <ul
            id="suplier"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">Add Suplier</a>
            </li>
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">View Suplier</a>
            </li>
          </ul>
        </li>

        <!--customer-->
        <li class="sidebar-item">
          <a
            href="#"
            class="sidebar-link collapsed has-dropdown"
            data-bs-toggle="collapse"
            data-bs-target="#customer"
            aria-expanded="false"
            aria-controls="customer"
          >
            <i class="lni lni-protection"></i>
            <span>Customer</span>
          </a>
          <ul
            id="customer"
            class="sidebar-dropdown list-unstyled collapse"
            data-bs-parent="#sidebar"
          >
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">Add Customer</a>
            </li>
            <li class="sidebar-item">
              <a href="#" class="sidebar-link">View Customer</a>
            </li>
          </ul>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">
            <i class="lni lni-cog"></i>
            <span>Settings</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
          <i class="lni lni-exit"></i>
          <span>Logout</span>
        </a>
      </div>
    </aside>
  </div>
</body>
