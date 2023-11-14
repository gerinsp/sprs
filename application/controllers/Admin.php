<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'm');
        cekuser();
        // dd($this->session->userdata('nama'));
    }

    public function index()
    {
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['title'] = 'SPRS | Dashboard';

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/dashboard', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function barang()
    {
        $data['title'] = 'SPRS | Barang';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['barang'] = $this->db->get('barang')->result();


        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/barang', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function barang_save()
    {
        $data_barang = [
            'nama' => $this->input->post('nama'),
            'kode' => $this->input->post('kode'),
            'stok' => $this->input->post('stok'),
            'lokasi' => $this->input->post('lokasi'),
            'kondisi' => $this->input->post('kondisi')
        ];
        $this->db->insert('barang', $data_barang);

        $this->session->set_flashdata('success', 'Berhasil menambahkan barang');
        return redirect('admin/barang');
    }
}
