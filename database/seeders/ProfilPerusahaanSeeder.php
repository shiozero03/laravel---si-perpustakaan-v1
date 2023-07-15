<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
        	[
        		'kategori' => 'Overview',
        		'teks' => '
        			<p> &nbsp;&nbsp;&nbsp;&nbsp; Perpustakaan di SMA Negeri 1 Cilamaya adalah pusat sumber daya utama bagi siswa dan guru untuk belajar, mengeksplorasi, dan menemukan berbagai informasi yang dibutuhkan. Perpustakaan tersebut memiliki koleksi buku yang luas dan beragam, mulai dari buku-buku pelajaran hingga buku-buku fiksi, biografi, dan referensi. Selain itu, perpustakaan ini juga dilengkapi dengan fasilitas modern seperti komputer, printer, dan akses internet yang memudahkan siswa dalam melakukan riset dan mengakses informasi yang lebih luas.</p>
        			<p> &nbsp;&nbsp;&nbsp;&nbsp; Selain menjadi tempat untuk membaca dan belajar, perpustakaan SMA Negeri 1 Cilamaya juga sering digunakan sebagai tempat untuk mengadakan kegiatan-kegiatan yang berkaitan dengan literasi, seperti lomba baca puisi, lomba menulis cerpen, dan diskusi buku. Kegiatan ini diadakan dengan tujuan untuk meningkatkan minat baca siswa dan memperkenalkan sastra serta budaya literasi kepada siswa. Perpustakaan di SMA Negeri 1 Cilamaya memiliki peran yang sangat penting dalam mendukung kegiatan belajar mengajar di sekolah dan membantu siswa dalam mencapai prestasi akademik yang lebih baik. </p>'
        	],
        	[
        		'kategori' => 'Visi',
        		'teks' => '
        			<p> &nbsp;&nbsp;&nbsp;&nbsp; Visi dari perpustakaan SMA Negeri 1 Cilamaya adalah menjadi pusat informasi dan literasi yang terdepan di wilayahnya. Dengan mengutamakan kualitas dan keberlanjutan, perpustakaan ini bertujuan untuk memberikan akses informasi yang lebih luas dan mendukung kemajuan pendidikan di daerah tersebut. Selain itu, perpustakaan juga berkomitmen untuk terus mengembangkan diri dan mengikuti perkembangan teknologi informasi guna memberikan pelayanan yang lebih baik kepada penggunanya. Dengan visi ini, perpustakaan SMA Negeri 1 Cilamaya berharap dapat memberikan kontribusi yang positif bagi pendidikan dan perkembangan literasi di masyarakat setempat.</p>'
        	],
        	[
        		'kategori' => 'Misi',
        		'teks' => '
        			<ol>
        				<li>Menyediakan koleksi bahan pustaka yang bervariasi dan aktual untuk memenuhi kebutuhan pengguna.</li>
        				<li>Meningkatkan minat baca dan literasi di kalangan siswa dan masyarakat melalui kegiatan-kegiatan seperti lomba membaca, bedah buku, dan diskusi literasi.</li>
        				<li>Mengoptimalkan layanan perpustakaan dengan memanfaatkan teknologi informasi, seperti perangkat lunak manajemen perpustakaan dan portal informasi online.</li>
        				<li>Memberikan bimbingan dan informasi tentang tata cara penggunaan bahan pustaka serta pemanfaatan teknologi informasi.</li>
        				<li>Membangun kerjasama dengan pihak-pihak terkait, seperti dinas pendidikan, lembaga pemerintah, dan komunitas literasi untuk meningkatkan kualitas dan aksesibilitas layanan perpustakaan.</li>
        				<li>Mengembangkan budaya membaca dan literasi di kalangan siswa dan masyarakat melalui program-program sosial dan edukatif seperti donasi buku, penggalangan dana, dan kegiatan-kegiatan literasi di luar ruang perpustakaan.</li>
        			<\ol>
        		'
        	]
        ];
        \App\Models\ProfilPerusahaan::insert($data);
    }
}
