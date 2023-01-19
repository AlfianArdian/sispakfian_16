<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosa extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Diagnosa_model', 'diagnosa'); //semua this manggil nama kelas Diagnosa_model
    if (!$this->session->userdata('email')) {
      redirect('home');
    }
  }

  public function simpan_gejala_pasien()
  {
    $this->diagnosa->kosongkanGejalaPasien();
    $this->diagnosa->kosongkanProbabilitasPenyakit();
    //tangkap checkbox gejala
    $total_gejala = $this->input->post('total_gejala');
    $i = 1;
    for ($i = 1; $i <= $total_gejala; $i++) {
      $gejala = $this->input->post('gejala_' . $i);
      if ($gejala) {
        //insert checked checkbox ke gejala_pasien
        $data = ['id_gejala' => $gejala];
        $this->db->insert('gejala_pasien', $data);
      }
    }
    return $this->diagnosa->get_all_gejala_pasien();
  }

  public function kalkulasi() //kalkulasi lalu baca atasnya
  {
    $gejala_pasien = $this->simpan_gejala_pasien();
    $penyakit_pasien = $this->diagnosa->get_all_gejala_pasien('nama_penyakit'); //ambil semua gejala tapi nama_penyakit yang sama gak muncul 2 kali
    foreach ($penyakit_pasien as $pp) {
      $jml_gejala_penyakit_pasien = $this->diagnosa->count_gejala_penyakit_by_pasien($pp->nama_penyakit);
      $jml_gejala_pasien = $this->diagnosa->count_all_gejala_pasien();
      $probabilitas_penyakit = $jml_gejala_penyakit_pasien /  $jml_gejala_pasien;
      $this->diagnosa->simpan_probabilitas_penyakit($pp->nama_penyakit, $probabilitas_penyakit); //probabilitas penyakit
    }

    $total_probabilitas_gejala = 0;
    foreach ($gejala_pasien as $gp) {
      $probabilitas_penyakit = $this->diagnosa->get_probabilitas_penyakit($gp->nama_penyakit);
      $probabilitas_gejala = $gp->bobot * $probabilitas_penyakit[0]->probabilitas;
      $this->diagnosa->update_gejala_pasien($gp->id, $probabilitas_gejala);
      $total_probabilitas_gejala += round($probabilitas_gejala, 4); //probabilitas gejala
    }

    foreach ($penyakit_pasien as $pp) {
      $probabilitas_gejala_per_penyakit = $this->diagnosa->sum_probabilitas_gejala_by_penyakit($pp->nama_penyakit);
      foreach ($probabilitas_gejala_per_penyakit as $pg) {
        $naive_bayes = $pg->probabilitas_gejala / $total_probabilitas_gejala;
        $this->diagnosa->update_probabilitas_penyakit($pp->nama_penyakit, $naive_bayes);
      }
    }
    redirect('diagnosa/hasil_analisa');
  }

  public function hasil_analisa()
  {
    $data['gejala_pasien'] = $this->diagnosa->get_all_gejala_pasien();
    $data['probabilitas_penyakit'] = $this->diagnosa->get_all_probabilitas_penyakit(FALSE, 'probabilitas_penyakit.naive_bayes DESC');
    $this->load->view('home/hasil_analisa', $data);
  }

  public function get_probabilitas_penyakit()
  {
    $data['probabilitas_penyakit'] = $this->diagnosa->get_all_probabilitas_penyakit(FALSE, 'probabilitas_penyakit.naive_bayes DESC', 3);
    $data['chart_color'] = [
      "rgba(255, 99, 132, 0.2)",
      "rgba(54, 162, 235, 0.2)",
      "rgba(255, 206, 86, 0.2)",
      "rgba(75, 192, 192, 0.2)",
      "rgba(153, 102, 255, 0.2)",
      "rgba(255, 159, 64, 0.2)"
    ];
    $data['border_color'] = [
      "rgba(255,99,132,1)",
      "rgba(54, 162, 235, 1)",
      "rgba(255, 206, 86, 1)",
      "rgba(75, 192, 192, 1)",
      "rgba(153, 102, 255, 1)",
      "rgba(255, 159, 64, 1)",
    ];
    header('Content-Type: application/json');  // <-- header declaration
    echo json_encode($data);
  }
}
