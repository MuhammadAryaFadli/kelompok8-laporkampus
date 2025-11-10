<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
  <div class="card p-4 shadow" style="width: 400px;">
    <h4 class="text-center mb-3">Registrasi Akun</h4>
    <div id="alert-container"></div>
    <form id="registerForm">
      <?= csrf_field() ?>
      <div class="mb-2">
        <label class="form-label">NPM</label>
        <input type="text" name="npm" class="form-control" required>
      </div>
      <div class="mb-2">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
      </div>
      <div class="mb-2">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="mb-2">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirm" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Daftar</button>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script>
    $("#registerForm").on("submit", function(e){
      e.preventDefault();
      $.ajax({
        url: "<?= site_url('register') ?>",
        type: "POST",
        data: $(this).serialize(),
        dataType: "json",
        success: function(res){
          if(res.success){
            $("#alert-container").html(`<div class="alert alert-success">${res.message}</div>`);
            setTimeout(()=> window.location.href="<?= site_url('login') ?>", 1500);
          } else {
            let errors = "";
            $.each(res.message, function(key, val){ errors += val + "<br>"; });
            $("#alert-container").html(`<div class="alert alert-danger">${errors}</div>`);
          }
        },
        error: function(){
          $("#alert-container").html(`<div class="alert alert-danger">Terjadi kesalahan server</div>`);
        }
      });
    });
  </script>
</body>
</html>
