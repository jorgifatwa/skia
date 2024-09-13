<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Testimoni Baru</h1>
        <p class="m-0">Testimoni</p>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>testimoni">Testimoni</a></li>
          <li class="breadcrumb-item active">Testimoni Baru</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<style>
    #image {
    display: block;
    max-width: 100%; /* Biarkan gambar mengisi lebar container */
    height: auto;    /* Pertahankan proporsi gambar */
    margin: 0 auto;  /* Pusatkan gambar di dalam modal */
}

.modal-body {
    padding: 0; /* Hilangkan padding untuk memberikan ruang lebih pada gambar */
}
.modal-dialog.modal-lg {
    max-width: 90%;  /* Memastikan modal cukup besar */
    width: auto;
}

.modal-content {
    max-height: 90vh; /* Batasi tinggi modal agar tetap sesuai dengan viewport */
    overflow: hidden;
}

.modal-body {
    display: flex;
    justify-content: center; /* Pusatkan konten dalam modal */
    align-items: center;
    overflow: hidden; /* Pastikan gambar tidak keluar dari modal */
}

</style>

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
                          <input class="form-control" type="text" id="name" name="name" autocomplete="off" placeholder="Nama Customer">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="form-label col-sm-3" for="">Asal Customer</label>
                      <div class="col-sm-4">
                          <input class="form-control"  type="text" id="asal" name="asal" autocomplete="off" placeholder="Asal Customer">
                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="form-label col-sm-3" for="">Testimoni</label>
                      <div class="col-sm-4">
                          <textarea name="testimoni" id="testimoni" class="form-control" placeholder="Testimoni" cols="30" rows="10"></textarea>
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
