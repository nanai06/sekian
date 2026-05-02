<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * 20 produk eco-beauty preloved untuk halaman Ayu Belanja
     * Data diambil dari array hardcode yang sebelumnya ada di blade
     */
    public function run(): void
    {
        // Ambil user pertama sebagai seller default
        // Kalau belum ada user, bikin satu dummy seller
        $seller = User::first();
        if (!$seller) {
            $seller = User::create([
                'name' => 'AYU-NE Official',
                'email' => 'official@ayune.id',
                'password' => bcrypt('password'),
                'role' => 'user',
            ]);
        }

        $products = [
            // SKINCARE (8 produk)
            ['nama_produk'=>'5X Ceramide Barrier Repair Moisture Gel','brand'=>'Skintific','harga'=>95000,'harga_asli'=>190000,'kategori'=>'skincare','kondisi'=>'bekas','deskripsi'=>'Pelembab gel dengan 5x ceramide untuk memperbaiki skin barrier. Sisa 80%, masih tersegel.','foto'=>'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Brightening Face Toner','brand'=>'Whitelab','harga'=>45000,'harga_asli'=>90000,'kategori'=>'skincare','kondisi'=>'bekas','deskripsi'=>'Toner pencerah wajah dengan niacinamide. Sisa 70%, cocok untuk kulit kusam.','foto'=>'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Holyshield Sunscreen SPF 50','brand'=>'Somethinc','harga'=>75000,'harga_asli'=>150000,'kategori'=>'skincare','kondisi'=>'baru','deskripsi'=>'Sunscreen SPF 50 PA++++ ringan dan tidak lengket. Masih baru, belum pernah dipakai.','foto'=>'https://images.unsplash.com/photo-1599305090598-fe179d501227?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Cica Beauty Serum','brand'=>'Npure','harga'=>55000,'harga_asli'=>110000,'kategori'=>'skincare','kondisi'=>'bekas','deskripsi'=>'Serum cica untuk menenangkan kulit sensitif. Sisa 60%.','foto'=>'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Moisturizing Gel Cream','brand'=>'Skintific','harga'=>89000,'harga_asli'=>178000,'kategori'=>'skincare','kondisi'=>'baru','deskripsi'=>'Gel cream pelembab ringan untuk semua jenis kulit. Produk baru dan tersegel.','foto'=>'https://images.unsplash.com/photo-1556228578-8c89e6adf883?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Niacinamide 10% + Zinc Serum','brand'=>'The Ordinary','harga'=>120000,'harga_asli'=>210000,'kategori'=>'skincare','kondisi'=>'bekas','deskripsi'=>'Serum niacinamide untuk mengontrol minyak dan mengecilkan pori. Sisa 65%.','foto'=>'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Hydrating Face Wash','brand'=>'Cetaphil','harga'=>65000,'harga_asli'=>110000,'kategori'=>'skincare','kondisi'=>'baru','deskripsi'=>'Sabun muka lembut untuk kulit kering dan sensitif. Masih tersegel.','foto'=>'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Rose Water Toner Mist','brand'=>'Sensatia Botanicals','harga'=>48000,'harga_asli'=>85000,'kategori'=>'skincare','kondisi'=>'bekas','deskripsi'=>'Toner spray air mawar untuk menyegarkan wajah. Sisa 50%.','foto'=>'https://images.unsplash.com/photo-1580870069867-74c57ee1bb07?q=80&w=500&auto=format&fit=crop'],

            // MAKEUP (6 produk)
            ['nama_produk'=>'Instaperfect Matte Lipstick','brand'=>'Instaperfect','harga'=>35000,'harga_asli'=>75000,'kategori'=>'makeup','kondisi'=>'bekas','deskripsi'=>'Lipstik matte tahan lama. Sudah diswab, sisa 85%.','foto'=>'https://images.unsplash.com/photo-1586495777744-4413f21062fa?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Fit Me Foundation','brand'=>'Maybelline','harga'=>85000,'harga_asli'=>130000,'kategori'=>'makeup','kondisi'=>'bekas','deskripsi'=>'Foundation matte + poreless untuk coverage medium. Sisa 70%.','foto'=>'https://plus.unsplash.com/premium_photo-1677175230595-87f8721ff703?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Wardah Cushion SPF 40','brand'=>'Wardah','harga'=>78000,'harga_asli'=>130000,'kategori'=>'makeup','kondisi'=>'bekas','deskripsi'=>'Cushion dengan SPF 40 untuk daily makeup. Sisa 60%.','foto'=>'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Lip Matte Cream','brand'=>'Implora','harga'=>22000,'harga_asli'=>45000,'kategori'=>'makeup','kondisi'=>'baru','deskripsi'=>'Lip cream matte warna nude. Produk baru, belum pernah dipakai.','foto'=>'https://images.unsplash.com/photo-1586495777744-4413f21062fa?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'HD Loose Powder','brand'=>'Make Over','harga'=>95000,'harga_asli'=>160000,'kategori'=>'makeup','kondisi'=>'bekas','deskripsi'=>'Bedak tabur HD untuk setting makeup. Sisa 75%.','foto'=>'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Volume Mascara Waterproof','brand'=>'Maybelline','harga'=>55000,'harga_asli'=>95000,'kategori'=>'makeup','kondisi'=>'baru','deskripsi'=>'Mascara waterproof untuk bulu mata tebal dan panjang. Masih baru.','foto'=>'https://plus.unsplash.com/premium_photo-1677175230595-87f8721ff703?q=80&w=500&auto=format&fit=crop'],

            // ALAT MAKEUP (3 produk)
            ['nama_produk'=>'Makeup Brush Set 12pcs','brand'=>'Focallure','harga'=>25000,'harga_asli'=>50000,'kategori'=>'alat','kondisi'=>'bekas','deskripsi'=>'Set kuas makeup 12 pcs, masih bagus, sudah dicuci bersih.','foto'=>'https://images.unsplash.com/photo-1596462502278-27bfdc403348?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Professional Brush Set 18pcs','brand'=>'Focallure','harga'=>45000,'harga_asli'=>85000,'kategori'=>'alat','kondisi'=>'bekas','deskripsi'=>'Set kuas profesional 18 pcs untuk full face makeup. Kondisi 80%.','foto'=>'https://images.unsplash.com/photo-1596462502278-27bfdc403348?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Beauty Blender Sponge','brand'=>'Beautyblender','harga'=>35000,'harga_asli'=>60000,'kategori'=>'alat','kondisi'=>'baru','deskripsi'=>'Sponge makeup original, masih baru dalam kemasan.','foto'=>'https://images.unsplash.com/photo-1596462502278-27bfdc403348?q=80&w=500&auto=format&fit=crop'],

            // ISI ULANG (3 produk)
            ['nama_produk'=>'Toner Refill 200ml','brand'=>'Sensatia Botanicals','harga'=>30000,'harga_asli'=>60000,'kategori'=>'isulang','kondisi'=>'baru','deskripsi'=>'Refill toner 200ml untuk mengurangi sampah plastik kemasan.','foto'=>'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Micellar Water Refill 400ml','brand'=>'Garnier','harga'=>40000,'harga_asli'=>72000,'kategori'=>'isulang','kondisi'=>'baru','deskripsi'=>'Micellar water refill pouch 400ml. Lebih hemat dan ramah lingkungan.','foto'=>'https://images.unsplash.com/photo-1556228720-195a672e8a03?q=80&w=500&auto=format&fit=crop'],
            ['nama_produk'=>'Rose Face Mist Refill 300ml','brand'=>'Garnier','harga'=>40000,'harga_asli'=>72000,'kategori'=>'isulang','kondisi'=>'baru','deskripsi'=>'Face mist refill dengan ekstrak mawar. Kemasan ramah lingkungan.','foto'=>'https://images.unsplash.com/photo-1580870069867-74c57ee1bb07?q=80&w=500&auto=format&fit=crop'],
        ];

        foreach ($products as $p) {
            Product::create(array_merge($p, [
                'user_id' => $seller->id,
                'status' => 'tersedia',
            ]));
        }
    }
}
