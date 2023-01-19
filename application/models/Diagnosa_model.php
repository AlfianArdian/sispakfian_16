  <?php
  defined('BASEPATH') or exit('No direct script access allowed');

  class Diagnosa_model extends CI_Model
  {
    public function kosongkanGejalaPasien()
    {
      return $this->db->truncate('gejala_pasien');
      // kosongkan tabel gejala_pasien
    }
    public function kosongkanProbabilitasPenyakit()
    {
      return $this->db->truncate('probabilitas_penyakit');
      // kosongkan tabel probabilitas_penyakit
    }

    public function get_all_gejala()
    {
      $this->db->select('*');
      $this->db->from("gejala");
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return false;
      }
    }

    public function get_all_gejala_pasien($group_by = FALSE) //datanya digrup agar id yang sama tidak muncul 2 kali, dibikin false biar kalau controller ada nilainya baru jalan
    {
      $this->db->select('*');
      $this->db->from("gejala_pasien");
      $this->db->join("gejala", "gejala.id_gejala = gejala_pasien.id_gejala", 'left');
      if ($group_by) {
        $this->db->group_by($group_by);
      }
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return false;
      }
    }

    public function get_all_probabilitas_penyakit($group_by = FALSE, $order_by = FALSE, $limit = FALSE)
    {
      $this->db->select('*');
      $this->db->from("probabilitas_penyakit");
      $this->db->join("penyakit", "penyakit.nama_penyakit = probabilitas_penyakit.nama_penyakit", 'left');
      if ($group_by) {
        $this->db->group_by($group_by);
      }
      if ($order_by) {
        $this->db->order_by($order_by);
      }
      if ($limit) {
        $this->db->limit($limit);
      }
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return false;
      }
    }

    public function count_all_gejala_pasien() //ngambil semua gejala yang diderita pasien dan kemungkinan gejala penyakit
    {
      $this->db->select('*');
      $this->db->from("gejala_pasien");
      $this->db->join("gejala", "gejala.id_gejala = gejala_pasien.id_gejala", 'left');
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
        return $query->num_rows();
      } else {
        return false;
      }
    }

    public function count_gejala_penyakit_by_pasien($nama_penyakit)
    {
      $this->db->select('*');
      $this->db->from("gejala_pasien");
      $this->db->join("gejala", "gejala.id_gejala = gejala_pasien.id_gejala", 'left');
      $this->db->where('nama_penyakit', $nama_penyakit); //sesuai nama_penyakit masing-masing
      $query = $this->db->get();
      if ($query->num_rows() > 0) { //datanya ada atau tidak yang didapat dari query
        return $query->num_rows(); //hitung jumlah baris data saja
      } else {
        return false;
      }
    }

    public function simpan_probabilitas_penyakit($nama_penyakit, $probabilitas)
    {
      $data = array(
        'nama_penyakit' => $nama_penyakit,
        'probabilitas' => $probabilitas,
      );
      $this->db->insert('probabilitas_penyakit', $data);
      if ($this->db->affected_rows() > 0) {
        return TRUE;
      } else {
        return FALSE;
      }
    }

    public function get_probabilitas_penyakit($nama_penyakit)
    {
      $this->db->select('*');
      $this->db->from("probabilitas_penyakit");
      $this->db->where('nama_penyakit', $nama_penyakit);
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
        return $query->result(); //ambil nilai query semua dari proses diatas
      } else {
        return false;
      }
    }

    public function update_gejala_pasien($id, $probabilitas)
    {
      $data = array(
        'probabilitas_gejala' => $probabilitas,
      );
      $where = array('id' => $id);
      $this->db->where($where);
      $this->db->update('gejala_pasien', $data);
      if ($this->db->affected_rows() > 0) {
        return TRUE;
      } else {
        return FALSE;
      }
    }

    public function sum_probabilitas_gejala_by_penyakit($nama_penyakit)
    {
      $this->db->select_sum('probabilitas_gejala');
      $this->db->from("gejala_pasien");
      $this->db->join("gejala", "gejala.id_gejala = gejala_pasien.id_gejala");
      $this->db->join("penyakit", "penyakit.nama_penyakit = gejala.nama_penyakit");
      $this->db->where("gejala.nama_penyakit", $nama_penyakit);
      $query = $this->db->get();
      if ($query->num_rows() > 0) {
        return $query->result();
      } else {
        return false;
      }
    }

    public function update_probabilitas_penyakit($id, $naive_bayes)
    {
      $data = array(
        'naive_bayes' => $naive_bayes,
      );
      $where = array('nama_penyakit' => $id);
      $this->db->where($where);
      $this->db->update('probabilitas_penyakit', $data);
      if ($this->db->affected_rows() > 0) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
  }
