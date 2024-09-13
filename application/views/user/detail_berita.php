        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Berita</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active text-white">Berita</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <!-- About Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <?php foreach ($data_berita as $key => $berita) { ?>
                        <div class="col-lg-12">
                            <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                                <img src="<?php echo base_url('uploads/blog/'.$berita->gambar) ?>" class="img-fluid w-100 h-100" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                            <h5 class="section-about-title pe-3"><?= $berita->title ?></h5>
                            <?= $berita->berita ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>