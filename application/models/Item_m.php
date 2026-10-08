<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class item_m extends CI_Model {

    public function get($id = null)
    {
        $this->db->select('item.*, category.name as category_name, unit.name as unit_name');
        $this->db->from('item');
        $this->db->join('category','category.category_id = item.category_id');
        $this->db->join('unit','unit.unit_id = item.unit_id');
        if($id != null){
            $this->db->where('item_id', $id);
        }
        $this->db->order_by('barcode','asc');
        $query = $this->db->get();
        return $query;
    }

    public function tambah($post){
        $params = [
            'barcode' => $post['barcode'],
            'name' => $post['nama'],
            'category_id' => $post['category'],
            'unit_id' => $post['unit'],
            'price' => $post['harga'],
            'image' => $post['image'],
        ];

        $user_id = $this->fungsi->user_login()->name;
        $barcode = $post['barcode'];
        $name = $post['nama'];
        $category_id = $post['category'];
        $unit_id = $post['unit'];
        $price = $post['harga'];
        $image = $post['image'];

        $this->db->insert('item', $params);
        insert_log("Tambah Item | Kode Item : $barcode | Nama Item : $name | Kategory : $category_id | Satuan : $unit_id | Harga : $price | Gambar Item : $image" , $user_id);
    }

    public function ubah($post){ 
        $params = [
            'barcode' => $post['barcode'],
            'name' => $post['nama'],
            'category_id' => $post['category'],
            'unit_id' => $post['unit'],
            'price' => $post['harga'],
            'updated' => date('Y-m-d H:i:s')
        ];
        if($post['image'] != null){
            $params['image'] = $post['image'];
        }

        $user_id = $this->fungsi->user_login()->name;
        $barcode = $post['barcode'];
        $name = $post['nama'];
        $category_id = $post['category'];
        $unit_id = $post['unit'];
        $price = $post['harga'];
        $image = $post['image'];

        $this->db->where('item_id', $post['id']);
        $this->db->update('item', $params);

        insert_log("Ubah Item | Kode Item : $barcode | Nama Item : $name | Kategory : $category_id | Satuan : $unit_id | Harga : $price | Gambar Item : $image" , $user_id);
    }

    public function check_barcode($code, $id=null){
        $this->db->from('item');
        $this->db->where('barcode',$code);
        if($id != null){
            $this->db->where('item_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE item SET stock = stock + '$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }

    public function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE item SET stock = stock - '$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }

    public function hapus($id)
	{
        //DISINI AMBIL DATA ITEM
        $q_item = $this->db->query("SELECT * FROM item WHERE item_id = '$id'")->result();

        //DEFINISIKAN VARIABEL KOSONG
        $barcode = "";
        $name = "";
        $category_id = "";
        $unit_id = "";
        $price = "";
        $image = "";

        foreach($q_item as $d_item)
        {
            $barcode = $d_item->barcode;
            $name = $d_item->name;
            $category_id = $d_item->category_id;
            $unit_id = $d_item->unit_id;
            $price = $d_item->price;
            $image = $d_item->image;
        }
        $user_id = $this->fungsi->user_login()->name;

		$this->db->where('item_id', $id);
		$this->db->delete('item');

        insert_log("Hapus Item | Kode Item : $barcode | Nama Item : $name | Kategory : $category_id | Satuan : $unit_id | Harga : $price | Gambar Item : $image" , $user_id);
    }
}