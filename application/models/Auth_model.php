<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
  public function getUser($email)
  {
    return $this->db->get_where('user', ['email' => $email])->row_array();
  }

  public function daftar()
  {
    $email = $this->input->post('email', true);
    $data = [ //isinya sesuai dengan field yang ada di tabel user, array
      'name' => htmlspecialchars($this->input->post('name', true)),
      'email' => htmlspecialchars($email),
      'image' => 'user.png',
      'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT), //enkripsi punya php bukan ci $this password1, pake security password_default supaya dipilih paling baik php
      'role_id' => 2, //default 2 adalah member
      'is_active' => 1, //0 kalau butuh aktivasi 1 jika pingin langsung aktif 
      'date_created' => date('d F Y')
    ];


    $this->db->insert('user', $data); //masukkan $data yang urut sebelumnya ke tabel user 
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">akun telah berhasil dibuat</div>');
    redirect('auth');
  }
}
