        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h3 class="text-white display-3 mb-4">Kebijakan Airlines</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url() ?>">Home</a></li>
                    <li class="breadcrumb-item active text-white">Kebijakan Airlines</li>
                </ol>    
            </div>
        </div>
        <!-- Header End -->

        <!-- About Start -->
        <div class="container-fluid about py-5">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <?php foreach ($data_airline as $key => $airline) { ?>
                        <div class="col-lg-5">
                            <div class="h-100" style="border: 50px solid; border-color: transparent #13357B transparent #13357B;">
                                <img src="<?php echo base_url('uploads/airlines/'.$airline->gambar) ?>" class="img-fluid w-100 h-100" alt="">
                            </div>
                        </div>
                        <div class="col-lg-7" style="background: linear-gradient(rgba(255, 255, 255, .8), rgba(255, 255, 255, .8)), url(img/about-img-1.png);">
                            <h5 class="section-about-title pe-3"><?= $airline->nama ?></h5>
                            <h1 class="mb-4">Kebijakan - Kebijakan <span class="text-primary"><?= $airline->nama ?></span></h1>
                            <p class="mb-4" style="text-align: justify;">Kebijakan maskapai penerbangan adalah serangkaian syarat dan ketentuan yang dibuat oleh maskapai penerbangan . Kebijakan ini menguraikan pendekatan maskapai penerbangan terhadap konsep-konsep utama seperti bagasi, perubahan penerbangan, tempat duduk, dan banyak lagi.Kebijakan maskapai penerbangan adalah serangkaian syarat dan ketentuan yang dibuat oleh maskapai penerbangan . Kebijakan ini menguraikan pendekatan maskapai penerbangan terhadap konsep-konsep utama seperti bagasi, perubahan penerbangan, tempat duduk, dan banyak lagi.</p>
                            <p class="mb-4" style="text-align: justify;"><?= $airline->keterangan ?></p>
                            <?php foreach ($data_kebijakan as $key => $kebijakan) { ?>
                                <div class="row gy-2 gx-4 mb-4">
                                    <div class="col-sm-12">
                                        <p class="mb-0" style="text-align: justify;"><i class="fa fa-arrow-right text-primary me-2"></i><?= $kebijakan->kebijakan ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>