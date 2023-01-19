<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gejala extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Admin_model', 'admin');
    if (!$this->session->userdata('email')) {
      // tendang ke auth/login page
      redirect('auth');
    }
  }

  public function validateTambahGejala()
  {
    $data = $this->input->post('nama_penyakit');
    //validasi data
    $config = array(
      array(
        'field' => 'nama_penyakit',
        'label' => 'Nama Penyakit',
        'rules' => 'trim|required',
        'errors' => array(
          'required' => 'Anda harus memilih nama penyakit!',
        )
      ),
      array(
        'field' => 'bobot',
        'label' => 'Bobot',
        'rules' => 'trim|required|less_than_equal_to[1]|numeric|callback_bobot_check[' . $data . ']',
        'errors' => array(
          'required' => 'Tidak valid!',
          'numeric' => 'Yang anda masukkan bukan angka!',
          'less_than_equal_to' => 'terlalu besar!',
        )
      ),
    );

    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'kode_error' => form_error('kode'),
        'gejala_error' => form_error('gejala'),
        'nama_penyakit_error' => form_error('nama_penyakit'),
        'bobot_error' => form_error('bobot'),
        'validation_errors' => validation_errors(),
        'code' => 1,
      );
    } else {
      $data = array(
        'code' => 0,
      );
    }
    echo json_encode($data);
  }

  public function bobot_check($str, $nama_penyakit)
  {
    $total_bobot = $this->admin->getTotalBobotGejala($nama_penyakit);

    if (($total_bobot[0]->bobot + $str) > 1) {
      $this->form_validation->set_message('bobot_check', 'Tidak boleh lebih dari 1');
      return false;
    } else {
      return true;
    }
  }


  public function tambahGejala()
  {

    if ($this->admin->tambahGejala() == true) {
      $data = array(
        'code' => 200,
        'success' => 'Data berhasil ditambahkan',
      );
    } else {
      $data = array(
        'code' => 404,
        'fail' => 'Data gagal ditambahkan',
      );
    }

    echo json_encode($data);
  }

  public function hapusGejala($id)
  {
    $this->admin->hapusGejala($id);
    $this->session->set_flashdata('flash', 'Dihapus');
    redirect('admin/gejala');
  }
}
