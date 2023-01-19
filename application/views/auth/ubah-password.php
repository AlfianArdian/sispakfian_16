<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <title>َUbah Password</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      background: #34495e;
    }

    .box {
      width: 300px;
      padding: 40px;
      position: absolute;
      border-radius: 50%;
      box-shadow: #fff;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #191919;
      text-align: center;
      -webkit-box-shadow: 0px 0px 20px 15px rgba(24, 107, 132, 0.75);
      -moz-box-shadow: 0px 0px 20px 15px rgba(24, 107, 132, 0.75);
      box-shadow: 0px 0px 20px 15px rgba(24, 107, 132, 0.75);
    }

    .box h2 {
      color: white;
      font-weight: 300;
    }

    .box cite {
      color: white;
    }

    .box input[type="text"],
    .box input[type="password"] {
      border: 0;
      background: none;
      display: block;
      margin: 20px auto;
      text-align: center;
      border: 2px solid #3498db;
      padding: 14px 10px;
      width: 200px;
      outline: none;
      color: white;
      border-radius: 24px;
      transition: 0.25s;
    }

    .box input[type="text"]:focus,
    .box input[type="password"]:focus {
      width: 280px;
      border-color: #2ecc71;
    }

    .box button[type="submit"] {
      border: 0;
      background: none;
      display: block;
      margin: 20px auto;
      text-align: center;
      border: 2px solid #2ecc71;
      padding: 14px 40px;
      outline: none;
      color: white;
      border-radius: 24px;
      transition: 0.25s;
      cursor: pointer;
    }

    .box button[type="submit"]:hover {
      background: #2ecc71;
    }
  </style>
  <form class="box" action="<?= base_url('auth/ubahPassword'); ?>" method="post">
    <h2>Ubah Password untuk</h2>
    <cite><b>name disini here</b></cite>
    <input type="password" name="password1" placeholder="Masukkan password baru" />
    <input type="password" name="password2" placeholder="Ulangi password baru" />
    <button type="submit">Ubah Password</button>
  </form>
</body>

</html>