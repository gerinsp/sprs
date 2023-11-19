<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'm');
        cekuser();
        date_default_timezone_set('Asia/Jakarta');
        // dd($this->session->userdata('nama'));
    }

    public function index()
    {
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');
        $data['title'] = 'SPRS | Dashboard';

        $data['kendaraan'] = $this->db->from('pinjam_kendaraan')->where('is_finish', 0)->count_all_results();
        $data['barang_harian'] = $this->db->from('pinjam_barang')->where('is_takeaway', 0)->where('is_finish', 0)->count_all_results();
        $data['barang_pulang'] = $this->db->from('pinjam_barang')->where('is_takeaway', 1)->where('is_finish', 0)->count_all_results();
        $data['ruangan'] = $this->db->from('pinjam_ruangan')->where('is_finish', 0)->count_all_results();
        $data['supir'] = $this->db->from('supir')->count_all_results();
        $data['peminjam'] = $this->db->from('user')->where('id_role', 4)->count_all_results();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/dashboard', $data);
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
            ->select('pinjam_barang.id_pinjam_barang, pinjam_barang.created_at AS waktu_pinjam, pinjam_barang.quantity, peminjam.nama AS peminjam, penerima.nama AS penerima, barang.nama AS nama_barang')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->where('is_takeaway', 0)
            ->where('is_finish', 0)
            ->where('status', 'diterima')
            ->get('pinjam_barang')
            ->result();

        $data['barang_pulang'] = $this->db
            ->select('pinjam_barang.id_pinjam_barang, peminjam.nama AS peminjam, pinjam_barang.created_at AS waktu_pinjam, barang.nama AS nama_barang, pinjam_barang.quantity, pinjam_barang.alasan_pinjam, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->where('is_takeaway', 1)
            ->where('is_finish', 0)
            ->where('status', 'diterima')
            ->get('pinjam_barang')
            ->result();

        $data['kendaraan'] = $this->db
            ->select('pinjam_kendaraan.id_pinjam_kendaraan, peminjam.nama AS peminjam, pinjam_kendaraan.waktu AS waktu_pinjam, kendaraan.nama AS nama_kendaraan, pinjam_kendaraan.kilometer_awal, supir.nama AS nama_supir, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_kendaraan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_kendaraan.id_user_confirm')
            ->join('kendaraan', 'kendaraan.id_kendaraan = pinjam_kendaraan.id_kendaraan')
            ->join('supir', 'supir.id_supir = pinjam_kendaraan.id_supir')
            ->where('is_finish', 0)
            ->where('status', 'diterima')
            ->get('pinjam_kendaraan')
            ->result();

        $data['ruangan'] = $this->db
            ->select('pinjam_ruangan.id_pinjam_ruangan, peminjam.nama AS peminjam, pinjam_ruangan.waktu AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_ruangan.id_user_confirm')
            ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
            ->where('is_finish', 0)
            ->where('status', 'diterima')
            ->get('pinjam_ruangan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/peminjaman', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function permintaan()
    {
        $data['title'] = 'SPRS | Peminjaman';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['barang_harian'] = $this->db
            ->select('pinjam_barang.id_pinjam_barang, pinjam_barang.created_at AS waktu_pinjam, pinjam_barang.quantity, peminjam.nama AS peminjam,  barang.nama AS nama_barang')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->where('is_takeaway', 0)
            ->where('is_finish', 0)
            ->where('status', 'menunggu')
            ->get('pinjam_barang')
            ->result();

        $data['barang_pulang'] = $this->db
            ->select('pinjam_barang.id_pinjam_barang, peminjam.nama AS peminjam, pinjam_barang.created_at AS waktu_pinjam, barang.nama AS nama_barang, pinjam_barang.quantity, pinjam_barang.alasan_pinjam')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->where('is_takeaway', 1)
            ->where('is_finish', 0)
            ->where('status', 'menunggu')
            ->get('pinjam_barang')
            ->result();

        $data['ruangan'] = $this->db
            ->select('pinjam_ruangan.id_pinjam_ruangan, peminjam.nama AS peminjam, pinjam_ruangan.waktu AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan')
            ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
            ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
            ->where('is_finish', 0)
            ->where('status', 'menunggu')
            ->get('pinjam_ruangan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/permintaan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function approve_harian($id_pinjam_barang)
    {
        $data_pinjam_barang = $this->db->get_where('pinjam_barang', ['id_pinjam_barang' => $id_pinjam_barang])->row();
        if ($data_pinjam_barang->is_takeaway == 1 || $data_pinjam_barang->is_finish == 1 || $data_pinjam_barang->status != 'menunggu') {
            $this->session->set_flashdata('error', 'Data tidak dalam antrian pinjam');
            return redirect('/admin/permintaan');
        }
        $barang = $this->db->get_where('barang', ['id_barang' => $data_pinjam_barang->id_barang])->row();
        $stok = (int)$barang->stok - (int)$data_pinjam_barang->quantity;
        $this->db->update('barang', ['stok' => $stok], ['id_barang' => $data_pinjam_barang->id_barang]);

        $this->db->update('pinjam_barang', ['status' => 'diterima', 'id_user_confirm' => $this->session->userdata('id_user')], ['id_pinjam_barang' => $id_pinjam_barang]);
        $this->session->set_flashdata('success', 'Data berhasil dikonfirmasi');
        return redirect('/admin/permintaan');
    }
    public function approve_pulang($id_pinjam_barang)
    {
        $data_pinjam_barang = $this->db->get_where('pinjam_barang', ['id_pinjam_barang' => $id_pinjam_barang])->row();
        if ($data_pinjam_barang->is_takeaway == 0 || $data_pinjam_barang->is_finish == 1 || $data_pinjam_barang->status != 'menunggu') {
            $this->session->set_flashdata('error', 'Data tidak dalam antrian pinjam');
            return redirect('/admin/permintaan');
        }

        $barang = $this->db->get_where('barang', ['id_barang' => $data_pinjam_barang->id_barang])->row();
        $stok = (int)$barang->stok - (int)$data_pinjam_barang->quantity;
        $this->db->update('barang', ['stok' => $stok], ['id_barang' => $data_pinjam_barang->id_barang]);

        $this->db->update('pinjam_barang', ['status' => 'diterima', 'id_user_confirm' => $this->session->userdata('id_user')], ['id_pinjam_barang' => $id_pinjam_barang]);
        $this->session->set_flashdata('success', 'Data berhasil dikonfirmasi');
        return redirect('/admin/permintaan');
    }
    public function approve_ruangan($id_pinjam_ruangan)
    {
        $data_pinjam_ruangan = $this->db->get_where('pinjam_ruangan', ['id_pinjam_ruangan' => $id_pinjam_ruangan])->row();
        if ($data_pinjam_ruangan->is_finish == 1 || $data_pinjam_ruangan->status != 'menunggu') {
            $this->session->set_flashdata('error', 'Data tidak dalam antrian pinjam');
            return redirect('/admin/permintaan');
        }

        $this->db->update('pinjam_ruangan', ['status' => 'diterima', 'id_user_confirm' => $this->session->userdata('id_user')], ['id_pinjam_ruangan' => $id_pinjam_ruangan]);
        $this->session->set_flashdata('success', 'Data berhasil dikonfirmasi');
        return redirect('/admin/permintaan');
    }
    public function penolakan_harian($id_pinjam_barang)
    {
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');
        $data['title'] = 'SPRS | Penolakan Pinjam Harian';

        $data['barang'] = $this->db
            ->select('pinjam_barang.id_pinjam_barang, pinjam_barang.created_at AS waktu_pinjam, pinjam_barang.quantity, peminjam.nama AS peminjam, barang.nama AS nama_barang')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->get_where('pinjam_barang', ['id_pinjam_barang' => $id_pinjam_barang])->row();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/penolakan-harian', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function tolak_harian($id_pinjam_barang)
    {
        $data_pinjam_barang = $this->db->get_where('pinjam_barang', ['id_pinjam_barang' => $id_pinjam_barang])->row();
        if ($data_pinjam_barang->is_takeaway == 1 || $data_pinjam_barang->is_finish == 1 || $data_pinjam_barang->status != 'menunggu') {
            $this->session->set_flashdata('error', 'Data tidak dalam antrian pinjam');
            return redirect('/admin/permintaan');
        }
        $this->db->update('pinjam_barang', ['status' => 'ditolak', 'id_user_confirm' => $this->session->userdata('id_user'), 'pesan' => $this->input->post('pesan')], ['id_pinjam_barang' => $id_pinjam_barang]);
        $this->session->set_flashdata('success', 'Data berhasil ditolak');
        return redirect('/admin/permintaan');
    }
    public function penolakan_pulang($id_pinjam_barang)
    {
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');
        $data['title'] = 'SPRS | Penolakan Pinjam Pulang';

        $data['barang'] = $this->db
            ->select('pinjam_barang.id_pinjam_barang, pinjam_barang.created_at AS waktu_pinjam, pinjam_barang.quantity, pinjam_barang.alasan_pinjam, peminjam.nama AS peminjam, barang.nama AS nama_barang')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->get_where('pinjam_barang', ['id_pinjam_barang' => $id_pinjam_barang])->row();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/penolakan-pulang', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function tolak_pulang($id_pinjam_barang)
    {
        $data_pinjam_barang = $this->db->get_where('pinjam_barang', ['id_pinjam_barang' => $id_pinjam_barang])->row();
        if ($data_pinjam_barang->is_takeaway == 0 || $data_pinjam_barang->is_finish == 1 || $data_pinjam_barang->status != 'menunggu') {
            $this->session->set_flashdata('error', 'Data tidak dalam antrian pinjam');
            return redirect('/admin/permintaan');
        }
        $this->db->update('pinjam_barang', ['status' => 'ditolak', 'id_user_confirm' => $this->session->userdata('id_user'), 'pesan' => $this->input->post('pesan')], ['id_pinjam_barang' => $id_pinjam_barang]);
        $this->session->set_flashdata('success', 'Data berhasil ditolak');
        return redirect('/admin/permintaan');
    }
    public function penolakan_ruangan($id_pinjam_ruangan)
    {
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');
        $data['title'] = 'SPRS | Penolakan Pinjam Ruangan';

        $data['ruangan'] = $this->db
            ->select('pinjam_ruangan.id_pinjam_ruangan, pinjam_ruangan.waktu, ruangan.nama AS nama_ruangan, acara, kebutuhan, keterangan, peminjam.nama AS peminjam')
            ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
            ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
            ->get_where('pinjam_ruangan', ['id_pinjam_ruangan' => $id_pinjam_ruangan])->row();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/penolakan-ruangan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function tolak_ruangan($id_pinjam_ruangan)
    {
        $data_pinjam_ruangan = $this->db->get_where('pinjam_ruangan', ['id_pinjam_ruangan' => $id_pinjam_ruangan])->row();
        if ($data_pinjam_ruangan->is_finish == 1 || $data_pinjam_ruangan->status != 'menunggu') {
            $this->session->set_flashdata('error', 'Data tidak dalam antrian pinjam');
            return redirect('/admin/permintaan');
        }
        $this->db->update('pinjam_ruangan', ['status' => 'ditolak', 'id_user_confirm' => $this->session->userdata('id_user'), 'pesan' => $this->input->post('pesan')], ['id_pinjam_ruangan' => $id_pinjam_ruangan]);
        $this->session->set_flashdata('success', 'Data berhasil ditolak');
        return redirect('/admin/permintaan');
    }

    public function pengembalian_barang($id_pinjam_barang)
    {
        $data['title'] = 'SPRS | Pengembalian Barang';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['barang'] = $this->db
            ->select('pinjam_barang.id_pinjam_barang, pinjam_barang.created_at AS waktu_pinjam, pinjam_barang.quantity, peminjam.nama AS peminjam, barang.nama AS nama_barang')
            ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
            ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
            ->get_where('pinjam_barang', ['id_pinjam_barang' => $id_pinjam_barang])->row();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/pengembalian_barang', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function kembalikan_barang($id_pinjam_barang)
    {
        $waktu_pengembalian = date('Y-m-d H:i:s');

        $pinjam_barang = $this->db->select('quantity,id_barang')->get_where('pinjam_barang', ['id_pinjam_barang' => $id_pinjam_barang])->row();
        // Update stok
        $barang = $this->db->select('stok')->get_where('barang', ['id_barang' => $pinjam_barang->id_barang])->row();
        $stok = (int)$barang->stok + (int)$pinjam_barang->quantity;


        $this->db->insert('pengembalian_barang', [
            'id_pinjam_barang' => $id_pinjam_barang,
            'waktu_pengembalian' => $waktu_pengembalian,
            'kondisi_barang' => $this->input->post('kondisi_barang'),
            'denda' => $this->input->post('denda'),
            'keterangan' => $this->input->post('keterangan'),
            'id_penerima' => $this->session->userdata('role_id'),
        ]);

        if ($this->db->affected_rows()) {
            $this->db->update('pinjam_barang', ['is_finish' => 1], ['id_pinjam_barang' => $id_pinjam_barang]);
            $this->db->update('barang', ['stok' => $stok], ['id_barang' => $pinjam_barang->id_barang]);

            $this->session->set_flashdata('success', 'Barang berhasil dikembalikan');
            return redirect('/admin/peminjaman');
        }
        $this->session->set_flashdata('error', 'Barang gagal dikembalikan');
        return redirect('/admin/peminjaman');
    }

    public function profile()
    {
        $data['title'] = 'SPRS | Profile';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/admin/profile', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function profile_edit()
    {
        $this->db->update('user', ['nama' => $this->input->post('name')], ['id_user' => $this->session->userdata('id_user')]);

        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Nama berhasil diubah');
            return redirect('/admin/profile');
        }
        $this->session->set_flashdata('error', 'Nama gagal diubah');
        return redirect('/admin/profile');
    }
    public function profile_changepassword()
    {
        // pasword field di peminjam
        $data['title'] = 'SPRS | Profile';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');
        // var_dump(true);
        $this->form_validation->set_rules(
            'current_password',
            'Current Password',
            'required|trim',
            [
                'required' => 'Password lama tidak boleh kosong'
            ]
        );

        $this->form_validation->set_rules(
            'new_password1',
            'New Password',
            'required|min_length[5]|matches[new_password2]',
            [
                'required' => 'Password baru tidak boleh kosong',
                'matches'  => 'Password tidak sama',
                'min_length' => 'Password minimal 5 karakter',
            ]
        );

        $this->form_validation->set_rules(
            'new_password2',
            'Confirm New Password',
            'required|min_length[5]|matches[new_password1]|trim',
            [
                'required' => 'Password baru tidak boleh kosong',
                'matches'  => 'Password Tidak Sama',
                'min_length' => 'Password minimal 5 karakter',
            ]
        );
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/head', $data);
            $this->load->view('templates/navigation', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('pages/admin/profile', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/script', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            $user = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row();

            if (!password_verify($current_password, $user->password)) {
                $this->session->set_flashdata('error', 'Password lama salah!');
                redirect('admin/profile');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('error', 'Password baru tidak boleh sama dengan password lama!');
                    redirect('admin/profile');
                } else {
                    //password ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->update('user', ['password' => $password_hash], ['id_user' => $this->session->userdata('id_user')]);
                    $this->session->set_flashdata('success', 'Password berhasil diubah!');
                    redirect('admin/profile');
                }
            }
        }
    }
}
