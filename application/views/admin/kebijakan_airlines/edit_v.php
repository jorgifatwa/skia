<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Ubah Kebjakan Airlines</h1>
        <p class="m-0">Kebjakan Airlines</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>kebijakan_airlines"></i>Kebjakan Airlines</a></li>
          <li class="breadcrumb-item active">Ubah Kebjakan Airlines</li>
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
                        <h4>Airlines</h4>
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Nama Airlines</label>
                        <div class="col-sm-4">
                            <input type="hidden" id="id" name="id" value="<?= $id ?>">
                            <input class="form-control" type="text" id="name" name="name" autocomplete="off" placeholder="Nama Airlines" value="<?= $nama ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Preview Logo Airlines</label>
                        <div class="col-sm-4">
                            <img src="<?php echo base_url('uploads/airlines/'.$gambar) ?>" alt="" width="200">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Logo Airlines</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="file" id="gambar" name="gambar" autocomplete="off" accept=".jpg, .jpeg, .png">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Deskripsi</label>
                        <div class="col-sm-4">
                            <textarea name="description" id="description" class="form-control" placeholder="Deskripsi" cols="30" rows="10"><?= $description ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <h4>Kebijakan</h4>
                      </div>
                      <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-primary btn-tambah-kebijakan"><span class="fa fa-plus"></span> Tambah Kebijakan</button>
                      </div>
                    </div>
                    <table class="table cart-table">
                      <thead>
                          <tr>
                              <th>Kebijakan</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody id="cart-items">
                        <?php foreach ($kebijakans as $key => $kebijakan) { ?>
                          <tr>
                            <td><input type="text" name="kebijakan[]" class="form-control" value="<?= $kebijakan->kebijakan ?>"></td>  
                            <td><button type="button" class="btn btn-danger btn-delete-kebijakan"><span class="fa fa-trash"></span></button></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <a href="<?php echo base_url() ?>kebijakan_airlines" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<script data-main="<?php echo base_url() ?>assets/js/main/main-kebijakan-airlines" src="<?php echo base_url() ?>assets/js/require.js"></script>


</section>
