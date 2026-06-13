<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Detail extends Controller
{
    public function index(Request $request, $id)
    {
        try {
            $produkModel = $this->model('ProdukModel');
            $akunModel = $this->model('AkunModel');
            $reviewModel = $this->model('ReviewModel');
            
            // Get product details
            $produk = $produkModel->getProdukById($id);
            
            if (!$produk) {
                return redirect('/caribahanbaku')->with('error', 'Produk tidak ditemukan.');
            }
            
            // Get seller info
            $penjual = $akunModel->getAkunById($produk['penjual_id']);
            
            // Get reviews with pagination
            $page = max(1, intval($request->input('page', 1)));
            $limit = 10;
            $reviewData = $reviewModel->getReviewsByProdukPaginated($id, $page, $limit);
            
            // Get average rating
            $ratingSummary = $reviewModel->getAverageRatingAndCount($id);
            
            $data['aktif'] = 'caribahanbaku';
            $data['produk'] = $produk;
            $data['penjual'] = $penjual;
            $data['reviews'] = $reviewData['data'];
            $data['pages'] = $reviewData['pages'];
            $data['current_page'] = $reviewData['current_page'];
            $data['total_reviews'] = $reviewData['total'];
            $data['rating_summary'] = $ratingSummary;
            
            return view('templates.header', $data) .
                   view('detail.index', $data) .
                   view('templates.footer');
        } catch (\Exception $e) {
            return redirect('/caribahanbaku')->with('error', 'Terjadi kesalahan saat memuat produk.');
        }
    }
}
