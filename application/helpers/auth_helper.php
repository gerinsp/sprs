<?php
function cekuser()
{
    $ci = get_instance();

    if (!$ci->session->userdata('username')) {
        redirect('login');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        if ($role_id == 1 && $menu != 'admin') {
            redirect('admin');
        } else if ($role_id == 2 && $menu != 'kepsek') {
            redirect('kepsek');
        } else if ($role_id == 3 && $menu != 'pegawai') {
            redirect('pegawai');
        } else if ($role_id == 4 && $menu != 'user') {
            redirect('user');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
function check_buttontambah($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $ci->db->where('add_btn = 1');
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_buttonedit($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $ci->db->where('update_btn = 1');
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
function check_buttonhapus($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $ci->db->where('delete_btn = 1');
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_buttondetail($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $ci->db->where('detail_btn = 1');
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function dd($param)
{
    echo '<pre>';
    var_dump($param);
    echo '</pre>';
    die;
}
