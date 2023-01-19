<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('Admin_model', 'admin');
    $this->load->helper('Admin_helper');
  }

  public function index()
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['jml_penyakit'] = $this->db->get('penyakit')->num_rows();
    $data['jml_gejala'] = $this->db->get('gejala')->num_rows();
    $this->load->view('templates/header', $data); //agar modular
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/index', $data);
    $this->load->view('templates/footer');
  }

  public function gejala()
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['subMenu'] = $this->db->get_where('sub_menu_user', ['id' => 4])->row_array();
    $data['gejala'] = $this->db->get('gejala')->result_array();
    $data['penyakit'] = $this->db->get('penyakit')->result_array(); //query ke select combobox
    $data['kode'] = $this->admin->cekKodeGejala();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/data_gejala', $data);
    $this->load->view('templates/footer');
    $this->load->view('admin/modals/modal_tambah_gejala', $data);
    // $this->load->view('admin/modals/modal_edit_gejala', $data);
  }


  public function editGejala($id)
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['subMenu'] = $this->db->get_where('sub_menu_user', ['id' => 4])->row_array();
    $data['gejala'] = $this->admin->getGejalaById($id);
    $data['penyakit'] = $this->db->get('penyakit')->result_array();
    $data['kode'] = $this->admin->cekKodeGejala();

    $gejala = $this->input->post('nama_penyakit') . '.' . $this->input->post('kode');
    //validasi data
    $config = array(
      array(
        'field' => 'nama_penyakit',
        'label' => 'Nama_penyakit',
        'rules' => 'trim|required',
        'errors' => array(
          'required' => 'Anda harus memilih nama penyakit!',
        )
      ),
      array(
        'field' => 'bobot',
        'label' => 'Bobot',
        'rules' => 'trim|required|greater_than[0]|numeric|callback_bobot_update_check[' . $gejala . ']',
        'errors' => array(
          'required' => 'Tidak valid!',
          'numeric' => 'Yang anda masukkan bukan angka!',
          'greater_than' => 'terlalu kecil!',
        )
      ),
    );

    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) { // cek validasi jika false berikan form edit
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('admin/edit_gejala', $data);
      $this->load->view('templates/footer');
    } else { //jika valid, simpan data
      if ($this->admin->editGejala() == true) {
        $this->session->set_flashdata('flash', 'data berhasil diubah!');
        redirect('Admin/gejala');
      } else {
        redirect('Admin/gejala');
      }
    }
  }

  //validasi bobot
  public function bobot_update_check($str, $data)
  {
    $explode        = explode('.', $data);
    $nama_penyakit  = $explode[0];
    $kode_gejala    = $explode[1];
    $total_bobot = $this->admin->getTotalBobotGejala($nama_penyakit);
    $penyakit_sebelumnya = $this->admin->getGejalaByKode($kode_gejala);
    $bobot_sebelumnya = $this->admin->getBobotGejala($kode_gejala);


    $total_bobot = round($total_bobot[0]->bobot, 4);
    //cek nama penyakit sebelumnya
    if ($nama_penyakit == $penyakit_sebelumnya[0]->nama_penyakit) {
      // cek bobot jika nama penyakit sama
      if (($total_bobot - $bobot_sebelumnya[0]->bobot + $str) > 1) {
        $this->form_validation->set_message('bobot_update_check', 'Total bobot ' . $nama_penyakit . ' tidak boleh lebih dari 1!');
        return false;
      } else {
        return true;
      }
    } else {
      // cek bobot jika nama penyakit berubah
      if (($total_bobot + $str) > 1) {
        $this->form_validation->set_message('bobot_update_check', 'Total bobot ' . $nama_penyakit . ' tidak boleh lebih dari 1!');
        return false;
      } else {
        return true;
      }
    }
  }

  public function penyakit()
  {
    $data['judul'] = 'Admin SP';
    $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    $data['subMenu'] = $this->db->get_where('sub_menu_user', ['id' => 5])->row_array();
    $data['penyakit'] = $this->db->get('penyakit')->result_array();
    $data['kode'] = $this->admin->cekKodePenyakit();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/data_penyakit', $data);
    $this->load->view('templates/footer');
    $this->load->view('admin/modals/modal_tambah_penyakit');
    $this->load->view('admin/modals/modal_edit_penyakit', $data);
  }
}
