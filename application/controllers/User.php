<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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

      // $data['kendaraan'] = $this->db->from('pinjam_kendaraan')->where('is_finish', 0)->count_all_results();
      // $data['barang_harian'] = $this->db->from('pinjam_barang')->where('is_takeaway', 0)->where('is_finish', 0)->count_all_results();
      // $data['barang_pulang'] = $this->db->from('pinjam_barang')->where('is_takeaway', 1)->where('is_finish', 0)->count_all_results();
      // $data['ruangan'] = $this->db->from('pinjam_ruangan')->where('is_finish', 0)->count_all_results();
      // $data['supir'] = $this->db->from('supir')->count_all_results();
      // $data['peminjam'] = $this->db->from('user')->where('id_role', 4)->count_all_results();

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/user/dashboard', $data);
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
      $this->load->view('pages/user/barang', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   public function pinjam_harian($idbarang)
   {

      $data_pinjamanharian = [
         'id_peminjam' => $this->input->post('id_peminjam'),
         'id_barang' => $idbarang,
         'status' => "menunggu",
         'quantity' => $this->input->post('quantity'),
      ];
      $this->db->insert('pinjam_barang', $data_pinjamanharian);

      $response = array(
         'status' => 'ok',
         'data' => null
      );
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
   }
   public function pinjam_pulang($idbarang)
   {

      $data_pinjamanbawapulang = [
         'id_peminjam' => $this->input->post('id_peminjam'),
         'id_barang' => $idbarang,
         'status' => "menunggu",
         'quantity' => $this->input->post('quantity'),
         'is_takeaway' => 1,
         'alasan_pinjam' => $this->input->post('alasanpinjam'),
         'kondisi_barang' => $this->input->post('kondisibarang'),
         'estimasi_pengembalian' => $this->input->post('estimasipengembalian'),
      ];
      $this->db->insert('pinjam_barang', $data_pinjamanbawapulang);

      $response = array(
         'status' => 'ok',
         'data' => null
      );
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
   }

   public function kendaraan()
   {
      $data['title'] = 'SPRS | Kendaraan';
      $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

      $data['kendaraan'] = $this->db->get('kendaraan')->result();

      $data['supir'] = $this->db->get('supir')->result();

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/user/kendaraan', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   public function pinjam_kendaraan($idkendaraan)
   {
      date_default_timezone_set('Asia/Jakarta');
      $now = date('Y-m-d H:i:s');

      $data_pinjamankendaraan = [
         'id_peminjam' => $this->input->post('id_peminjam'),
         'id_kendaraan' => $idkendaraan,
         'status' => "menunggu",
         'kilometer_awal' => $this->input->post('kilometerawal'),
         'id_supir' => $this->input->post('supir'),
         'waktu' => $now,
      ];
      $this->db->insert('pinjam_kendaraan', $data_pinjamankendaraan);

      $response = array(
         'status' => 'ok',
         'data' => null
      );
      $this->output->set_content_type('application/json')->set_output(json_encode($response));
   }

   public function ruangan()
   {
      $data['title'] = 'SPRS | Ruangan';
      $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

      $data['ruangan'] = $this->db->get('ruangan')->result();

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/user/ruangan', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   public function pinjam_ruangan($idruangan)
   {
      date_default_timezone_set('Asia/Jakarta');
      $now = date('Y-m-d H:i:s');

      $data_pinjamanruangan = [
         'id_peminjam' => $this->input->post('id_peminjam'),
         'id_ruangan' => $idruangan,
         'status' => "menunggu",
         'acara' => $this->input->post('namaacara'),
         'waktu' => $now,
         'kebutuhan' => $this->input->post('kebutuhan'),
         'keterangan' => $this->input->post('keterangan'),
      ];
      $this->db->insert('pinjam_ruangan', $data_pinjamanruangan);

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

      $data['barang_harian'] = $this->db
         ->select('pinjam_barang.id_pinjam_barang, pinjam_barang.created_at AS waktu_pinjam, pinjam_barang.quantity, peminjam.nama AS peminjam, penerima.nama AS penerima, barang.nama AS nama_barang')
         ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
         ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
         ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
         ->where('is_takeaway', 0)
         ->where('is_finish', 0)
         ->where('status', 'diterima')
         ->where('id_peminjam',  $this->session->userdata('id_user'))
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
         ->where('id_peminjam',  $this->session->userdata('id_user'))
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
         ->where('id_peminjam',  $this->session->userdata('id_user'))
         ->get('pinjam_kendaraan')
         ->result();

      $data['ruangan'] = $this->db
         ->select('pinjam_ruangan.id_pinjam_ruangan, peminjam.nama AS peminjam, pinjam_ruangan.waktu AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan, penerima.nama AS penerima')
         ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
         ->join('user penerima', 'penerima.id_user = pinjam_ruangan.id_user_confirm')
         ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
         ->where('is_finish', 0)
         ->where('status', 'diterima')
         ->where('id_peminjam',  $this->session->userdata('id_user'))
         ->get('pinjam_ruangan')
         ->result();

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/user/peminjaman', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }

   public function riwayat_peminjaman_barang()
   {
      $data['title'] = 'SPRS | Riwayat Peminjaman Barang Harian';
      $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

      $data['barangpinjamanharian'] = $this->db
         ->select('pinjam_barang.created_at AS waktu_pinjam, pinjam_barang.quantity, peminjam.nama AS peminjam, penerima.nama AS penerima, barang.nama AS nama_barang')
         ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
         ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
         ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
         ->where('is_takeaway', 0)
         ->where('is_finish', 1)
         ->where('id_peminjam',  $this->session->userdata('id_user'))
         ->get('pinjam_barang')
         ->result();


      $data['barangpinjamanbawapulang'] = $this->db
         ->select('peminjam.nama AS peminjam, pinjam_barang.created_at AS waktu_pinjam, barang.nama AS nama_barang, pinjam_barang.quantity, pinjam_barang.alasan_pinjam, penerima.nama AS penerima')
         ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
         ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
         ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
         ->where('is_takeaway', 1)
         ->where('is_finish', 1)
         ->where('id_peminjam',  $this->session->userdata('id_user'))
         ->get('pinjam_barang')
         ->result();

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/user/peminjaman-barang', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }

   public function riwayat_peminjaman_kendaraan()
   {
      $data['title'] = 'SPRS | Riwayat Peminjaman Kendaraan';
      $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

      $data['kendaraan'] = $this->db
         ->select('peminjam.nama AS peminjam, pinjam_kendaraan.waktu AS waktu_pinjam, kendaraan.nama AS nama_kendaraan, pinjam_kendaraan.kilometer_awal, supir.nama AS nama_supir, penerima.nama AS penerima')
         ->join('user peminjam', 'peminjam.id_user = pinjam_kendaraan.id_peminjam')
         ->join('user penerima', 'penerima.id_user = pinjam_kendaraan.id_user_confirm')
         ->join('kendaraan', 'kendaraan.id_kendaraan = pinjam_kendaraan.id_kendaraan')
         ->join('supir', 'supir.id_supir = pinjam_kendaraan.id_supir')
         ->where('is_finish', 1)
         ->where('id_peminjam',  $this->session->userdata('id_user'))
         ->get('pinjam_kendaraan')
         ->result();

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/user/peminjaman-kendaraan', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   public function riwayat_peminjaman_ruangan()
   {
      $data['title'] = 'SPRS | Laporan Ruangan';
      $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

      $data['ruangan'] = $this->db
         ->select('peminjam.nama AS peminjam, pinjam_ruangan.waktu AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan, penerima.nama AS penerima')
         ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
         ->join('user penerima', 'penerima.id_user = pinjam_ruangan.id_user_confirm')
         ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
         ->where('is_finish', 1)
         ->where('id_peminjam',  $this->session->userdata('id_user'))
         ->get('pinjam_ruangan')
         ->result();

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/user/peminjaman-ruangan', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   public function riwayat_peminjaman_ditolak()
   {
      $data['title'] = 'SPRS | Peminjaman Ditolak';
      $data['user'] = $this->m->Get_Where(['id_user' => $this->session->userdata('id_user')], 'user');

      $data['barang_harian'] = $this->db
         ->select('pinjam_barang.id_pinjam_barang, pinjam_barang.created_at AS waktu_pinjam, pinjam_barang.quantity, peminjam.nama AS peminjam, penerima.nama AS penerima, barang.nama AS nama_barang, pinjam_barang.pesan')
         ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
         ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
         ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
         ->where('is_takeaway', 0)
         ->where('is_finish', 0)
         ->where('status', 'ditolak')
         ->where('id_peminjam',  $this->session->userdata('id_user'))
         ->get('pinjam_barang')
         ->result();

      $data['barang_pulang'] = $this->db
         ->select('pinjam_barang.id_pinjam_barang, peminjam.nama AS peminjam, pinjam_barang.created_at AS waktu_pinjam, barang.nama AS nama_barang, pinjam_barang.quantity, pinjam_barang.alasan_pinjam, penerima.nama AS penerima, pinjam_barang.pesan')
         ->join('user peminjam', 'peminjam.id_user = pinjam_barang.id_peminjam')
         ->join('user penerima', 'penerima.id_user = pinjam_barang.id_user_confirm')
         ->join('barang', 'barang.id_barang = pinjam_barang.id_barang')
         ->where('is_takeaway', 1)
         ->where('is_finish', 0)
         ->where('status', 'ditolak')
         ->where('id_peminjam',  $this->session->userdata('id_user'))
         ->get('pinjam_barang')
         ->result();

      $data['kendaraan'] = $this->db
         ->select('pinjam_kendaraan.id_pinjam_kendaraan, peminjam.nama AS peminjam, pinjam_kendaraan.waktu AS waktu_pinjam, kendaraan.nama AS nama_kendaraan, pinjam_kendaraan.kilometer_awal, supir.nama AS nama_supir, penerima.nama AS penerima, pinjam_kendaraan.pesan')
         ->join('user peminjam', 'peminjam.id_user = pinjam_kendaraan.id_peminjam')
         ->join('user penerima', 'penerima.id_user = pinjam_kendaraan.id_user_confirm')
         ->join('kendaraan', 'kendaraan.id_kendaraan = pinjam_kendaraan.id_kendaraan')
         ->join('supir', 'supir.id_supir = pinjam_kendaraan.id_supir')
         ->where('is_finish', 0)
         ->where('status', 'ditolak')
         ->where('id_peminjam',  $this->session->userdata('id_user'))
         ->get('pinjam_kendaraan')
         ->result();

      $data['ruangan'] = $this->db
         ->select('pinjam_ruangan.id_pinjam_ruangan, peminjam.nama AS peminjam, pinjam_ruangan.waktu AS waktu_pinjam, ruangan.nama AS nama_ruangan,  pinjam_ruangan.acara,  pinjam_ruangan.kebutuhan,  pinjam_ruangan.keterangan, penerima.nama AS penerima, pinjam_ruangan.pesan')
         ->join('user peminjam', 'peminjam.id_user = pinjam_ruangan.id_peminjam')
         ->join('user penerima', 'penerima.id_user = pinjam_ruangan.id_user_confirm')
         ->join('ruangan', 'ruangan.id_ruangan = pinjam_ruangan.id_ruangan')
         ->where('is_finish', 0)
         ->where('status', 'ditolak')
         ->where('id_peminjam',  $this->session->userdata('id_user'))
         ->get('pinjam_ruangan')
         ->result();

      $this->load->view('templates/head', $data);
      $this->load->view('templates/navigation', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('pages/user/peminjaman-ditolak', $data);
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
      $this->load->view('pages/user/profile', $data);
      $this->load->view('templates/footer');
      $this->load->view('templates/script', $data);
   }
   public function profile_edit()
   {
      $this->db->update('user', ['nama' => $this->input->post('name')], ['id_user' => $this->session->userdata('id_user')]);

      if ($this->db->affected_rows()) {
         $this->session->set_flashdata('success', 'Nama berhasil diubah');
         return redirect('/user/profile');
      }
      $this->session->set_flashdata('error', 'Nama gagal diubah');
      return redirect('/user/profile');
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
         $this->load->view('pages/user/profile', $data);
         $this->load->view('templates/footer');
         $this->load->view('templates/script', $data);
      } else {
         $current_password = $this->input->post('current_password');
         $new_password = $this->input->post('new_password1');

         $user = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row();

         if (!password_verify($current_password, $user->password)) {
            $this->session->set_flashdata('error', 'Password lama salah!');
            redirect('user/profile');
         } else {
            if ($current_password == $new_password) {
               $this->session->set_flashdata('error', 'Password baru tidak boleh sama dengan password lama!');
               redirect('user/profile');
            } else {
               //password ok
               $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

               $this->db->update('user', ['password' => $password_hash], ['id_user' => $this->session->userdata('id_user')]);
               $this->session->set_flashdata('success', 'Password berhasil diubah!');
               redirect('user/profile');
            }
         }
      }
   }
}
