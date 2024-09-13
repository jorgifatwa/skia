<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Ubah Testimoni</h1>
        <p class="m-0">Testimoni</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>testimoni"></i>Testimoni</a></li>
          <li class="breadcrumb-item active">Ubah Testimoni</li>
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
                    <div class="row">
                      <div class="col-md-12">
                        <h4>Testimoni</h4>
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Nama Customer</label>
                        <div class="col-sm-4">
                            <input type="hidden" id="id" name="id" value="<?= $id ?>">
                            <input class="form-control" type="text" id="name" name="name" autocomplete="off" placeholder="Nama Customer" value="<?= $nama ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="form-label col-sm-3" for="">Asal Customer</label>
                        <div class="col-sm-4">
                            <input class="form-control"  type="text" id="asal" name="asal" autocomplete="off" placeholder="Asal Customer" value="<?= $asal ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Testimoni</label>
                        <div class="col-sm-4">
                            <textarea name="testimoni" id="testimoni" class="form-control" placeholder="Testimoni" cols="30" rows="10"><?= $testimoni ?></textarea>
                        </div>
                    </div>
                  </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <a href="<?php echo base_url() ?>testimoni" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<script data-main="<?php echo base_url() ?>assets/js/main/main-testimoni" src="<?php echo base_url() ?>assets/js/require.js"></script>


</section>
