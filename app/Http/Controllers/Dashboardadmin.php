<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboardadmin extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_akun_id']) || !isset($_SESSION['user_peran']) || $_SESSION['user_peran'] !== 'admin') {
            return redirect('/');
        }

        $akunModel = $this->model('AkunModel');
        $verifikasiModel = $this->model('VerifikasiModel');
        $produkModel = $this->model('ProdukModel');
        
        $data['aktif'] = 'dashboardadmin';
        $data['verifikasi_list'] = $verifikasiModel->getPendingVerifications();
        $data['recent_submissions'] = $verifikasiModel->getRecentVerifications(3);
        
        $users = $akunModel->getAllUsers();
        foreach ($users as &$u) {
            if (!empty($u['foto_profil'])) {
                $u['foto_profil'] = 'data:image/jpeg;base64,' . base64_encode($u['foto_profil']);
            } else {
                $u['foto_profil'] = "https://ui-avatars.com/api/?name=" . urlencode($u['nama']) . "&background=10b981&color=fff&size=512";
            }
            
            if (!empty($u['foto_banner'])) {
                $u['foto_banner'] = 'data:image/jpeg;base64,' . base64_encode($u['foto_banner']);
            } else {
                $u['foto_banner'] = 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1400&q=80';
            }
        }
        $data['users_list'] = $users;
        
        $data['total_users'] = $akunModel->countUsers();
        $data['pending_verifications'] = $verifikasiModel->countPendingVerifications();
        $data['product_active'] = $produkModel->countActiveProducts();
        $data['approved_today'] = $verifikasiModel->countApprovedToday();

        // Get paginated products for Manajemen Produk tab
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $data['produk_data'] = $produkModel->getAllProdukWithStats($page, 10);

        return view('templates.header', $data) .
               view('dashboardadmin.index', $data) .
               view('templates.footer');
    }

    public function setujui($v_id, $akun_id)
    {
        if ($this->model('VerifikasiModel')->approveVerification($v_id, $akun_id)) {
            return redirect('/dashboardadmin');
        }

        return back()->with('error', 'Gagal menyetujui verifikasi.');
    }

    public function tolak($v_id, $akun_id)
    {
        if ($this->model('VerifikasiModel')->rejectVerification($v_id, $akun_id)) {
            return redirect('/dashboardadmin');
        }

        return back()->with('error', 'Gagal menolak verifikasi.');
    }
}
