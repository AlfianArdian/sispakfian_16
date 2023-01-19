<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller // dari routes kesini
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Diagnosa_model', 'diagnosa');
  }
  public function index()
  {
    $this->load->view('home/index');
  }
  public function diagnosa() // controller load model dan menyajikan tampilan
  {
    if (!$this->session->userdata('email')) {
      redirect('auth');
    }
    $data['gejala'] = $this->diagnosa->get_all_gejala();
    $this->load->view('home/diagnosa', $data);
  }
}
