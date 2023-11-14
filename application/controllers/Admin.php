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

        $this->session->set_flashdata('success', 'Barang berhasil ditambahkan');
        return redirect('admin/barang');
    }

    public function kendaraan()
    {
        $data['title'] = 'SPRS | Kendaraan';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['kendaraan'] = $this->db->get('kendaraan')->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/kendaraan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function kendaraan_save()
    {
        $data_kendaraan = [
            'nama' => $this->input->post('nama'),
            'stok' => $this->input->post('stok'),
            'lokasi' => $this->input->post('lokasi')
        ];
        $this->db->insert('kendaraan', $data_kendaraan);

        $this->session->set_flashdata('success', 'Kendaraan berhasil ditambahkan');
        return redirect('admin/kendaraan');
    }
    public function ruangan()
    {
        $data['title'] = 'SPRS | Ruangan';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['ruangan'] = $this->db->get('ruangan')->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/ruangan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function ruangan_save()
    {
        if (!empty($_FILES['foto_ruangan']['name'])) {
            $files = $_FILES['foto_ruangan'];

            // foreach ($files['tmp_name'] as $key => $tmp_name) {
            // }
            $fileContent = file_get_contents($files['tmp_name']);
            $base64File = base64_encode($fileContent);

            $image = 'data:image/png;base64,' . $base64File;
            $data_ruangan = [
                'nama' => $this->input->post('nama'),
                'lokasi' => $this->input->post('lokasi'),
                'foto_ruangan' => $image
            ];
            $this->db->insert('ruangan', $data_ruangan);

            unset($data['base64_files']);
            $this->session->set_flashdata('success', 'Ruangan berhasil ditambahkan');
            return redirect('admin/ruangan');
        } else {
            $this->session->set_flashdata('error', 'Ruangan gagal ditambahkan karena foto');
            redirect('admin/ruangan');
        }
    }
}
