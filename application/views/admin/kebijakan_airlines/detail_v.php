<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Detail Kebjakan Airlines</h1>
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
                        <h4><?= $nama ?></h4> 
                      </div>
                      <div class="col-md-12">
                        <img src="<?php echo base_url('uploads/airlines/'.$gambar) ?>" width="200" alt="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <p><?= $description ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <h5>Kebijakan Airlines</h5>
                      </div>
                      <div class="col-md-12">
                        <?php $no = 1; ?>
                        <?php foreach ($kebijakans as $key => $value) { ?>
                          <table>
                            <tr>
                              <td style="width: 10%;"><?= $no."." ?></td>
                              <td><?= $value->kebijakan ?></td>
                            </tr>
                          </table>
                        <?php  } ?>
                      </div>
                    </div>
                  </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <a href="<?php echo base_url() ?>kebijakan_airlines" class="btn btn-info">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>


<script data-main="<?php echo base_url() ?>assets/js/main/main-kebijakan-airlines" src="<?php echo base_url() ?>assets/js/require.js"></script>


</section>
