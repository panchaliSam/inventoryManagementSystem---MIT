
        <!-- side bar-->
        <aside id="sidebar">
            <div class="d-flex" >
                <button class="toggle-btn" type="button"  style="font-size: 24px;">
                <img src="images/electroKeep_favicon.png" alt="Toggle Icon"style="margin-left: -8px; padding-left: 0; width: 50px; height: auto;">
                </button>
                <div class="sidebar-logo">
                    <a href="index.html">ByteForce</a>
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
 

                <!--products-->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#item" aria-expanded="false" aria-controls="item">
                        <i class="fas fa-box fa-2x"></i>
                        <span>Items</span>
                    </a>
                    <ul id="item" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="addItem.php" class="sidebar-link">Add Item</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="viewItems.php" class="sidebar-link">View Items</a>
                        </li>
                    </ul>
                </li>

                <!--category-->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#category" aria-expanded="false" aria-controls="category">
                        <i class="lni lni-friendly"></i>
                        <span>Categories</span>
                    </a>
                    <ul id="category" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="addCategory.php" class="sidebar-link">Manage Category</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="viewCategory.php" class="sidebar-link">View Category</a>
                        </li>
                    </ul>
                </li>


                <!--suplier -->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#suplier" aria-expanded="false" aria-controls="suplier">
                        <i class="fas fa-store fa-2x"></i>
                        <span>Supliers</span>
                    </a>
                    <ul id="suplier" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="addSupplier.php" class="sidebar-link">Add Suplier</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="viewSupplier.php" class="sidebar-link">View Suplier</a>
                        </li>
                    </ul>
                </li>

                <!--customer-->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#customer" aria-expanded="false" aria-controls="customer">
                        <i class="fas fa-users fa-2x"></i>
                        <span>Customer</span>
                    </a>
                    <ul id="customer" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="addCustomer.php" class="sidebar-link">Add Customer</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="viewCustomer.php" class="sidebar-link">View Customer</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item ">
                    <a href="#" class="sidebar-link">
                    <i class="fa-solid fa-layer-group"></i>
                        <span>Brand</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                        <span>Orders</span>
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


