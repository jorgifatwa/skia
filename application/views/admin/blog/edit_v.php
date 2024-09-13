<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Ubah Berita</h1>
        <p class="m-0">Berita</p>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url() ?>berita"></i>Berita</a></li>
          <li class="breadcrumb-item active">Ubah Berita</li>
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
                      <label class="form-label col-sm-3" for="">Title</label>
                      <div class="col-sm-9">
                          <input class="form-control" type="hidden" id="id" name="id" autocomplete="off" placeholder="Nama Travel" value="<?php echo $id ?>">
                          <input class="form-control" type="text" id="title" name="title" autocomplete="off" placeholder="Title" value="<?php echo $title ?>">
                      </div>
                  </div>
                  <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Preview Gambar Beriat</label>
                        <div class="col-sm-9">
                            <img src="<?php echo base_url('uploads/blog/'.$gambar) ?>" alt="" width="200">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="form-label col-sm-3" for="">Gambar</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="file" id="gambar" name="gambar" autocomplete="off" accept=".jpg, .jpeg, .png">
                        </div>
                    </div>
                  <div class="form-group row">
                      <label class="form-label col-sm-3" for="">Berita</label>
                      <div class="col-sm-9">
                          <textarea name="berita" id="berita" class="form-control" placeholder="Berita" cols="30" rows="10"><?php echo $berita ?></textarea>
                      </div>
                  </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <a href="<?php echo base_url() ?>blog" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    ClassicEditor
        .create(document.querySelector('#berita'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                'undo', 'redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
</script>

<script data-main="<?php echo base_url() ?>assets/js/main/main-blog" src="<?php echo base_url() ?>assets/js/require.js"></script>


</section>
