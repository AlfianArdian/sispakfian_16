<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyakit extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Admin_model', 'admin');
    if (!$this->session->userdata('email')) {
      redirect('auth');
    }
  }
  public function tambahPenyakit()
  {
    $this->admin->tambahPenyakit();
    $this->session->set_flashdata('flash', 'Ditambahkan');
    redirect('admin/penyakit');
  }

  public function editPenyakit()
  {
    $this->admin->editPenyakit();
    $this->session->set_flashdata('flash', 'Diubah');
    redirect('admin/penyakit');
  }

  public function hapusPenyakit($id)
  {
    $this->admin->hapusPenyakit($id);
    $this->session->set_flashdata('flash', 'Dihapus');
    redirect('admin/penyakit');
  }
}
