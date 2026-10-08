<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_m extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('customer');
        if($id != null){
            $this->db->where('customer_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function tambah($post)
    {
        $params = [
            'name' => $post['nama'],
            'gender' => $post['jk'],
            'phone' => $post['no_telpon'],
            'address' => $post['alamat'],
        ];
        $user_id = $this->fungsi->user_login()->name;
        $name = $post['nama'];
        $gender = $post['jk'];
        $phone = $post['no_telpon'];
        $address = $post['alamat'];

        $this->db->insert('customer', $params);
        insert_log("Tambah Customer | Nama : $name | No Telpon : $phone | Alamat : $address | Jenis Kelamin : $gender" , $user_id);
    }

    public function ubah($post)
    { 
        $params = [
            'name' => $post['nama'],
            'gender' => $post['jk'],
            'phone' => $post['no_telpon'],
            'address' => $post['alamat'],
            'updated' => date('Y-m-d H:i:s')
        ];

        $user_id = $this->fungsi->user_login()->name;
        $name = $post['nama'];
        $gender = $post['jk'];
        $phone = $post['no_telpon'];
        $address = $post['alamat'];

        $this->db->where('customer_id', $post['id']);
        $this->db->update('customer', $params);

        insert_log("Ubah Customer | Nama : $name | No Telpon : $phone | Alamat : $address | Jenis Kelamin : $gender" , $user_id);
    }

    public function hapus($id)
	{
        //DISINI AMBIL DATA CUSTOMER
        $q_customer = $this->db->query("SELECT * FROM customer WHERE customer_id = '$id'")->result();

        //DEFINISIKAN VARIABEL KOSONG
        $name = "";
        $phone = "";
        $address = "";
        $gender = "";
        foreach($q_customer as $d_customer)
        {
            $name = $d_customer->name;
            $phone = $d_customer->phone;
            $address = $d_customer->address;
            $gender = $d_customer->gender;
        }
        $user_id = $this->fungsi->user_login()->name;
        
		$this->db->where('customer_id', $id);
		$this->db->delete('customer');

        insert_log("Hapus Customer | Nama : $name | No Telpon : $phone | Alamat : $address | Jenis Kelamin : $gender" , $user_id);
    }
}