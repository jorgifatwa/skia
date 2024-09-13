<footer class="main-footer">
	<strong>Copyright &copy; <?php echo date("Y"); ?>
		<a href="<?php echo base_url() ?>">Jorgi Fatwa Ambia</a>.
	</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 0.0.1
	</div>
</footer>
  <!-- Cropper.js CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
<!-- Cropper.js JS -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>

$( document ).ready(function() {
	var cropper;
var image = document.getElementById('image');
var inputImage = document.getElementById('inputImage');

// Fungsi untuk menampilkan gambar di modal
inputImage.addEventListener('change', function (event) {
  var files = event.target.files;
  var done = function (url) {
    inputImage.value = ''; // Kosongkan input setelah memilih
    image.src = url;       // Set gambar yang dipilih

    // Pastikan modal dibuka secara manual setelah gambar diatur
    $('#cropModal').modal('show');
  };

  if (files && files.length > 0) {
    var reader = new FileReader();
    reader.onload = function () {
      done(reader.result);
    };
    reader.readAsDataURL(files[0]);
  }
});

// Saat modal dibuka sepenuhnya, inisialisasi Cropper.js
$('#cropModal').on('shown.bs.modal', function () {
  cropper = new Cropper(image, {
    aspectRatio: 1, // Atur rasio sesuai kebutuhan
    viewMode: 2
  });
});

// Saat modal ditutup, hancurkan instance cropper untuk mencegah konflik
$('#cropModal').on('hidden.bs.modal', function () {
  if (cropper) {
    cropper.destroy();
    cropper = null;
  }
});

// Tombol untuk meng-crop gambar
$('#cropImageBtn').click(function () {
  // Pastikan Cropper sudah terinisialisasi
  if (!cropper) {
    alert('Cropper belum siap!');
    return;
  }

  // Ambil hasil cropping
  var canvas = cropper.getCroppedCanvas();
  if (canvas) {
    canvas.toBlob(function(blob) {
      var formData = new FormData();
      formData.append('croppedImage', blob);

      // Kirim hasil crop ke server dengan AJAX
      $.ajax({
        url: '<?= site_url("image/upload") ?>', // Ganti dengan URL upload
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          alert('Gambar berhasil di-crop dan diupload!');
          // Tambahkan logika sukses lainnya di sini
        },
        error: function() {
          alert('Terjadi kesalahan saat upload gambar.');
        }
      });
    });
  } else {
    alert('Gagal mendapatkan hasil crop!');
  }
});

});

</script>