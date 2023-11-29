@include('admin.layouts.main')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-desktop"></i> Detail Order</h1>
            <p>Detail Order KopiZero</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ Route('pesanan.index') }}">Pesanan</a></li>
            <li class="breadcrumb-item"><a href="#">Detail Order</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <b>Detail Order</b>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Status</b></label>
                        <div class="col-sm-10">
                            Saat Ini : <b>{{ $order->status }}</b><br><br>

                            <form method="POST" action="{{ Route('pesanan.update', $order->no_order) }}">
                                @csrf
                                @method('PUT')
                                <select class="form-control" id="status" name="status" required="required">
                                    <option value="{{ $order->status }}" selected disabled="true">{{ $order->status }}
                                    </option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Diterima">Diterima</option>
                                </select>
                                <input type="hidden" name="user_id" value="{{ $order->user_id }}">
                                <br>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>

                    <hr>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Tgl Order</b></label>
                        <div class="col-sm-10">
                            <b>{{ date('d M Y H:i', strtotime($order->tgl_order)) }}</b>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><b>No Order</b></label>
                        <div class="col-sm-10">
                            <b>#{{ $order->no_order }}</b>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Daftar Menu</b></label>
                        <div class="col-sm-10">
                            <table class="table table-borderless">
                                <tr>
                                    <th class="text-center">
                                        Menu
                                    </th>
                                    <th class="text-center">
                                        Harga
                                    </th>
                                    <th class="text-center">
                                        Qty
                                    </th>
                                    <th class="text-center">
                                        Subtotal
                                    </th>
                                </tr>

                                @foreach ($order->detail_orders as $detailOrder)
                                    <tr>
                                        <td class="text-center">
                                            {{ $detailOrder->menus->nama_menu }}
                                        </td>
                                        <td class="text-center">
                                            Rp. {{ number_format($detailOrder->harga, 0, ',', '.') }}
                                            ({{ $detailOrder->jenis_harga }})
                                        </td>
                                        <td class="text-center">
                                            {{ $detailOrder->qty }}
                                        </td>
                                        <td class="text-center">
                                            Rp. {{ number_format($detailOrder->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach

                            </table>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Total Harga</b></label>
                        <div class="col-sm-10">
                            Rp. {{ number_format($order->pembayarans->total_pembayaran, 0, ',', '.') }}
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Informasi Pembayaraan</b></label>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-10">
                                {{ $order->user->name }}
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">No Hp</label>
                            <div class="col-sm-10">
                                {{ $order->user->no_telp }}
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">No Meja</label>
                            <div class="col-sm-10">
                                {{ $order->nomor_meja }}
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Catatan</label>
                            <div class="col-sm-10">
                                {{ $order->catatan }}
                            </div>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label"><b>Total Pembayaran</b></label>
                            <div class="col-sm-10">
                                <b>
                                    Rp. {{ number_format($order->pembayarans->total_pembayaran, 0, ',', '.') }}
                                </b>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Metode Pembayaran</b></label>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Metode</label>
                            <div class="col-sm-10">
                                {{ $order->metode_pembayaran->nama_metode }}
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">No Rekening</label>
                            <div class="col-sm-10">
                                {{ $order->metode_pembayaran->norek }}
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Atas Nama</label>
                            <div class="col-sm-10">
                                {{ $order->metode_pembayaran->atas_nama }}
                            </div>
                        </div>
                        <hr>
                    </div>

                    @if ($order->pembayarans->bukti_pembayaran != null)
                    <div class="form-group">
                        <label for="exampleInputEmail1"><b>Bukti Transaksi</b></label>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Bukti Transaksi</label>
                                <div class="col-sm-10">
                                    <a href="#" data-toggle="modal" data-target="#detail-transaksi">
                                        <img src="{{ asset('storage/bukti_pembayaran/' . $order->pembayarans->bukti_pembayaran) }}"
                                            width="100px" height="100px">
                                    </a>
                                </div>
                            </div>
                        @endif
                        {{-- <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">

                                Saat Ini : <b><?php echo $bukti['status']; ?></b><br><br>
                                <form method="POST" action="aksi_detail.php">
                                    <input type="hidden" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>">
                                    <select class="form-control" id="status" name="status" required="required">
                                        <option value="<?php echo $data['status']; ?>" selected disabled="true">
                                            <?php echo $bukti['status']; ?></option>
                                        <option value="Valid">Valid</option>
                                        <option value="Tidak Valid">Tidak Valid</option>
                                    </select>
                                    <br>
                                    <input type="hidden" name="aksi" value="bukti_transaksi">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                                </form>

                            </div>
                        </div> --}}

                    </div>



                </div>
            </div>
        </div>
    </div>
</main>

<div id="detail-transaksi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Bukti Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <img src="{{ asset('storage/bukti_pembayaran/' . $order->pembayarans->bukti_pembayaran) }}"
                    width="100%" height="100%">
            </div>
            </form>
        </div>
    </div>
</div>



@include('admin.layouts.footer')
