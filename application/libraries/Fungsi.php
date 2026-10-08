<?php

Class Fungsi {
    protected $ci;

    function __construct()
    {
        $this->ci =& get_instance();
    }

    function user_login(){
        $this->ci->load->model('user_m');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->user_m->get($user_id)->row();
        return $user_data;
    }

    function get_setting(){
        if ($this->ci->db->table_exists('settings')) {
            $setting = $this->ci->db->get_where('settings', ['id' => 1])->row();
            if($setting) return $setting;
        }
        // Default if table doesn't exist or empty
        return (object)['nama_usaha' => 'KopiPOS', 'alamat' => 'Alamat Usaha', 'telepon' => '-', 'logo' => null];
    }

    function PdfGenerator($html, $filename, $paper, $orientation)
    {
        $dompdf = new Dompdf\Dompdf();
        $dompdf -> loadHtml($html);
        $dompdf -> setPaper ($paper, $orientation);
        $dompdf -> render();
        $dompdf -> stream($filename, array('Attachment' => 0));
    }

    function count_item(){
        $this->ci->load->model('item_m');
        $query = $this->ci->item_m->get();
        return $query ? $query->num_rows() : 0;
    }
    function count_supplier(){
        $this->ci->load->model('supplier_m');
        $query = $this->ci->supplier_m->get();
        return $query ? $query->num_rows() : 0;
    }
    function count_customer(){
        $this->ci->load->model('customer_m');
        $query = $this->ci->customer_m->get();
        return $query ? $query->num_rows() : 0;
    }
    
    function count_transaction(){
        $query = $this->ci->db->get('kasir');
        return $query ? $query->num_rows() : 0;
    }

    function count_user(){
        $this->ci->load->model('user_m');
        $query = $this->ci->user_m->get();
        return $query ? $query->num_rows() : 0;
    }

    function total_pendapatan(){
        $this->ci->db->select_sum('final_price');
        $query = $this->ci->db->get('kasir');
        return ($query && $query->row()->final_price) ? $query->row()->final_price : 0;
    }

    function pendapatan_hari_ini(){
        $this->ci->db->select_sum('final_price');
        $this->ci->db->where('date', date('Y-m-d'));
        $query = $this->ci->db->get('kasir');
        return ($query && $query->row()->final_price) ? $query->row()->final_price : 0;
    }
}