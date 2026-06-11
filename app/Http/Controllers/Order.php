<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Order extends Controller
{
    public function index(Request $request)
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        $akunModel = $this->model('AkunModel');
        $user = $akunModel->getAkunById($_SESSION['user_akun_id']);
        
        if ($user['status_verifikasi'] !== 'disetujui') {
            return redirect('/verifikasiakun');
        }

        $orderModel = $this->model('OrderModel');
        
        $tab = $request->input('tab', 'ongoing');
        if (!in_array($tab, ['ongoing', 'selesai'])) {
            $tab = 'ongoing';
        }

        $page = max(1, intval($request->input('page', 1)));
        $limit = 10;

        $ongoingStatuses = ['pending', 'diproses', 'dikirim'];
        $selesaiStatuses = ['selesai', 'dibatalkan'];

        $activeStatuses = ($tab === 'ongoing') ? $ongoingStatuses : $selesaiStatuses;

        $orderData = $orderModel->getOrdersByPenjualPaginated($_SESSION['user_akun_id'], $activeStatuses, $page, $limit);
        
        $ongoingCount = $orderModel->countOrdersByPenjual($_SESSION['user_akun_id'], $ongoingStatuses);
        $selesaiCount = $orderModel->countOrdersByPenjual($_SESSION['user_akun_id'], $selesaiStatuses);

        $data['judul'] = 'Order Masuk';
        $data['aktif'] = 'order';
        $data['orders'] = $orderData['data'];
        $data['pages'] = $orderData['pages'];
        $data['current_page'] = $orderData['current_page'];
        $data['total'] = $orderData['total'];
        $data['active_tab'] = $tab;
        $data['ongoing_count'] = $ongoingCount;
        $data['selesai_count'] = $selesaiCount;

        return view('templates.header', $data) .
               view('order.index', $data) .
               view('templates.footer');
    }

    public function respon(Request $request, $order_id)
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return response()->json(['success' => false, 'message' => 'Sesi login tidak valid.']);
        }

        $status = $request->input('status', '');
        $allowedStatuses = ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'];

        if (!in_array($status, $allowedStatuses, true)) {
            return response()->json(['success' => false, 'message' => 'Status respon tidak valid.']);
        }

        try {
            $orderModel = $this->model('OrderModel');
            
            // Lakukan pembaruan status order
            if ($orderModel->updateOrderStatus($order_id, $status)) {
                return response()->json(['success' => true, 'message' => 'Status pesanan berhasil diperbarui menjadi ' . $status]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status pesanan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }
}
