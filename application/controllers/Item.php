<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('item_m');
        $this->load->model('category_m');
        $this->load->model('unit_m');
        check_not_login();
    }

    public function index()
    {
        $data['row'] = $this->item_m->get();
        $this->template->load('template', 'produk/item/item_data', $data);
    }

    public function tambah()
    {
        $item = new stdClass();
        $item->item_id = null;
        $item->barcode = null;
        $item->name = null;
        $item->price = null;
        $item->category_id = null;

        $query_category = $this->category_m->get();

        $query_unit = $this->unit_m->get();
        $unit[null] = '- Pilih -';
        foreach ($query_unit->result() as $u) {
            $unit[$u->unit_id] = $u->name;
        }

        $data = array(
            'page' => 'tambah',
            'row' => $item,
            'category' => $query_category,
            'unit' => $unit, 'selectedunit' => null,
        );
        $this->template->load('template', 'produk/item/item_form', $data);
    }

    public function ubah($id)
    {
        $query = $this->item_m->get($id);
        if ($query->num_rows() > 0) {
            $item = $query->row();
            $query_category = $this->category_m->get();

            $query_unit = $this->unit_m->get();
            $unit[null] = '- Pilih -';
            foreach ($query_unit->result() as $u) {
                $unit[$u->unit_id] = $u->name;
            }

            $data = array(
                'page' => 'ubah',
                'row' => $item,
                'category' => $query_category,
                'unit' => $unit, 'selectedunit' => $item->unit_id,
            );
            $this->template->load('template', 'produk/item/item_form', $data);
        } else {
?>
            <script type="text/javascript">
                alert('Data Tidak Ditemukan');
                window.location = "<?= site_url('item'); ?>";
            </script>
<?php
        }
    }

    public function proses()
    {
        $config['upload_path']    = './uploads/produk/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['max_size']       = 10000;
        $config['file_name']      = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);
        if (isset($_POST['tambah'])) {
            if ($this->item_m->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Data Kode Item $post[barcode] Sudah Dipakai");
                redirect('item/tambah');
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->item_m->tambah($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
                        }
                        redirect('item');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('item/tambah');
                    }
                } else {
                    $post['image'] = null;
                    $this->item_m->tambah($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
                    }
                    redirect('item');
                }
            }
        } else if (isset($_POST['ubah'])) {
            if ($this->item_m->check_barcode($post['barcode'], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Data Barcode $post[barcode] Sudah Dipakai");
                redirect('item/ubah/' . $post['id']);
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $item = $this->item_m->get($post['id'])->row();
                        if ($item->image != null) {
                            $target_file = './uploads/produk/' . $item->image;
                            unlink($target_file);
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->item_m->ubah($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
                        }
                        redirect('item');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('item/tambah');
                    }
                } else {
                    $post['image'] = null;
                    $this->item_m->ubah($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
                    }
                    redirect('item');
                }
            }
        }
    }


    public function hapus($id)
    {
        $this->item_m->hapus($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Berhasil Dihapus');
        }
        redirect('item');
    }
}
