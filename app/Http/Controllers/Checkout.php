<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Checkout extends Controller
{
    public function index($id)
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        try {
            $produkModel = $this->model('ProdukModel');
            
            // Get product details
            $produk = $produkModel->getProdukById($id);
            
            if (!$produk) {
                return redirect('/caribahanbaku')->with('error', 'Produk tidak ditemukan.');
            }
            
            // Prevent seller from buying their own product
            if ($_SESSION['user_akun_id'] == $produk['penjual_id']) {
                return redirect('/detail/' . $id)->with('error', 'Anda tidak dapat membeli produk Anda sendiri.');
            }

            $data['aktif'] = 'caribahanbaku';
            $data['produk'] = $produk;
            $data['judul'] = 'Checkout Produk';
            
            return view('templates.header', $data) .
                   view('checkout.index', $data) .
                   view('templates.footer');
        } catch (\Exception $e) {
            return redirect('/caribahanbaku')->with('error', 'Terjadi kesalahan saat memuat halaman checkout.');
        }
    }

    public function proses(Request $request, $id)
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return response()->json(['success' => false, 'message' => 'Sesi login tidak valid.']);
        }

        try {
            $produkModel = $this->model('ProdukModel');
            $produk = $produkModel->getProdukById($id);

            if (!$produk) {
                return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.']);
            }

            if ($_SESSION['user_akun_id'] == $produk['penjual_id']) {
                return response()->json(['success' => false, 'message' => 'Anda tidak dapat membeli produk Anda sendiri.']);
            }

            $quantity = floatval($request->input('quantity', 0));
            $minOrder = floatval($produk['min_order']);
            if ($quantity < $minOrder) {
                return response()->json(['success' => false, 'message' => 'Jumlah pembelian minimal adalah ' . $minOrder . ' kg.']);
            }

            $shippingMethod = $request->input('shipping_method', 'pickup');
            $paymentMethod = $request->input('payment_method', 'transfer_bank');
            $alamat = $request->input('alamat_pengiriman', '');

            if ($shippingMethod === 'dikirim' && empty(trim($alamat))) {
                return response()->json(['success' => false, 'message' => 'Alamat pengiriman wajib diisi.']);
            }

            // Hitung subtotal dan total harga
            $subtotal = $produk['harga_per_kg'] * $quantity;
            $serviceFee = ($shippingMethod === 'dikirim') ? 15000 : 0;
            $totalHarga = $subtotal + $serviceFee;

            // Buat order di DB
            $orderModel = $this->model('OrderModel');
            $orderData = [
                'pembeli_id' => $_SESSION['user_akun_id'],
                'total_harga' => $totalHarga,
                'alamat_pengiriman' => ($shippingMethod === 'pickup') ? 'Ambil Sendiri (Pickup)' : $alamat,
                'catatan' => $request->input('catatan', ''),
                'produk_id' => $id,
                'jumlah' => $quantity,
                'harga_satuan' => $produk['harga_per_kg'],
                'subtotal' => $subtotal,
                'metode_pembayaran' => $paymentMethod
            ];

            $order_id = $orderModel->buatOrder($orderData);

            if ($order_id) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pesanan berhasil dibuat!',
                    'order_id' => $order_id
                ]);
            }

            return response()->json(['success' => false, 'message' => 'Gagal memproses pesanan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }
}
