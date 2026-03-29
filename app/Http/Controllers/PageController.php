<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * PageController
 * Menangani semua halaman statis pada platform KosFinder
 */
class PageController extends Controller
{
    /**
     * Menampilkan halaman utama (Home)
     */
    public function home()
    {
        // Data testimoni untuk ditampilkan di halaman home
        $testimonials = [
            [
                'name'   => 'Rina Maharani',
                'role'   => 'Mahasiswi UI',
                'avatar' => 'RM',
                'text'   => 'Berkat KosFinder, saya bisa menemukan kos impian dekat kampus hanya dalam 1 jam! Prosesnya sangat mudah dan transparan.',
                'rating' => 5,
            ],
            [
                'name'   => 'Budi Santoso',
                'role'   => 'Karyawan Startup',
                'avatar' => 'BS',
                'text'   => 'Fitur filter harga dan fasilitas sangat membantu. Tidak perlu cape-cape keliling mencari kos sendiri lagi.',
                'rating' => 5,
            ],
            [
                'name'   => 'Dewi Lestari',
                'role'   => 'Mahasiswi ITB',
                'avatar' => 'DL',
                'text'   => 'Foto kos yang real dan review jujur dari penghuni sebelumnya bikin saya yakin sebelum survey. Recommended banget!',
                'rating' => 5,
            ],
        ];

        // Data fitur unggulan
        $features = [
            [
                'icon'  => 'bi-search',
                'title' => 'Pencarian Cerdas',
                'desc'  => 'Filter berdasarkan lokasi, harga, fasilitas, dan jenis kos sesuai kebutuhanmu.',
                'color' => 'primary',
            ],
            [
                'icon'  => 'bi-camera',
                'title' => 'Foto Real & Akurat',
                'desc'  => 'Semua foto diverifikasi langsung oleh tim kami. Tidak ada foto editan menyesatkan.',
                'color' => 'success',
            ],
            [
                'icon'  => 'bi-shield-check',
                'title' => 'Terverifikasi & Aman',
                'desc'  => 'Setiap kos dan pemilik telah diverifikasi identitasnya untuk keamananmu.',
                'color' => 'warning',
            ],
            [
                'icon'  => 'bi-chat-dots',
                'title' => 'Chat Langsung',
                'desc'  => 'Hubungi pemilik kos langsung melalui platform tanpa perlu nomor pribadi.',
                'color' => 'info',
            ],
        ];

        return view('home', compact('testimonials', 'features'));
    }

    /**
     * Menampilkan halaman About
     */
    public function about()
    {
        // Data statistik perusahaan
        $stats = [
            ['number' => '50K+', 'label' => 'Pengguna Aktif'],
            ['number' => '12K+', 'label' => 'Listing Kos'],
            ['number' => '45+',  'label' => 'Kota Terjangkau'],
            ['number' => '98%',  'label' => 'Kepuasan Pengguna'],
        ];

        // Data visi misi
        $missions = [
            'Menyediakan platform pencarian kos yang transparan dan terpercaya',
            'Membantu pencari kos menemukan hunian yang sesuai kebutuhan dan budget',
            'Memberdayakan pemilik kos dalam memasarkan properti secara digital',
            'Membangun ekosistem hunian sementara yang sehat dan berkelanjutan',
        ];

        return view('about', compact('stats', 'missions'));
    }

    /**
     * Menampilkan halaman Team
     */
    public function team()
    {
        // Data anggota tim
        $teams = [
            [
                'name'    => 'Arief Hidayat',
                'role'    => 'Project Manager',
                'icon'    => 'bi-briefcase',
                'initial' => 'AH',
                'color'   => 'primary',
                'desc'    => 'Berpengalaman 5 tahun di bidang manajemen produk digital dan strategi bisnis.',
                'socials' => ['linkedin' => '#', 'github' => '#'],
            ],
            [
                'name'    => 'Sari Puspita',
                'role'    => 'UI/UX Designer',
                'icon'    => 'bi-palette',
                'initial' => 'SP',
                'color'   => 'pink',
                'desc'    => 'Desainer berpengalaman yang berfokus pada pengalaman pengguna yang intuitif dan estetis.',
                'socials' => ['linkedin' => '#', 'dribbble' => '#'],
            ],
            [
                'name'    => 'Dimas Prasetyo',
                'role'    => 'Frontend Developer',
                'icon'    => 'bi-code-slash',
                'initial' => 'DP',
                'color'   => 'info',
                'desc'    => 'Spesialis React & Vue.js dengan passion pada performa dan aksesibilitas web.',
                'socials' => ['linkedin' => '#', 'github' => '#'],
            ],
            [
                'name'    => 'Novi Anggraini',
                'role'    => 'Backend Developer',
                'icon'    => 'bi-server',
                'initial' => 'NA',
                'color'   => 'success',
                'desc'    => 'Expert Laravel & Node.js yang memastikan sistem berjalan cepat dan aman.',
                'socials' => ['linkedin' => '#', 'github' => '#'],
            ],
            [
                'name'    => 'Fajar Ramadhan',
                'role'    => 'Mobile Developer',
                'icon'    => 'bi-phone',
                'initial' => 'FR',
                'color'   => 'warning',
                'desc'    => 'Flutter developer yang menghadirkan pengalaman mobile yang mulus di iOS dan Android.',
                'socials' => ['linkedin' => '#', 'github' => '#'],
            ],
            [
                'name'    => 'Laras Setiawati',
                'role'    => 'QA Engineer',
                'icon'    => 'bi-bug',
                'initial' => 'LS',
                'color'   => 'danger',
                'desc'    => 'Quality assurance specialist yang memastikan setiap fitur berjalan sempurna sebelum rilis.',
                'socials' => ['linkedin' => '#', 'github' => '#'],
            ],
        ];

        return view('team', compact('teams'));
    }

    /**
     * Menampilkan halaman Contact
     */
    public function contact()
    {
        // Data informasi kontak
        $contacts = [
            [
                'icon'  => 'bi-geo-alt-fill',
                'title' => 'Alamat Kantor',
                'value' => 'Jl. Sudirman No. 88, Jakarta Selatan 12190',
                'color' => 'primary',
            ],
            [
                'icon'  => 'bi-telephone-fill',
                'title' => 'Nomor Telepon',
                'value' => '+62 21 5555 8888',
                'color' => 'success',
            ],
            [
                'icon'  => 'bi-envelope-fill',
                'title' => 'Email',
                'value' => 'hello@kosfinder.id',
                'color' => 'warning',
            ],
            [
                'icon'  => 'bi-clock-fill',
                'title' => 'Jam Operasional',
                'value' => 'Senin – Jumat, 09.00 – 17.00 WIB',
                'color' => 'info',
            ],
        ];

        return view('contact', compact('contacts'));
    }
}
