<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('User_model', 'user');
    if (!$this->session->userdata('email')) {
      redirect('auth');
    }
  }
  public function index()
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //data session dari auth, name dan role_id, untuk ngambil data dari user berdasarkan name di session, cari user yang namenya yang dari session, ambil satu baris row_array
    $this->load->view('templates/header', $data); //agar modular
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('user/index', $data);
    $this->load->view('templates/footer');
  }

  public function edit()
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('name', 'Nama lengkap', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/edit', $data);
      $this->load->view('templates/footer');
    } else {
      // cek jika ada gambar yang akan diupload
      $upload_image = $_FILES['image']['name'];

      if ($upload_image) {
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '4096';
        $config['upload_path'] = './assets/img/';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
          $old_image = $data['user']['image'];
          if ($old_image != 'user.png') {
            unlink(FCPATH . '/assets/img/' . $old_image);
          }
          $new_image = $this->upload->data('file_name');
          $this->db->set('image', $new_image);
        } else {
          echo $this->upload->dispay_errors();
        }
      }
      $this->user->editProfil();
      $this->session->set_flashdata('flash', 'Diubah');
      redirect('user');
    }
  }

  public function ubahPassword()
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

    $this->form_validation->set_rules('current_password', 'Password lama', 'required|trim');
    $this->form_validation->set_rules('new_password1', 'Password baru', 'required|trim|min_length[3]|matches[new_password2]');
    $this->form_validation->set_rules('new_password2', 'Konfirmasi password baru', 'required|trim|min_length[3]|matches[new_password1]');

    if ($this->form_validation->run() == false) {
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('user/ubah_password', $data);
      $this->load->view('templates/footer');
    } else {
      $current_password = $this->input->post('current_password');
      $new_password = $this->input->post('new_password1');
      if (!password_verify($current_password, $data['user']['password'])) {
        $this->session->set_flashdata('message', '<div class="col-md-6 alert alert-danger" role="alert">Password tidak cocok!</div>');
        redirect('user/ubahPassword');
      } else {
        if ($current_password == $new_password) {
          $this->session->set_flashdata('message', '<div class="col-md-6 alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama!</div>');
          redirect('user/ubahPassword');
        } else {
          // password sudah ok
          $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
          $this->user->ubahPassword($password_hash);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password sudah terubah!</div>');
          redirect('user');
        }
      }
    }
  }
}
