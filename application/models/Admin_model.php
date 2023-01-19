<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
  public function getTotalBobotGejala($nama_penyakit)
  {
    $this->db->select_sum('bobot');
    $this->db->from("gejala");
    $this->db->where("gejala.nama_penyakit", $nama_penyakit);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function getBobotGejala($kode_gejala)
  {
    $this->db->select('bobot');
    $this->db->from("gejala");
    $this->db->where("gejala.kode", $kode_gejala);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function getGejalaById($id)
  {
    $this->db->select('*');
    $this->db->from("gejala");
    $this->db->where("gejala.id_gejala", $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function getGejalaByKode($kode)
  {
    $this->db->select('*');
    $this->db->from("gejala");
    $this->db->where("gejala.kode", $kode);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    } else {
      return false;
    }
  }

  public function cekKodeGejala()
  {
    $query = $this->db->query("SELECT MAX(kode) as max_id from gejala");
    $rows = $query->row();
    $kode = $rows->max_id;
    $noUurut = (int) substr($kode, 1, 2);
    $noUurut++;
    $char = "G";
    $kode = $char . sprintf("%02s", $noUurut);
    return $kode;
  }
  public function cekKodePenyakit()
  {
    $query = $this->db->query("SELECT MAX(kode) as max_id from penyakit");
    $rows = $query->row();
    $kode = $rows->max_id;
    $noUurut = (int) substr($kode, 1, 2);
    $noUurut++;
    $char = "P";
    $kode = $char . sprintf("%02s", $noUurut);
    return $kode;
  }
  public function tambahGejala()
  {
    $Kode = $this->cekKodeGejala();
    $data = [
      'kode' => $Kode,
      'gejala' => $this->input->post('gejala'),
      'nama_penyakit' => $this->input->post('nama_penyakit'),
      'bobot' => $this->input->post('bobot'),
    ];
    $this->db->insert('gejala', $data);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function editGejala()
  {
    $data = [
      "kode" => $this->input->post('kode', true),
      "gejala" => $this->input->post('gejala', true),
      "nama_penyakit" => $this->input->post('nama_penyakit', true),
      "bobot" => $this->input->post('bobot', true)
    ];
    $this->db->where('id_gejala', $this->input->post('id'));
    $this->db->update('gejala', $data);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }


  public function hapusGejala($id)
  {
    $this->db->where('id_gejala', $id);
    $this->db->delete('gejala');
  }

  public function tambahPenyakit()
  {
    $Kode = $this->cekKodePenyakit();
    $data = [
      'kode' => $Kode,
      'nama_penyakit' => $this->input->post('nama_penyakit'),
      'saran' => $this->input->post('saran'),
      'informasi' => $this->input->post('informasi')
    ];
    $this->db->insert('penyakit', $data);
  }

  public function editPenyakit()
  {
    $data = [
      'kode' => $this->input->post('kode'),
      'nama_penyakit' => $this->input->post('nama_penyakit'),
      'saran' => $this->input->post('saran'),
      'informasi' => $this->input->post('informasi')
    ];
    $this->db->where('nama_penyakit', $this->input->post('id'));
    $this->db->update('penyakit', $data);
  }

  public function hapusPenyakit($id)
  {
    $this->db->where('nama_penyakit', $id);
    $this->db->delete('penyakit');
  }
}
