<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('item_m');
        $this->load->model('stock_m');
        check_not_login();
    }

    public function stock_in_data()
    {
        $data['row'] = $this->stock_m->get_stock_in()->result();
        $this->template->load('template', 'transaksi/stock_in/stock_in_data', $data);
    }

    public function stock_in_tambah()
    {
        $item = $this->item_m->get()->result();
        $data = ['item' => $item];
        $this->template->load('template', 'transaksi/stock_in/stock_in_form', $data);
    }

    public function proses()
    {
        if (isset($_POST['in_add'])) {
            $post = $this->input->post(null, TRUE);
            $this->stock_m->tambah_stock_in($post);
            $this->item_m->update_stock_in($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
            }
            redirect('stock/in');
        }
    }

    public function stock_in_hapus()
    {
        $stock_id = $this->uri->segment(4);
        $item_id = $this->uri->segment(5);
        $qty = $this->stock_m->get($stock_id)->row()->qty;
        $data = ['qty' => $qty, 'item_id' => $item_id];
        $this->item_m->update_stock_out($data);
        $this->stock_m->hapus($stock_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
        }
        redirect('stock/in');
    }

    public function stock_out_data()
    {
        $data['row'] = $this->stock_m->get_stock_out()->result();
        $this->template->load('template', 'transaksi/stock_out/stock_out_data', $data);
    }

    public function stock_out_tambah()
    {
        $item = $this->item_m->get()->result();
        $data = ['item' => $item];
        $this->template->load('template', 'transaksi/stock_out/stock_out_form', $data);
    }

    public function proses_out()
    {
        if (isset($_POST['out_add'])) {
            $post = $this->input->post(null, TRUE);
            $this->stock_m->tambah_stock_out($post);
            $this->item_m->update_stock_out($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
            }
            redirect('stock/out');
        }
    }

    public function stock_out_hapus()
    {
        $stock_id = $this->uri->segment(4);
        $item_id = $this->uri->segment(5);
        $qty = $this->stock_m->get($stock_id)->row()->qty;
        $data = ['qty' => $qty, 'item_id' => $item_id];
        $this->item_m->update_stock_out($data);
        $this->stock_m->hapus($stock_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
        }
        redirect('stock/out');
    }
}
