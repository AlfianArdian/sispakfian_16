<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title><?= $judul; ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Open Sans", sans-serif;
  }

  body {
    background: #786fa6;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .newsletter {
    background: linear-gradient(125deg, #778beb, #f8a5c2);
    width: 500px;
    padding: 60px;
    text-align: center;
    box-shadow: 0 0 20px #00000060;
  }

  .newsletter h1 {
    text-transform: uppercase;
    color: #fff;
    font-size: 48px;
    line-height: 40px;
  }

  .newsletter h1 span {
    display: block;
    font-size: 38px;
  }

  .newsletter p {
    color: #fff;
    font-size: 14px;
    margin: 10px 0;
  }

  .txtb {
    width: 100%;
    height: 70px;
    background: #f1f1f199;
    border-radius: 40px;
    position: relative;
    margin-top: 40px;
  }

  .txtbt {
    width: 100%;
    height: 70px;
    background: #f1f1f199;
    border-radius: 40px;
    position: relative;
    margin-top: 40px;
  }

  .txtb input {
    width: 100%;
    height: 70px;
    border-radius: 40px;
    border: 0;
    background: none;
    padding: 0 30px;
    outline: none;
    font-size: 15px;
    padding-right: 80px;
  }

  .txtb button {
    background: #574b90;
    border: 0;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    position: absolute;
    right: 10px;
    top: 10px;
    outline: none;
    cursor: pointer;
    color: #fff;
    transition: 0.3s linear;
  }

  .txtb button:hover {
    opacity: 0.5;
  }

  a {
    text-decoration: none;
    color: #fff;
    font-size: 14px;
    margin: 10px 0;
  }
</style>

<body>
  <div class="newsletter">
    <h1>
      Lupa
      <span>Password</span>
    </h1>

    <p>Silahkan masukkan name aktif Anda untuk reset password yang terlupakan.</p>
    <?= $this->session->flashdata('message'); ?>
    <div class="txtb">
      <?= form_error('name', '<small style="color: #fff;" class="text-danger pl-3">', '</small>'); ?>
      <form action="<?= base_url('auth/lupaPassword'); ?>" method="post">
        <input type="text" name="name" placeholder="masukkan name">
        <button type="submit"><i class="fas fa-arrow-right"></i></button>
        <a href="<?= base_url('auth'); ?>"><i style="margin-top: 15px;" class="fas fa-arrow-left"></i> Kembali</a>
      </form>
    </div>
  </div>
</body>

</html>