  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="/image/admin_icon.png" alt="User Image">
          <div>
              <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
              <p class="app-sidebar__user-designation">{{ Auth::user()->role }}</p>
          </div>
      </div>
      <ul class="app-menu">
          <li>
              <a class="app-menu__item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}  "
                  href="/dashboard">
                  <i class="app-menu__icon bi bi-speedometer"></i>
                  <span class="app-menu__label">
                      Dashboard
                  </span>
              </a>
          </li>

          <li>
              <a class="app-menu__item {{ Route::currentRouteName() == 'notification.index' ? 'active' : '' }} "
                  href="/dashboard/notification"><i class="app-menu__icon bi bi-bell"></i><span
                      class="app-menu__label">Notification</span>
              </a>
          </li>

          <li>
              <a class="app-menu__item {{ Route::currentRouteName() == 'pesanan.index' || Route::currentRouteName() == 'pesanan.edit' ? 'active' : '' }} "
                  href="/dashboard/pesanan"><i class="app-menu__icon bi bi-cash-stack"></i><span
                      class="app-menu__label">Pesanan</span>
              </a>
          </li>


          <li class="treeview">
              <a class="app-menu__item {{ Route::currentRouteName() == 'menu.index' || Route::currentRouteName() == 'menu.edit' || Route::currentRouteName() == 'kategori.index' || Route::currentRouteName() == 'kategori.edit' ? 'active' : '' }}"
                  href="#" data-toggle="treeview">
                  <i class="app-menu__icon bi bi-cup"></i>
                  <span class="app-menu__label">Menu</span>
                  <i class="treeview-indicator bi bi-chevron-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li>
                      <a class="treeview-item" href="/dashboard/menu">
                          <i class="app-menu__icon bi bi-cup"></i>
                          Semua menu
                      </a>
                      <a class="treeview-item" href="/dashboard/kategori">
                          <i class="icon bi bi-list"></i> Kategori
                      </a>
                  </li>
              </ul>
          </li>

          <li>
              <a class="app-menu__item {{ Route::currentRouteName() == 'stokbarang.index' || Route::currentRouteName() == 'stokbarang.edit' ? 'active' : '' }} "
                  href="/dashboard/stokbarang"><i class="app-menu__icon bi bi-box"></i><span
                      class="app-menu__label">Stok Barang</span>
              </a>
          </li>

          <li class="treeview">
              <a class="app-menu__item {{ Route::currentRouteName() == 'laporantransaksi.index' || Route::currentRouteName() == 'laporantransaksi' || Route::currentRouteName() == 'menuharian' ? 'active' : '' }}"
                  href="#" data-toggle="treeview">
                  <i class="app-menu__icon bi-file-earmark-bar-graph"></i>
                  <span class="app-menu__label">Laporan</span>
                  <i class="treeview-indicator bi bi-chevron-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li>
                      <a class="treeview-item" href="/dashboard/menuharian">
                          <i class="app-menu__icon bi bi-cup"></i>
                          Penjualan Menu Harian
                      </a>
                  </li>
                  <li>
                      <a class="treeview-item" href="/dashboard/menumingguan">
                          <i class="app-menu__icon bi bi-cup"></i>
                          Penjualan Menu Mingguan
                      </a>
                  </li>
                  <li>
                      <a class="treeview-item" href="/dashboard/laporantransaksi">
                          <i class="app-menu__icon bi bi-cash"></i>
                          Penghasilan
                      </a>
                  </li>
              </ul>
          </li>

          @if (Auth::user()->role == 'superadmin')
              <li>
                  <a class="app-menu__item {{ Route::currentRouteName() == 'metode_pembayaran.index' || Route::currentRouteName() == 'metode_pembayaran.edit' ? 'active' : '' }} "
                      href="/dashboard/metode_pembayaran"><i class="app-menu__icon bi bi-cash"></i><span
                          class="app-menu__label">Metode Pembayaran</span>
                  </a>
              </li>
          @endif

          @if (Auth::user()->role == 'superadmin')
              <li>
                  <a class="app-menu__item {{ Route::currentRouteName() == 'manage_account.index' || Route::currentRouteName() == 'manage_account.edit' ? 'active' : '' }} "
                      href="/dashboard/manage_account"><i class="app-menu__icon bi bi-people"></i><span
                          class="app-menu__label">Manage Account</span>
                  </a>
              </li>
          @endif

          @if (Auth::user()->role == 'superadmin')
              <li class="treeview">
                  <a class="app-menu__item {{ Route::currentRouteName() == 'logs.index' ? 'active' : '' }}"
                      href="#" data-toggle="treeview">
                      <i class="app-menu__icon bi bi-gear"></i>
                      <span class="app-menu__label">Logs</span>
                      <i class="treeview-indicator bi bi-chevron-right"></i>
                  </a>
                  <ul class="treeview-menu">
                      <li>
                          <a class="treeview-item" href="/dashboard/logs">
                              <i class="app-menu__icon bi bi-gear"></i>
                              Semua Log CRUD
                          </a>
                      </li>
                      <li>
                          <a class="treeview-item" href="/dashboard/logcart">
                              <i class="app-menu__icon bi bi-cart"></i>
                              Log Cart
                          </a>
                      </li>
                      <li>
                          <a class="treeview-item" href="/dashboard/logorder">
                              <i class="app-menu__icon bi bi-file"></i>
                              Log Order
                          </a>
                      </li>
                      <li>
                        <a class="treeview-item" href="/dashboard/logakun">
                            <i class="app-menu__icon bi bi-people"></i>
                            Log Akun
                        </a>
                    </li>
                  </ul>
              </li>
          @endif

      </ul>
  </aside>
