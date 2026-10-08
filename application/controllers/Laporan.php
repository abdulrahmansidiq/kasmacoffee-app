<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_m');
        $this->load->model('kasir_m');
        $this->load->model('stock_m');
        $this->load->model('item_m');
        check_not_login();
    }

    public function laporan_kasir()
    {
        $data['row'] = $this->item_m->get();
        $this->template->load('template', 'laporan/laporan_kasir', $data);
    }

    public function cetak_laporan_kasir()
    {
        $this->load->view('laporan/cetak_laporan_kasir');
    }

    public function laporan_stock()
    {
        $data['item'] = $this->item_m->get();
        $this->template->load('template', 'laporan/laporan_stock', $data);
    }

    public function cetak_laporan_stock()
    {
        $this->load->view('laporan/cetak_laporan_stock');
    }

    public function laporan_stock_keluar()
    {
        $data['item'] = $this->item_m->get();
        $this->template->load('template', 'laporan/laporan_stock_keluar', $data);
    }

    public function cetak_laporan_stock_keluar()
    {
        $this->load->view('laporan/cetak_laporan_stock_keluar');
    }
}
