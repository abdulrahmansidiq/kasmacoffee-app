<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_m extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('unit');
        if($id != null){
            $this->db->where('unit_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function tambah($post){
        $params = [
            'name' => $post['nama']
        ];
        $user_id = $this->fungsi->user_login()->name;
        $name = $post['nama'];

        $this->db->insert('unit', $params);
        
        insert_log("Tambah Satuan | Nama Satuan : $name " , $user_id);
    }

    public function ubah($post){ 
        $params = [
            'name' => $post['nama'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $user_id = $this->fungsi->user_login()->name;
        $name = $post['nama'];

        $this->db->where('unit_id', $post['id']);
        $this->db->update('unit', $params);

        insert_log("Ubah Satuan | Nama Satuan : $name " , $user_id);
    }

    public function hapus($id)
	{
        //DISINI AMBIL DATA BARANG
        $q_barang = $this->db->query("SELECT * FROM unit WHERE unit_id = '$id'")->result();

        //DEFINISIKAN VARIABEL KOSONG
        $name = "";
        foreach($q_barang as $d_barang)
        {
            $name = $d_barang->name;
        }
        $user_id = $this->fungsi->user_login()->name;

		$this->db->where('unit_id', $id);
        $this->db->delete('unit');

        insert_log("Hapus Satuan | Nama Satuan : $name " , $user_id);
    }
}