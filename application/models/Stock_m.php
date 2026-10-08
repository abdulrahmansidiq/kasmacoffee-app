<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_m extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('stock');
        if($id != null){
            $this->db->where('stock_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_stock()
    {
        $this->db->select('stock.stock_id, item.barcode, item.name as item_name,type, qty, date, detail, item.item_id');
        $this->db->from('stock');
        $this->db->join('item','stock.item_id = item.item_id');
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_stock_in()
    {
        $this->db->select('stock.stock_id, item.barcode, item.name as item_name, qty, date, detail, item.item_id');
        $this->db->from('stock');
        $this->db->join('item','stock.item_id = item.item_id');
        $this->db->where('type','in');
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }
    
    public function tambah_stock_in($post)
    {
        $params = [
            'item_id' => $post['item_id'],
            'type' => 'in',
            'detail' => $post['detail'],
            'qty' => $post['qty'],
            'date' => $post['tanggal'],
            'user_id' => $this->session->userdata('userid')
        ];
        $user_id = $this->fungsi->user_login()->name;
        $type = 'Masuk' ;
        $item_id = $post['item_id'];
        $detail = $post['detail'];
        $qty = $post['qty'];
        $tanggal = $post['tanggal'];

        $this->db->insert('stock', $params);
        insert_log("Stock Masuk | Item : $item_id | Type : $type | Detail : $detail | Qty : $qty | Tanggal : $tanggal" , $user_id);
    }

    public function get_stock_out()
    {
        $this->db->select('stock.stock_id, item.barcode, item.name as item_name, qty, date, detail,item.item_id');
        $this->db->from('stock');
        $this->db->join('item','stock.item_id = item.item_id');
        $this->db->where('type','out');
        $this->db->order_by('stock_id','desc');
        $query = $this->db->get();
        return $query;
    }

    public function tambah_stock_out($post)
    {
        $params = [
            'item_id' => $post['item_id'],
            'type' => 'out',
            'detail' => $post['detail'],
            'qty' => $post['qty'],
            'date' => $post['tanggal'],
            'user_id' => $this->session->userdata('userid')
        ];

        $user_id = $this->fungsi->user_login()->name;
        $item_id = $post['item_id'];
        $type = 'Keluar' ;
        $detail = $post['detail'];
        $qty = $post['qty'];
        $tanggal = $post['tanggal'];

        $this->db->insert('stock', $params);
        insert_log("Stock Keluar | Item : $item_id | Type : $type | Detail : $detail | Qty : $qty | Tanggal : $tanggal" , $user_id);
    }

    public function hapus($id)
    {
        $this->db->where('stock_id', $id);
        $this->db->delete('stock');
    }
}