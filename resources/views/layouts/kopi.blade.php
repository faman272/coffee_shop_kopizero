
  <!-- MENU -->
  <section class="menu" id="menu">

      <h1 class="heading">our menu <span>popular menu</span></h1>


      <div class="box-container">

          @foreach ($menus->where('kategori_id', 1) as $menu)
              <a href="{{ url('detail') }}/{{ $menu->id_menu }}"  class="box">
                  <img src="{{ $menu->gambar }}" alt="">
                  <div class="content">
                      <h3>{{ $menu->nama_menu }}</h3>
                      <span style="color: rgba(68, 68, 51, 0.687)"><span class="material-symbols-outlined" style=" color : #d24545a7">
                        local_fire_department
                        </span> Hot Price :
                          {{ $menu->H_Hot === '0.00' ? '-' : str_replace('000', '', number_format($menu->H_Hot, 0, ',', 'k')) }}</span>
                      <br>
                      <span style="color: rgba(68, 68, 51, 0.687)"><span class="material-symbols-outlined" style="color: #7fc7d9b0">
                        ac_unit
                        </span> Ice Price :
                          {{ $menu->H_Ice === '0.00' ? '-' : str_replace('000', '', number_format($menu->H_Ice, 0, ',', 'k')) }}</span>

                  </div>
              </a>
          @endforeach



      </div>
  </section>
