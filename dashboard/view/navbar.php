    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars" style="color: #8d078e;"></i>
                    </button>

                 

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                       
                        <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo ucwords($_SESSION['juFullname']); ?></span>
                                
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                               
                                <a class="dropdown-item" href="?p=settings">
                                    <i class="fa fa-cog fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?p=logout">
                                    <i class="fa fa-sign-out fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>