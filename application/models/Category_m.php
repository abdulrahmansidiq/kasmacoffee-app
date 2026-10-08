<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_m extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('category');
        if($id != null){
            $this->db->where('category_id', $id);
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

        $this->db->insert('category', $params);
        insert_log("Tambah Kategori | Nama Kategori : $name " , $user_id);
    }

    public function ubah($post){ 
        $params = [
            'name' => $post['nama'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $user_id = $this->fungsi->user_login()->name;
        $name = $post['nama'];

        $this->db->where('category_id', $post['id']);
        $this->db->update('category', $params);

        insert_log("Ubah Kategori | Nama Kategori : $name " , $user_id);
    }

    public function hapus($id)
	{
        //DISINI AMBIL DATA KATEGORI
        $q_kategori = $this->db->query("SELECT * FROM category WHERE category_id = '$id'")->result();

        //DEFINISIKAN VARIABEL KOSONG
        $name = "";
        foreach($q_kategori as $d_kategori)
        {
            $name = $d_kategori->name;
        }
        $user_id = $this->fungsi->user_login()->name;

		$this->db->where('category_id', $id);
		$this->db->delete('category');

        insert_log("Hapus Kategori | Nama Kategori : $name " , $user_id);
    }
}