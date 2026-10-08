<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir_m extends CI_Model {

    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no 
                FROM kasir 
                WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
        $query = $this->db->query($sql);

        if($query->num_rows() > 0){
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        }else{
            $no = "0001";
        }
        $invoice = "MM".date('ymd').$no;
        return $invoice;
    }

    public function get_cart($params = null){
        $this->db->select('*, item.name as item_name, cart.price as cart_price ');
        $this->db->from('cart');
        $this->db->join('item','cart.item_id = item.item_id');
        if($params != null){
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }
    
    public function tambah_keranjang($post)
    {
        $query = $this->db->query("SELECT MAX(cart_id) AS cart_no FROM cart");
        if($query->num_rows() > 0){
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1 ; 
        } else {
            $car_no = "1";
        }

        $params = array(
            'cart_id' => $car_no,
            'item_id' => $post['item_id'],
            'price' => $post['price'],
            'qty' => $post['qty'],
            'discount_item' => 0,
            'total' => ($post['price'] * $post['qty']),
            'user_id' => $this->session->userdata('userid')
        );
        $this->db->insert('cart', $params);
    }

    public function update_cart_qty($post)
    {
        $sql = "UPDATE cart SET price = '$post[price]',
                qty = qty + '$post[qty]',
                total = '$post[price]' * qty
                WHERE item_id = '$post[item_id]'";
        $this->db->query($sql);
    }

    public function del_cart($params = null)
    {
        if($params != null){
            $this->db->where($params);
        }
        $this->db->delete('cart');
    }

    public function edit_cart($post)
    {
        $params = array(
            'price' => $post['price'],
            'qty' => $post['qty'],
            'discount_item' => $post['discount'],
            'total' => $post['total'],
        );
        $this->db->where('cart_id', $post['cart_id']);
        $this->db->update('cart', $params);
    }

    public function pembelian($post)
    {
        $params = array(
            'invoice' => $this->invoice_no(),
            'customer_id' => $post['customer_id'],
            'total_price' => $post['subtotal'],
            'discount' => $post['discount'],
            'final_price' => $post['grandtotal'],
            'cash' => $post['cash'],
            'remaining' => $post['change'],
            'note' => $post['note'],
            'no_meja' => $post['no_meja'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid')
        );
        $this->db->insert('kasir', $params);
        return $this->db->insert_id();
    }

    public function pembelian_detail($params)
    {
        $this->db->insert_batch('kasir_detail',$params);
    }

    public function get_kasir($id = null)
    {
        $this->db->select('*, customer.name as customer_name, user.username as user_name, kasir.created as kasir_created');
        $this->db->from('kasir');
        $this->db->join('customer', 'kasir.customer_id = customer.customer_id', 'left');
        $this->db->join('user', 'kasir.user_id = user.user_id');
        if($id != null){
            $this->db->where('kasir_id', $id);
        }
        $this->db->order_by('date','desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_kasir_detail($kasir_id = null)
    {
        $this->db->from('kasir_detail');
        $this->db->join('item', 'kasir_detail.item_id = item.item_id');
        if($kasir_id != null){
            $this->db->where('kasir_detail.kasir_id', $kasir_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function del_kasir($id)
    {
        $this->db->where('kasir_id',$id);
        $this->db->delete('kasir');
    }

}