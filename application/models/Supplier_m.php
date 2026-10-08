<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_m extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('supplier');
        if($id != null){
            $this->db->where('supplier_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function tambah($post){
        $params = [
            'name' => $post['nama'],
            'phone' => $post['no_telpon'],
            'address' => $post['alamat'],
            'description' => empty($post['deskripsi']) ? null : $post['deskripsi']
        ];

        $user_id = $this->fungsi->user_login()->name;
        $name = $post['nama'];
        $no_telpon = $post['no_telpon'];
        $alamat = $post['alamat'];
        $description = $post['deskripsi'];

        $this->db->insert('supplier', $params);
        insert_log("Tambah Supplier | Nama : $name | No Telpon : $no_telpon | Alamat : $alamat | Deskripsi : $description" , $user_id);
    }

    public function ubah($post){
        $params = [
            'name' => $post['nama'],
            'phone' => $post['no_telpon'],
            'address' => $post['alamat'],
            'description' => empty($post['deskripsi']) ? null : $post['deskripsi'],
            'updated' => date('Y-m-d H:i:s')
        ];

        $user_id = $this->fungsi->user_login()->name;
        $name = $post['nama'];
        $no_telpon = $post['no_telpon'];
        $alamat = $post['alamat'];
        $description = $post['deskripsi'];

        $this->db->where('supplier_id', $post['id']);
        $this->db->update('supplier', $params);
        insert_log("Ubah Supplier | Nama : $name | No Telpon : $no_telpon | Alamat : $alamat | Deskripsi : $description" , $user_id);
    }

    public function hapus($id)
	{
        //DISINI AMBIL DATA SUPPLIER
        $q_supplier = $this->db->query("SELECT * FROM supplier WHERE supplier_id = '$id'")->result();

        //DEFINISIKAN VARIABEL KOSONG
        $name = "";
        $phone = "";
        $address = "";
        $description = "";
        foreach($q_supplier as $d_supplier)
        {
            $name = $d_supplier->name;
            $phone = $d_supplier->phone;
            $address = $d_supplier->address;
            $description = $d_supplier->description;
        }
        $user_id = $this->fungsi->user_login()->name;
        insert_log("Hapus Supplier | Nama : $name | No Telpon : $phone | Alamat : $address | Deskripsi : $description" , $user_id);
		$this->db->where('supplier_id', $id);
		$this->db->delete('supplier');
    }
    


}