<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Order extends Controller
{
    public function index()
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
        $orders = $orderModel->getOrdersByPenjual($_SESSION['user_akun_id']);

        $data['judul'] = 'Order Masuk';
        $data['aktif'] = 'order';
        $data['orders'] = $orders;

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
