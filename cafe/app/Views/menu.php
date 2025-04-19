<?php
// Ambil data pengaturan dari database
$db = db_connect();
$pengaturan = $db->table('pengaturan_app')->get()->getRow();
$level = session()->get('level'); // Ambil level user dari session
?>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
               <!-- <a href="index.html" --> <a class="app-brand-link">
           
                <span style="color: var(--bs-primary)">
             <a href="<?= base_url() ?>" class="app-brand-link gap-3">
    <img src="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" 
         alt="Logo" 
         style="max-height: 50px;"/>
       </a>


                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
                      fill="currentColor" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z"
                      fill="black" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z"
                      fill="black" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
                      fill="currentColor" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z"
                      fill="black" />
                    <path
                      opacity="0.077704"
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z"
                      fill="black" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                      fill="currentColor" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
                      fill="white"
                      fill-opacity="0.15" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                      fill="currentColor" />
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
                      fill="white"
                      fill-opacity="0.3" />
                  </svg>
                </span>
              </span>
                  <span class="app-brand-text demo text-heading fw-semibold"><?= esc($pengaturan->judul ?? 'Home') ?></span>
            </a>

            <!-- <a href="javascript:void(0);" --> <a class="layout-menu-toggle menu-link text-large ms-auto">
       
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <a href="<?=base_url('home/dashboard')?>"
                class="menu-link">
                <i class="ri-home-2-fill"></i>
                <div data-i18n="Dashboard">Dashboard</div>
              </a>
            </li>

            <!-- Layouts -->
              <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3): ?>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ri-layout-2-line"></i>
                <div data-i18n="Layouts">Data Master</div>
              </a>
               <?php endif; ?>

              <ul class="menu-sub">
                 <?php if (session()->get('level') == 1 || session()->get('level') == 3): ?>
                <a href="<?=base_url('home/tabel_user')?>" class="menu-link">
                 <i class="ri-user-line"></i>
                 <div data-i18n="Without menu">User</div>
               </a>
             </li>
             <?php endif; ?>

              <?php if (session()->get('level') == 1 || session()->get('level') == 3): ?>
               <a href="<?=base_url('home/tabel_kasir')?>" class="menu-link">
                <i class="ri-user-star-line"></i>
                <div data-i18n="Without navbar">Kasir</div>
              </a>
            </li>
             <?php endif; ?>

              <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3): ?>
                <a href="<?=base_url('home/tabel_kategori')?>" class="menu-link">
                <i class="ri-archive-stack-fill"></i>
                <div data-i18n="Without navbar"> Kategori</div>
              </a>
            </li>
              <?php endif; ?>

                  <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3): ?>
                <a href="<?=base_url('home/tabel_barang')?>" class="menu-link">
                <i class="ri-archive-stack-fill"></i>
                <div data-i18n="Without navbar"> Barang</div>
              </a>
            </li>
              <?php endif; ?>
            <!--  <a href="<?=base_url('home/tabel_barang1')?>"
              class="menu-link">
             <i class="ri-receipt-line"></i>
              <div data-i18n="Dashboard">Barang</div>
             </a>
          </li> -->
          <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3): ?>
              <a href="<?=base_url('home/tabel_nota')?>"
              class="menu-link">
             <i class="ri-receipt-line"></i>
              <div data-i18n="Dashboard">Nota</div>
             </a>
          </li>
            <?php endif; ?>

            <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3): ?>
            <a href="<?=base_url('home/tabel_pemesanan')?>"
            class="menu-link">
          <i class="ri-list-ordered-2"></i>
              <div data-i18n="Dashboard">Pemesanan</div>
          </a>
        </li>
         <?php endif; ?>
      </ul>

               <ul class="menu-item">
                  <a href="<?=base_url('home/menu_barang')?>" class="menu-link">
                   <i class="ri-restaurant-fill"></i>
                    <div data-i18n="Without menu">Menu</div>
                  </a>
               <ul class="menu-item">
                  <a href="<?=base_url('home/pemesanan')?>" class="menu-link">
                    <i class="ri-list-ordered"></i>
                    <div data-i18n="Without menu">Pemesanan</div>
                  </a>
                  <?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3): ?>
              <ul class="menu-item">
                  <a href="<?=base_url('home/laporan_keuangan')?>" class="menu-link">
                     <i class="ri-file-chart-line"></i>
                    <div data-i18n="Without menu">Laporan</div>
                  </a>
                   <?php endif; ?>

<?php if (session()->get('level') == 1 || session()->get('level') == 2 || session()->get('level') == 3 || session()->get('level') == 4): ?>
                   <ul class="menu-item">
                  <a href="<?=base_url('home/log_activity')?>" class="menu-link">
                    <i class="ri-eye-2-line"></i>
                    <div data-i18n="Without menu">Log Activity</div>
                  </a>
                </li>
                 <?php endif; ?>

                   <?php if (session()->get('level') == 3): ?>
                   <ul class="menu-item">
                  <a href="<?=base_url('home/pengaturan')?>" class="menu-link">
                   <i class="ri-settings-5-fill"></i>
                    <div data-i18n="Without menu">Pengaturan</div>
                  </a>
                </li>
                 <?php endif; ?>

        
            
            <!-- Tables -->
          </ul>
        </aside>
        <!-- / Menu -->
                <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <!-- / Navbar -->
                  <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="ri-menu-fill ri-24px"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="ri-search-line ri-22px me-2"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..." />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="<?=base_url('assets/img/avatars/1.png')?>" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0 me-2">
                            <div class="avatar avatar-online">
                              <img src="<?=base_url('assets/img/avatars/1.png')?>" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-0 small">John Doe</h6>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="ri-user-3-line ri-22px me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="ri-settings-4-line ri-22px me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 ri-file-text-line ri-22px me-3"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span
                            class="flex-shrink-0 badge badge-center rounded-pill bg-danger h-px-20 d-flex align-items-center justify-content-center"
                            >4</span
                          >
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <div class="d-grid px-4 pt-2 pb-1">
                        <a class="btn btn-danger d-flex" href="<?=base_url('home/logout')?>" >
                          <small class="align-middle">Logout</small>
                          <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>