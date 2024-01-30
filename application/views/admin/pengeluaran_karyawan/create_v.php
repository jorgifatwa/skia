<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Pengeluaran Karyawan Baru</h1>
        <p class="m-0">Pengeluaran Karyawan </p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>pengeluaran_karyawan"></i>Pengeluaran Karyawan </a></li>
          <li class="breadcrumb-item active">Pengeluaran Karyawan  Baru</li>
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
                            <input class="form-control" type="date" id="tanggal" name="tanggal" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Nama Karyawan</label>
                        <div class="col-sm-4">
                            <select name="karyawan_id" id="karyawan_id" class="formn-control">
                                <option value="">Pilih Karyawan</option>
                                <?php foreach ($karyawans as $key => $karyawan) { ?>
                                    <option value="<?php echo $karyawan->id ?>"><?php echo $karyawan->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Harga</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" id="harga" name="harga" autocomplete="off" placeholder="Masukkan Harga">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Keterangan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off" placeholder="Masukkan Keterangan">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <a href="<?php echo base_url() ?>pengeluaran_karyawan" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<script data-main="<?php echo base_url() ?>assets/js/main/main-pengeluaran-karyawan" src="<?php echo base_url() ?>assets/js/require.js"></script>