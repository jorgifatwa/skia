<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Ubah Pengeluaran</h1>
        <p class="m-0">Pengeluaran</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>pengeluaran"></i>Pengeluaran</a></li>
          <li class="breadcrumb-item active">Ubah Pengeluaran</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <form id="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Tanggal</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="hidden" id="id" name="id" autocomplete="off" placeholder="Nama Travel" value="<?php echo $id ?>">
                            <input class="form-control" type="date" id="tanggal" name="tanggal" autocomplete="off" value="<?= $tanggal ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Harga</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="harga" name="harga" autocomplete="off" placeholder="Masukkan Harga" value="<?= $harga ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Jumlah</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="jumlah_pax" name="jumlah" autocomplete="off" placeholder="Masukkan Jumlah" value="<?= $jumlah ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Total Keseluruhan</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="total_keseluruhan" name="total_keseluruhan" autocomplete="off" placeholder="Masukkan Total Keseluruhan" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Keterangan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off" placeholder="Masukkan Keterangan" value="<?= $keterangan ?>">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <a href="<?php echo base_url() ?>pengeluaran" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<script data-main="<?php echo base_url() ?>assets/js/main/main-pengeluaran" src="<?php echo base_url() ?>assets/js/require.js"></script>


</section>
