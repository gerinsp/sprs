<?php

class Pegawai extends CI_Controller
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

    public function permintaan()
    {
        $data['title'] = 'SPRS | Permintaan';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['ruangan'] = $this->db
            ->select('pinjam_ruangan.id_pinjam_ruangan, user.nama AS peminjam, pinjam_ruangan.waktu AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan')
            ->join('user', 'user.id_user = pinjam_ruangan.id_peminjam', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan', 'left')
            ->where('is_finish', 0)
            ->where('status', 'menunggu')
            ->get('pinjam_ruangan')
            ->result();

        $data['kendaraan'] = $this->db
            ->select('pinjam_kendaraan.id_pinjam_kendaraan, user.nama AS peminjam, pinjam_kendaraan.waktu AS waktu_pinjam, kendaraan.nama AS nama_kendaraan,  pinjam_kendaraan.kilometer_awal, supir.nama as nama_supir')
            ->join('user', 'user.id_user = pinjam_kendaraan.id_peminjam', 'left')
            ->join('kendaraan', 'kendaraan.id_kendaraan = pinjam_kendaraan.id_kendaraan', 'left')
            ->join('supir', 'supir.id_supir = pinjam_kendaraan.id_supir', 'left')
            ->where('is_finish', 0)
            ->where('status', 'menunggu')
            ->get('pinjam_kendaraan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/pegawai/permintaan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }

    public function approve_kendaraan($id_pinjam_kendaraan)
    {
        $this->db->where('id_pinjam_kendaraan', $id_pinjam_kendaraan)->update('pinjam_kendaraan', [
            'id_user_confirm' => $this->session->userdata('id_user'),
            'pesan' => '',
            'status' => 'diterima'
        ]);
        $this->session->set_flashdata('success', 'Data berhasil dikonfirmasi');
        redirect('/pegawai/permintaan');
    }
    public function approve_ruangan($id_pinjam_ruangan)
    {
        $this->db->where('id_pinjam_ruangan', $id_pinjam_ruangan)->update('pinjam_ruangan', [
            'id_user_confirm' => $this->session->userdata('id_user'),
            'pesan' => '',
            'status' => 'diterima'
        ]);
        $this->session->set_flashdata('success', 'Data berhasil dikonfirmasi');
        redirect('/pegawai/permintaan');
    }
    public function tolak_kendaraan()
    {
        $pesan = $this->input->post('pesan');
        $id_user_confirm = $this->input->post('id_user_confirm');
        $id_pinjam_kendaraan = $this->input->post('id_pinjam_kendaraan');
        $this->db->where('id_pinjam_kendaraan', $id_pinjam_kendaraan)->update('pinjam_kendaraan', [
            'id_user_confirm' => $id_user_confirm,
            'pesan' => $pesan,
            'status' => 'ditolak'
        ]);
        $response = array(
            'status' => 'ok',
            'data' => null
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
    public function tolak_ruangan()
    {
        $pesan = $this->input->post('pesan');
        $id_user_confirm = $this->input->post('id_user_confirm');
        $id_pinjam_ruangan = $this->input->post('id_pinjam_ruangan');
        $this->db->where('id_pinjam_ruangan', $id_pinjam_ruangan)->update('pinjam_ruangan', [
            'id_user_confirm' => $id_user_confirm,
            'pesan' => $pesan,
            'status' => 'ditolak'
        ]);
        $response = array(
            'status' => 'ok',
            'data' => null
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function peminjaman()
    {
        $data['title'] = 'SPRS | Peminjaman';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['ruangan'] = $this->db
            ->select('pinjam_ruangan.id_pinjam_ruangan, user.nama AS peminjam, pinjam_ruangan.waktu AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan')
            ->join('user', 'user.id_user = pinjam_ruangan.id_peminjam', 'left')
            ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan', 'left')
            ->where('is_finish', 0)
            ->where('status', 'menunggu')
            ->get('pinjam_ruangan')
            ->result();

        $data['kendaraan'] = $this->db
            ->select('pinjam_kendaraan.id_pinjam_kendaraan, user.nama AS peminjam, pinjam_kendaraan.waktu AS waktu_pinjam, kendaraan.nama AS nama_kendaraan,  pinjam_kendaraan.kilometer_awal, supir.nama as nama_supir')
            ->join('user', 'user.id_user = pinjam_kendaraan.id_peminjam', 'left')
            ->join('kendaraan', 'kendaraan.id_kendaraan = pinjam_kendaraan.id_kendaraan', 'left')
            ->join('supir', 'supir.id_supir = pinjam_kendaraan.id_supir', 'left')
            ->where('is_finish', 0)
            ->where('status', 'menunggu')
            ->get('pinjam_kendaraan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/pegawai/permintaan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
}