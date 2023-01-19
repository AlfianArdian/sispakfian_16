<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Auth_model', 'auth');
  }
  public function index()
  {
    //cek jika sudah ada login session pada user
    if ($this->session->userdata('email')) {
      redirect('user');
    }
    //form validasi
    $this->form_validation->set_rules('email', 'Email', 'trim|required'); //{10} for 10 digits number
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    //jika validasi gagal kembalikan ke halaman login
    if ($this->form_validation->run() == false) { //method form validation
      $data['judul'] = 'Halaman login';
      $this->load->view('auth/login', $data);
      //jika validasi sukses menuju ke method _login
    } else {
      $this->_login(); //method private untuk kelas ini saja
    }
  }
  private function _login()
  {
    //mendapatkan inputan user dari form login
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    //query ke tbl user utk mendapatkn semua data hanya satu user, select*from table user where name= $name, row_array 1 baris
    $auth = $this->auth->getUser($email);
    // cek jika user dgn name yg diinputkn ada apa tdk di tbl user
    if ($auth) {
      // cek jika usernya aktif atau sudah verifikasi apa belum
      if ($auth['is_active'] == 1) { //jika array user ada dan di dalamnya ada field is_active (nilai 1)
        // cek password yang di inputkan user dgn tbl user
        if (password_verify($password, $auth['password'])) { //fungsi php untuk menyamakan password di login form dengan pass yang di hash, password input dengan password dari tabel user
          $data = [
            'email' => $auth['email'], //yang disimpan hanya name dan role_id, tanpa password
            'role_id' => $auth['role_id']
          ];
          //membuat session
          $this->session->set_userdata($data);
          //login arahkan sesuai dengan role admin atau user
          if ($auth['role_id'] == 1) {
            redirect('admin'); //jika 1 ke admin
          } else {
            redirect('home'); // jika 0 adalah user ke home
          }
          //password salah
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
          redirect('auth'); //user tidak ada dikasih warning
        }
        //name tidak terdaftar
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">email belum terdaftar!</div>');
        redirect('auth');
      }
    }
  }
  public function registrasi()
  {
    if ($this->session->userdata('email')) {
      redirect('user');
    }
    //form validasi
    $this->form_validation->set_rules('name', 'Name', 'required|trim'); //berikan aturan harus di isi dan agar spasi tidak masuk database trim
    $this->form_validation->set_rules('email', 'email', 'required|trim');
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [ //matches passwordnya harus sama dengan password2
      'matches' => 'Password tidak cocok!', //array untuk komen custom
      'min_length' => 'Password kurang panjang!'
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
    //jika form validasi gagal kembalikan ke halaman registrasi
    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Register Page';
      $this->load->view('auth/registrasi', $data);
      //jika validasi sukses, tampung data inputan utk di insert ke tbl user
    } else {
      $this->auth->daftar(); //ke auth_model
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! Kamu sudah terdaftar. Silahkan aktivasi akun.</div>');
      redirect('auth'); // pesan flashdata sukses registrasi
    }
  }
  public function ubahPassword()
  {
    if (!$this->session->userdata('reset_email')) {
      redirect('auth');
    }

    $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Ubah Password';
      $this->load->view('auth/ubah-password', $data);
    } else {
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      $email = $this->session->userdata('reset_email');

      $this->db->set('password', $password);
      $this->db->where('email', $email);
      $this->db->update('user');

      $this->session->unset_userdata('reset_email');

      $this->db->delete('user_token', ['email' => $email]);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password sudah terubah! Silahkan login.</div>');
      redirect('auth');
    }
  }
  public function logout() //bersihkan session dan kembali ke login
  {
    //hapus session email
    $this->session->unset_userdata('email');
    //hapus session role_id
    $this->session->unset_userdata('role_id');
    //pesan flashdata telah berhasil logout
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Kamu berhasil logout!</div>');
    redirect('auth');
  }
  public function block()
  {
    $data['judul'] = 'Akses Tidak Diizinkan!';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $this->load->view('templates/header', $data);
    $this->load->view('auth/blocked', $data);
  }
}
