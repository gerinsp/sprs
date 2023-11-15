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

    public function peminjam()
    {
        $data['title'] = 'SPRS | Peminjam';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['peminjam'] = $this->db->get_where('user', ['id_role' => 4])->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/peminjam', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function peminjam_save()
    {
        if (!empty($_FILES['image']['tmp_name'])) {
            $files = $_FILES['image'];

            $fileContent = file_get_contents($files['tmp_name']);
            $base64File = base64_encode($fileContent);

            $image = 'data:image/png;base64,' . $base64File;
            $data_peminjam = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => $image,
                'id_role' => 4,
                'is_active' => 1,
                'created_at' => date('Y-m-d')
            ];
            $this->db->insert('user', $data_peminjam);

            unset($data['base64_files']);
            $this->session->set_flashdata('success', 'Peminjam berhasil ditambahkan');
            return redirect('admin/peminjam');
        } else {
            $this->session->set_flashdata('error', 'Ruangan gagal ditambahkan karena foto');
            redirect('admin/peminjam');
        }
    }

    public function supir()
    {
        $data['title'] = 'SPRS | Supir';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['supir'] = $this->db->get('supir')->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/supir', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function supir_save()
    {
        if (!empty($_FILES['foto_sim']['tmp_name'])) {
            $files = $_FILES['foto_sim'];

            $fileContent = file_get_contents($files['tmp_name']);
            $base64File = base64_encode($fileContent);

            $image = 'data:image/png;base64,' . $base64File;
            $data_peminjam = [
                'nama' => $this->input->post('nama'),
                'ttl' => $this->input->post('ttl'),
                'foto_sim' => $image
            ];
            $this->db->insert('supir', $data_peminjam);

            unset($data['base64_files']);
            $this->session->set_flashdata('success', 'Supir berhasil ditambahkan');
            return redirect('admin/supir');
        } else {
            $this->session->set_flashdata('error', 'Ruangan gagal ditambahkan karena foto');
            redirect('admin/supir');
        }
    }

    public function peminjaman_harian()
    {
        $data['title'] = 'SPRS | Laporan Barang Harian';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['barang'] = $this->db
            ->select('pinjam_barang.created_at AS waktu_pinjam, pinjam_barang.quantity, peminjam.nama AS peminjam, penerima.nama AS penerima, barang.nama AS nama_barang')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->where('is_takeaway', 0)
            ->where('is_finish', 1)
            ->get('pinjam_barang')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/peminjaman-harian', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function peminjaman_pulang()
    {
        $data['title'] = 'SPRS | Laporan Barang Pulang';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['barang'] = $this->db
            ->select('peminjam.nama AS peminjam, pinjam_barang.created_at AS waktu_pinjam, barang.nama AS nama_barang, pinjam_barang.quantity, pinjam_barang.alasan_pinjam, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->where('is_takeaway', 1)
            ->where('is_finish', 1)
            ->get('pinjam_barang')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/peminjaman-pulang', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function peminjaman_kendaraan()
    {
        $data['title'] = 'SPRS | Laporan Kendaraan';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['kendaraan'] = $this->db
            ->select('peminjam.nama AS peminjam, pinjam_kendaraan.waktu AS waktu_pinjam, kendaraan.nama AS nama_kendaraan, pinjam_kendaraan.kilometer_awal, supir.nama AS nama_supir, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_kendaraan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_kendaraan.id_user_confirm')
            ->join('kendaraan', 'kendaraan.id_kendaraan = pinjam_kendaraan.id_kendaraan')
            ->join('supir', 'supir.id_supir = pinjam_kendaraan.id_supir')
            ->where('is_finish', 1)
            ->get('pinjam_kendaraan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/peminjaman-kendaraan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function peminjaman_ruangan()
    {
        $data['title'] = 'SPRS | Laporan Ruangan';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['ruangan'] = $this->db
            ->select('peminjam.nama AS peminjam, pinjam_ruangan.waktu AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_ruangan.id_user_confirm')
            ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
            ->where('is_finish', 1)
            ->get('pinjam_ruangan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/peminjaman-ruangan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function peminjaman()
    {
        $data['title'] = 'SPRS | Peminjaman';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['barang_harian'] = $this->db
            ->select('pinjam_barang.created_at AS waktu_pinjam, pinjam_barang.quantity, peminjam.nama AS peminjam, penerima.nama AS penerima, barang.nama AS nama_barang')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->where('is_takeaway', 0)
            ->where('is_finish', 0)
            ->get('pinjam_barang')
            ->result();

        $data['barang_pulang'] = $this->db
            ->select('peminjam.nama AS peminjam, pinjam_barang.created_at AS waktu_pinjam, barang.nama AS nama_barang, pinjam_barang.quantity, pinjam_barang.alasan_pinjam, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->where('is_takeaway', 1)
            ->where('is_finish', 0)
            ->get('pinjam_barang')
            ->result();

        $data['kendaraan'] = $this->db
            ->select('peminjam.nama AS peminjam, pinjam_kendaraan.waktu AS waktu_pinjam, kendaraan.nama AS nama_kendaraan, pinjam_kendaraan.kilometer_awal, supir.nama AS nama_supir, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_kendaraan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_kendaraan.id_user_confirm')
            ->join('kendaraan', 'kendaraan.id_kendaraan = pinjam_kendaraan.id_kendaraan')
            ->join('supir', 'supir.id_supir = pinjam_kendaraan.id_supir')
            ->where('is_finish', 0)
            ->get('pinjam_kendaraan')
            ->result();

        $data['ruangan'] = $this->db
            ->select('peminjam.nama AS peminjam, pinjam_ruangan.waktu AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_ruangan.id_user_confirm')
            ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
            ->where('is_finish', 1)
            ->get('pinjam_ruangan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/peminjaman', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
}
