         <!-- Footer Start -->
         <div class="container-fluid footer py-5">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Get In Touch</h4>
                            <a href=""><i class="fas fa-home me-2"></i> Area Perkantoran Terminal, Bandara Soekarno Hatta</a>
                            <a href=""><i class="fas fa-envelope me-2"></i> khatulistiwasky@gmail.com</a>
                            <a href=""><i class="fas fa-phone me-2"></i> 0819-0616-0392</a>
                            <a href="" class="mb-3"><i class="fas fa-phone me-2"></i> 0819-0616-0392</a>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-share fa-2x text-white me-2"></i>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                                <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="footer-item d-flex flex-column">
                            <h4 class="mb-4 text-white">Company</h4>
                            <a href="#about"><i class="fas fa-angle-right me-2"></i> Tentang Kami</a>
                            <a href="#services"><i class="fas fa-angle-right me-2"></i> Pelayanan</a>
                            <a href="#skia"><i class="fas fa-angle-right me-2"></i> Sky Khatulistiwa</a>
                            <a href="#kegiatan"><i class="fas fa-angle-right me-2"></i> Kegiatan</a>
                            <a href="#galeri"><i class="fas fa-angle-right me-2"></i> Galeri</a>
                            <a href="#dokumen"><i class="fas fa-angle-right me-2"></i> Dokumen</a>
                            <a href="#testimoni"><i class="fas fa-angle-right me-2"></i> Testimoni</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-4">
                        <div class="footer-item">
                            <div class="row gy-3 gx-2 mb-4">
                                <img src="<?php echo base_url() ?>assets/user/img/sky-jablay.png" width="200" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright text-body py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-end mb-md-0">
                        <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-start">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                        Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url() ?>assets/user/lib/easing/easing.min.js"></script>
        <script src="<?php echo base_url() ?>assets/user/lib/waypoints/waypoints.min.js"></script>
        <script src="<?php echo base_url() ?>assets/user/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="<?php echo base_url() ?>assets/user/lib/lightbox/js/lightbox.min.js"></script>
        

        <!-- Template Javascript -->
        <script src="<?php echo base_url() ?>assets/user/js/main.js"></script>
    </body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    let maxHeight = 0;
    document.querySelectorAll('.packages-item').forEach(function(item) {
        const itemHeight = item.offsetHeight;
        if (itemHeight > maxHeight) {
            maxHeight = itemHeight;
        }
    });
    document.querySelectorAll('.packages-item').forEach(function(item) {
        item.style.height = maxHeight + 'px';
    });
});
</script>