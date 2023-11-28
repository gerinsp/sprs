<?php

class Pegawai extends CI_Controller
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

        $data['kendaraan'] = $this->db->from('pinjam_kendaraan')->where('is_finish', 1)->count_all_results();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/pegawai/dashboard', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }

    public function permintaan()
    {
        $data['title'] = 'SPRS | Permintaan';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['kendaraan'] = $this->db
            ->select('pinjam_kendaraan.id_pinjam_kendaraan, pinjam_kendaraan.status, penerima.id_role as id_penerima, user.nama AS peminjam, pinjam_kendaraan.waktu AS waktu_pinjam, kendaraan.nama AS nama_kendaraan,  pinjam_kendaraan.kilometer_awal, supir.nama as nama_supir')
            ->join('user', 'user.id_user = pinjam_kendaraan.id_peminjam', 'left')
            ->join('user penerima', 'penerima.id_user = pinjam_kendaraan.id_user_confirm')
            ->join('kendaraan', 'kendaraan.id_kendaraan = pinjam_kendaraan.id_kendaraan', 'left')
            ->join('supir', 'supir.id_supir = pinjam_kendaraan.id_supir', 'left')
            ->where('is_finish', 0)
            ->where('status', 'diterima')
            ->where('penerima.id_user', 2)
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
    public function tolak_kendaraan()
    {
        $pesan = $this->input->post('pesan');
        $id_user_confirm = $this->session->userdata('id_user');
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

    public function peminjaman()
    {
        $data['title'] = 'SPRS | Peminjaman';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['kendaraan'] = $this->db
            ->select('pinjam_kendaraan.id_pinjam_kendaraan, pinjam_kendaraan.status, penerima.id_role as id_penerima, peminjam.nama AS peminjam, pinjam_kendaraan.waktu AS waktu_pinjam, kendaraan.nama AS nama_kendaraan, pinjam_kendaraan.kilometer_awal, supir.nama AS nama_supir, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_kendaraan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_kendaraan.id_user_confirm')
            ->join('kendaraan', 'kendaraan.id_kendaraan = pinjam_kendaraan.id_kendaraan')
            ->join('supir', 'supir.id_supir = pinjam_kendaraan.id_supir')
            ->where('is_finish', 0)
            ->where_in('status', ['diterima', 'pengembalian'])
            ->where('penerima.id_user', 3)
            ->get('pinjam_kendaraan')
            ->result();

        $data['ruangan'] = $this->db
            ->select('pinjam_ruangan.id_pinjam_ruangan, pinjam_ruangan.status, penerima.id_role as id_penerima, peminjam.nama AS peminjam, pinjam_ruangan.waktu AS waktu_acara, pinjam_ruangan.created_at AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_ruangan.id_user_confirm')
            ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
            ->where('waktu >=', date('Y-m-d'))
            ->where('status', 'diterima')
            ->where('penerima.id_user', 1)
            ->get('pinjam_ruangan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/pegawai/peminjaman', $data);
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
        $this->load->view('pages/pegawai/peminjaman-kendaraan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function peminjaman_ruangan()
    {
        $data['title'] = 'SPRS | Laporan Ruangan';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['ruangan'] = $this->db
            ->select('peminjam.nama AS peminjam, pinjam_ruangan.waktu AS waktu_acara, pinjam_ruangan.created_at AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan, penerima.nama AS penerima')
            ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_ruangan.id_user_confirm')
            ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
            ->where('is_finish', 1)
            ->get('pinjam_ruangan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/pegawai/peminjaman-ruangan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }

    public function status_peminjaman_kendaraan()
    {
        $data['title'] = 'SPRS | Laporan Kendaraan';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['kendaraan'] = $this->db
            ->select('peminjam.nama AS peminjam, penerima.id_role as id_penerima, pinjam_kendaraan.is_finish, pinjam_kendaraan.waktu AS waktu_pinjam, 
            kendaraan.nama AS nama_kendaraan, pinjam_kendaraan.kilometer_awal, 
            supir.nama AS nama_supir, penerima.nama AS penerima, pinjam_kendaraan.status, 
            pinjam_kendaraan.pesan, pengembalian.kilometer_akhir, pengembalian.denda, 
            pengembalian.waktu_pengembalian AS waktu_kembali, pengembalian.keterangan')
            ->join('user peminjam', 'peminjam.id_user = pinjam_kendaraan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_kendaraan.id_user_confirm')
            ->join('kendaraan', 'kendaraan.id_kendaraan = pinjam_kendaraan.id_kendaraan')
            ->join('pengembalian_kendaraan pengembalian', 'pengembalian.id_pinjam_kendaraan = pinjam_kendaraan.id_pinjam_kendaraan', 'left')
            ->join('supir', 'supir.id_supir = pinjam_kendaraan.id_supir')
            ->where('is_finish', 1)
            ->or_where('status', 'ditolak')
            ->get('pinjam_kendaraan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/pegawai/status-peminjaman-kendaraan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }
    public function status_peminjaman_ruangan()
    {
        $data['title'] = 'SPRS | Laporan Ruangan';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $data['ruangan'] = $this->db
            ->select('peminjam.nama AS peminjam, penerima.id_role as id_penerima, pinjam_ruangan.is_finish,
             pinjam_ruangan.waktu AS waktu_acara, pinjam_ruangan.created_at AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  
             pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan, penerima.nama AS penerima, 
             pinjam_ruangan.status, pinjam_ruangan.pesan')
            ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
            ->join('user penerima', 'penerima.id_user = pinjam_ruangan.id_user_confirm')
            ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
            ->where('is_finish', 1)
            ->or_where('status', 'ditolak')
            ->get('pinjam_ruangan')
            ->result();

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/pegawai/status-peminjaman-ruangan', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }


    public function profile()
    {
        $data['title'] = 'SPRS | Profile';
        $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

        $this->load->view('templates/head', $data);
        $this->load->view('templates/navigation', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/pegawai/profile', $data);
        $this->load->view('templates/footer');
        $this->load->view('templates/script', $data);
    }

    public function konfirmasi_kendaraan($id_pinjam_kendaraan)
    {
        $this->db->where('id_pinjam_kendaraan', $id_pinjam_kendaraan)->update('pinjam_kendaraan', [
            'is_finish' => 1
        ]);

        $this->session->set_flashdata('success', 'Berhasil melakukan konfirmasi pengembalian');
        return redirect('/pegawai/peminjaman');
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
            $this->load->view('pages/pegawai/profile', $data);
            $this->load->view('templates/footer');
            $this->load->view('templates/script', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            $user = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row();

            if (!password_verify($current_password, $user->password)) {
                $this->session->set_flashdata('error', 'Password lama salah!');
                redirect('pegawai/profile');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('error', 'Password baru tidak boleh sama dengan password lama!');
                    redirect('pegawai/profile');
                } else {
                    //password ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->update('user', ['password' => $password_hash], ['id_user' => $this->session->userdata('id_user')]);
                    $this->session->set_flashdata('success', 'Password berhasil diubah!');
                    redirect('pegawai/profile');
                }
            }
        }
    }
}