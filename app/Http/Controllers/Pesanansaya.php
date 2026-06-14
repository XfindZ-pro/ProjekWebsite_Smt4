<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pesanansaya extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        try {
            $orderModel = $this->model('OrderModel');
            $reviewModel = $this->model('ReviewModel');

            $orders = $orderModel->getOrdersByPembeli($_SESSION['user_akun_id']);
            $reviews = $reviewModel->getReviewsByPembeli($_SESSION['user_akun_id']);

            // Index reviews by order_id and produk_id for fast lookup in view
            $indexedReviews = [];
            foreach ($reviews as $rev) {
                $key = $rev['order_id'] . '_' . $rev['produk_id'];
                $indexedReviews[$key] = $rev;
            }

            $data['aktif'] = 'pesanansaya';
            $data['judul'] = 'Pesanan Saya';
            $data['orders'] = $orders;
            $data['reviews'] = $indexedReviews;

            return view('templates.header', $data) .
                   view('pesanansaya.index', $data) .
                   view('templates.footer');
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Terjadi kesalahan saat memuat halaman Pesanan Saya.');
        }
    }

    public function rate(Request $request)
    {
        if (!isset($_SESSION['user_akun_id'])) {
            return redirect('/login');
        }

        $orderId = $request->input('order_id');
        $produkId = $request->input('produk_id');
        $rating = intval($request->input('rating', 0));
        $komentar = trim($request->input('komentar', ''));

        if (empty($orderId) || empty($produkId) || $rating < 1 || $rating > 5) {
            return back()->with('error', 'Data ulasan tidak valid.');
        }

        try {
            // Check if reviewer is the seller of this product
            $produkModel = $this->model('ProdukModel');
            $produk = $produkModel->getProdukById($produkId);
            if ($produk && $produk['penjual_id'] === $_SESSION['user_akun_id']) {
                return back()->with('error', 'Anda tidak dapat memberikan ulasan untuk produk Anda sendiri.');
            }

            $reviewModel = $this->model('ReviewModel');
            
            $dataReview = [
                'order_id' => $orderId,
                'produk_id' => $produkId,
                'pembeli_id' => $_SESSION['user_akun_id'],
                'rating' => $rating,
                'komentar' => $komentar
            ];

            // Check if review already exists for this order & product
            $existing = $reviewModel->getReviewByOrderAndProduct($orderId, $produkId);
            if ($existing) {
                // Ensure owner match
                if ($existing['pembeli_id'] !== $_SESSION['user_akun_id']) {
                    return back()->with('error', 'Anda tidak memiliki akses untuk mengubah ulasan ini.');
                }
                if ($reviewModel->updateReview($dataReview)) {
                    return back()->with('success', 'Ulasan Anda berhasil diperbarui.');
                } else {
                    return back()->with('error', 'Gagal memperbarui ulasan.');
                }
            } else {
                if ($reviewModel->addReview($dataReview)) {
                    return back()->with('success', 'Ulasan Anda berhasil disimpan. Terima kasih!');
                } else {
                    return back()->with('error', 'Gagal menyimpan ulasan.');
                }
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem saat menyimpan ulasan.');
        }
    }
}
