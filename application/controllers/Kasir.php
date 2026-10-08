<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('kasir_m');
    }

    public function index()
    {
        $this->load->model(['customer_m', 'item_m']);
        $customer = $this->customer_m->get()->result();
        $item = $this->item_m->get()->result();
        $cart = $this->kasir_m->get_cart();
        $data = array(
            'customer' => $customer,
            'item' => $item,
            'cart' => $cart,
            'invoice' => $this->kasir_m->invoice_no(),
        );
        $this->template->load('template', 'transaksi/kasir/kasir_form', $data);
    }

    public function proses()
    {
        $data = $this->input->post(null, TRUE);

        if (isset($_POST['add_cart'])) {

            $item_id = $this->input->post('item_id');

            $check_cart = $this->kasir_m->get_cart(['cart.item_id' => $item_id])->num_rows();
            if ($check_cart > 0) {
                $this->kasir_m->update_cart_qty($data);
            } else {
                $this->kasir_m->tambah_keranjang($data);
            }

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }

        if (isset($_POST['edit_cart'])) {
            $this->kasir_m->edit_cart($data);
            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }

        if (isset($_POST['proses_pembelian'])) {
            $kasir_id = $this->kasir_m->pembelian($data);
            $cart = $this->kasir_m->get_cart()->result();
            $row = [];
            foreach ($cart as $c => $value) {
                array_push($row, array(
                    'kasir_id' => $kasir_id,
                    'item_id' => $value->item_id,
                    'price' => $value->price,
                    'qty' => $value->qty,
                    'discount_item' => $value->discount_item,
                    'total' => $value->total
                ));
            }
            $this->kasir_m->pembelian_detail($row);
            $this->kasir_m->del_cart(['user_id' => $this->session->userdata('userid')]);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true, "kasir_id" => $kasir_id);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }

    public function cart_data()
    {
        $cart = $this->kasir_m->get_cart();
        $data['cart'] = $cart;
        $this->load->view('transaksi/kasir/cart_data', $data);
    }

    public function cart_del()
    {
        if (isset($_POST['batal_pembelian'])) {
            $this->kasir_m->del_cart(['user_id' => $this->session->userdata('userid')]);
        } else {
            $cart_id = $this->input->post('cart_id');
            $this->kasir_m->del_cart(['cart_id' => $cart_id]);
        }

        if ($this->db->affected_rows() > 0) {
            $params = array("success" => true);
        } else {
            $params = array("success" => false);
        }
        echo json_encode($params);
    }

    public function cetak($id)
    {
        $data = array(
            'kasir' => $this->kasir_m->get_kasir($id)->row(),
            'kasir_detail' => $this->kasir_m->get_kasir_detail($id)->result()
        );
        $this->load->view('transaksi/kasir/cetak_struk', $data);
    }

    public function del($id)
    {
        $this->kasir_m->del_kasir($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
                    alert('Data Penjualan Berhasil Dihapus');
                    window.location='" . site_url('report/kasir') . "';
                </script>";
        } else {
            echo "<script>
                    alert('Data Penjualan Gagal Dihapus');
                    window.location='" . site_url('report/kasir') . "';
                </script>";
        }
    }
}
