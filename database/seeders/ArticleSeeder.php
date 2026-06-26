<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $destDir = public_path('uploads/information');
        if (! File::exists($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        Article::truncate();

        foreach ($this->articles() as $index => $a) {
            $filename = $this->persistImage($a, $destDir, $index + 1);

            Article::create([
                'category'     => $a['category'],
                'title'        => $a['title'],
                'published_at' => Carbon::parse($a['date'])->toDateString(),
                'image_path'   => "information/{$filename}",
                'image_alt'    => $a['title'],
                'excerpt'      => $a['excerpt'],
                'content'      => $a['content'],
                'is_published' => true,
            ]);
        }
    }

    private function persistImage(array $article, string $destDir, int $seq): string
    {
        if (isset($article['local_image'])) {
            return $this->copyLocalImage($article['local_image'], $destDir, $seq);
        }

        return $this->downloadImage($article['image_url'], $destDir, $seq);
    }

    private function copyLocalImage(string $localName, string $destDir, int $seq): string
    {
        $srcPath = public_path($localName);
        $ext = pathinfo($localName, PATHINFO_EXTENSION) ?: 'webp';
        $filename = \sprintf('seed-%02d.%s', $seq, $ext);
        $destPath = "{$destDir}/{$filename}";

        if (File::exists($srcPath)) {
            File::copy($srcPath, $destPath);
        } else {
            $this->command?->warn("Local image not found: {$srcPath}");
        }

        return $filename;
    }

    private function downloadImage(string $url, string $destDir, int $seq): string
    {
        $ext = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
        $filename = \sprintf('seed-%02d.%s', $seq, $ext);
        $destPath = "{$destDir}/{$filename}";

        if (File::exists($destPath)) {
            return $filename;
        }

        try {
            $response = Http::withoutVerifying()->timeout(20)->get($url);
            if ($response->successful()) {
                File::put($destPath, $response->body());
            } else {
                $this->command?->warn("Failed to download {$url} (HTTP {$response->status()})");
            }
        } catch (\Throwable $e) {
            $this->command?->warn("Error downloading {$url}: {$e->getMessage()}");
        }

        return $filename;
    }

    private function articles(): array
    {
        return [
            [
                'category'  => 'EMPLOYMENT',
                'title'     => 'HACKATHON ADA DI UMN?? Yuk, ikutan Garuda Hacks 7.0 - Hackathon Terbesar di Indonesia',
                'date'      => '23 June 2026',
                'image_url' => 'https://inf.umn.ac.id/app/storage/Berita/OwASzlAP8AchY1gkpQrFEHWkrbUUjkbLkFOwh8Vd.png',
                'excerpt'   => 'Garuda Hacks 7.0 resmi hadir langsung di Universitas Multimedia Nusantara dengan total hadiah IDR 42M+ dan kesempatan networking internasional.',
                'content'   => <<<TEXT
                TANGERANG - TOTAL HADIAH IDR 42M+ & ADDITIONAL TECH REWARDS! Beneran, kamu gak salah baca. Angka sebesar ini siap dibawa pulang oleh tim dengan inovasi terbaik tahun ini!

                Pernah gak sih ngebayangin ide project atau coretan codingan kamu berubah jadi solusi nyata yang berdampak besar?

                Kabar baiknya, Garuda Hacks 7.0 resmi hadir langsung di Universitas Multimedia Nusantara! Didukung oleh HMIF UMN. Ini adalah ajang hackathon maraton intensif berskala internasional tempat berkumpulnya para tech enthusiast, developer, designer, dan innovator untuk merancang dan men-deploy software/aplikasi secara kilat. Bukan cuma soal coding, ini panggung emas buat kamu memperluas networking dan presentasi di depan juri profesional.

                Tahun ini, Garuda Hacks 7.0 menantang kamu untuk membawa perubahan lewat 3 Track Utama: Health (solusi digital untuk mendukung ekosistem kesehatan), Safety (sistem mutakhir untuk menjaga keamanan fisik maupun cyber), dan Agriculture & Food (teknologi cerdas demi ketahanan pangan dan agrikultur).

                Jangan sampai slotnya habis, amankan kursi tim kamu sekarang di https://www.garudahacks.com/

                Catat detail jadwalnya: Lokasi di Universitas Multimedia Nusantara (UMN), waktu 16 – 18 Juli 2026.

                Bentuk tim terbaikmu sekarang, dan mari kita tunjukkan kalau mahasiswa UMN siap jadi pelopor inovasi masa depan!
                TEXT,
            ],
            [
                'category'  => 'INFORMATION',
                'title'     => 'Tim Mindstream Bawa Pulang Juara 1 Nasional di Ajang Code the Future AI Summit 2026',
                'date'      => '23 May 2026',
                'image_url' => 'https://inf.umn.ac.id/app/storage/Berita/uElUo7y7MR1q94LXoWF8jbUuuG1t75tVhm0k1433.jpg',
                'excerpt'   => 'Mahasiswa Informatika UMN yang tergabung dalam tim Mindstream sukses merebut posisi Juara 1 dalam ajang kompetisi Code the Future AI Summit 2026.',
                'content'   => <<<TEXT
                Mahasiswa Program Studi Informatika Universitas Multimedia Nusantara (UMN) kembali menorehkan prestasi membanggakan di ranah teknologi. Kali ini, mahasiswa Informatika UMN yang tergabung dalam tim Mindstream sukses merebut posisi Juara 1 dalam ajang kompetisi Code the Future AI Summit 2026.

                Kompetisi berskala nasional ini diselenggarakan oleh Yayasan Gerakan Generasi Digital atau GenDigital Academy bersama Skystar Capital dan Hacktiv8 Indonesia. Puncak acara kompetisi ini telah berlangsung pada hari Sabtu, 23 Mei 2026, berlokasi di TCC Batavia Tower One, Jakarta. Code the Future AI Summit 2026 sendiri merupakan garis akhir dari rangkaian hackathon kecerdasan buatan (AI) nasional yang sudah berjalan selama dua bulan terakhir. Program ini dirancang khusus untuk mengajak generasi muda Indonesia membangun solusi nyata berbasis AI guna menjawab berbagai permasalahan di sekitar mereka.

                Ajang ini berhasil mengumpulkan lebih dari 120 pelajar, mahasiswa, builder, dan komunitas teknologi. Pada kategori tingkat universitas, kompetisi berjalan cukup ketat dengan ragam solusi AI yang mendalam di sektor pendidikan dan finansial. Para finalis mempresentasikan berbagai inovasi, mulai dari sistem rekomendasi pengadaan cerdas untuk pabrik kelapa sawit, aplikasi pelestarian bahasa dan budaya lokal, hingga sistem AI multi-agen untuk mengamankan pengambilan keputusan pinjaman online. Di tengah persaingan ide-ide brilian tersebut, tim Mindstream dari Informatika UMN berhasil tampil menonjol, meyakinkan para juri, dan keluar sebagai pemenang utama kategori university.

                Keberhasilan ini membuktikan bahwa mahasiswa Informatika UMN sangat adaptif dan siap bersaing di era kecerdasan buatan. Sebagaimana yang disoroti dalam acara tersebut, perkembangan teknologi AI membuat proses membangun sebuah solusi menjadi jauh lebih cepat dan mudah diakses. Jarak antara sekadar ide dan eksekusi nyata kini semakin kecil.

                Kemenangan tim Mindstream menjadi bukti konkret bahwa talenta muda Informatika UMN tidak hanya berhenti pada tahap konsep, tetapi mampu mengeksekusinya menjadi solusi teknologi yang siap memberi dampak bagi masyarakat luas. Selamat kepada tim Mindstream atas pencapaian luar biasa ini!
                TEXT,
            ],
            [
                'category'  => 'OTHERS',
                'title'     => 'INFORTA 2026: Rayakan Ulang Tahun Informatika UMN dalam Virtual Universe ala OASIS',
                'date'      => '20 May 2026',
                'image_url' => 'https://inf.umn.ac.id/app/storage/Berita/JA8ElwfvvAsnlDjPqoGi7mE3g7pW9FbOY1aSae5m.webp',
                'excerpt'   => 'Perayaan ulang tahun Program Studi Informatika UMN hadir dengan konsep virtual universe ala OASIS yang interaktif dan kompetitif.',
                'content'   => <<<TEXT
                TANGERANG - Tahun ini, perayaan ulang tahun Program Studi Informatika UMN hadir dengan konsep yang sangat berbeda dan segar. Mengusung tajuk INFORTA 2026 (Informatics Anniversary), perayaan ini siap membawa mahasiswa masuk ke dalam virtual universe penuh warna ala OASIS. Ini bukan sekadar pesta perayaan biasa, melainkan sebuah quest besar tempat kalian bisa tumbuh bersama, membangun aliansi, dan membuka pengalaman baru yang tidak mungkin didapatkan di dalam ruang kelas.

                INFORTA pada dasarnya adalah momen krusial bagi seluruh mahasiswa Informatika untuk berkumpul dan merefleksikan perjalanan selama satu tahun ke belakang. Ajang ini menjadi tempat untuk merayakan berbagai pencapaian sekaligus memperkuat rasa solidaritas komunitas. Melalui rangkaian aktivitas yang interaktif dan kompetitif, INFORTA memberi ruang bagi setiap individu untuk saling terhubung dan menciptakan kenangan. Pada akhirnya, acara ini merayakan esensi utama kita, yaitu komunitas Informatika UMN yang terus berkembang dan melangkah maju bersama.

                Rangkaian INFORTA akan mulai bergulir pada tanggal 20 April 2026. Fokus utamanya adalah kolaborasi, di mana peserta akan menyelesaikan berbagai permainan seru secara berkelompok. Untuk pendaftarannya, kamu memiliki fleksibilitas penuh, baik dengan membuat tim sendiri lalu mengundang teman, maupun bergabung secara acak dengan tim yang sudah ada.

                Untuk acara puncaknya: Waktu pelaksanaan Rabu 20 Mei 2026, mulai pukul 17.00 hingga 21.30 WIB. Lokasi di Function Hall, Gedung A, Universitas Multimedia Nusantara. Aturan pakaian bebas dan nyaman, tetapi pastikan tetap mematuhi regulasi pakaian kampus UMN. Setiap peserta wajib membawa Kartu Tanda Mahasiswa (KTM) sebagai akses masuk.

                Selama acara berlangsung, pihak panitia juga sudah menyediakan konsumsi untuk seluruh peserta yang hadir. Jangan sampai ketinggalan, segera daftarkan dirimu atau tim kamu melalui situs resmi.
                TEXT,
            ],
            [
                'category'  => 'OTHERS',
                'title'     => 'Persiapan UAS Makin Dekat, HMIF UMN Rilis Jadwal CURSOR Hybrid 2026',
                'date'      => '18 May 2026',
                'image_url' => 'https://inf.umn.ac.id/app/storage/Berita/ozQ1AeHEcpxYpNiasSbwIqN44ydZn1ZvrlvYMSVi.jpg',
                'excerpt'   => 'HMIF UMN merilis jadwal hybrid CURSOR untuk persiapan UAS, mencakup enam sesi mata kuliah inti selama akhir Mei.',
                'content'   => <<<TEXT
                TANGERANG - Ujian Akhir Semester (UAS) tinggal beberapa minggu lagi. Untuk membantu mahasiswa yang masih ragu atau butuh pemantapan materi sebelum ujian, Himpunan Mahasiswa Informatika (HMIF) UMN kembali menghadirkan program belajar bersama, CURSOR.

                Pelaksanaan CURSOR pada semester ini mengusung format hybrid. Pendekatan ini dirancang agar segala keraguan yang dialami teman-teman mahasiswa bisa langsung ditanyakan dan dipecahkan secara tatap muka.

                Berikut adalah jadwal lengkap pelaksanaan CURSOR UAS 2026:

                Operating System - Kamis, 21 Mei 2026, 18.30 WIB, Ruang D1605.
                Calculus - Senin, 25 Mei 2026, 18.00 WIB, Ruang D1605.
                Computer Network - Senin, 25 Mei 2026, 19.00 WIB, Ruang D1606.
                Algorithms & Data Structure - Selasa, 26 Mei 2026, 19.00 WIB, Ruang D1605.
                Machine Learning - Jumat, 29 Mei 2026, 18.30 WIB, Ruang D1605.
                Computer Architecture & Organization - Jumat, 29 Mei 2026, 19.00 WIB, ONLINE.

                Catat jadwalnya dan pastikan kamu bergabung di sesi mata kuliah yang paling kamu butuhkan. Manfaatkan fasilitas ini sebaik mungkin agar persiapan UAS lebih terarah dan matang.
                TEXT,
            ],
            [
                'category'  => 'EMPLOYMENT',
                'title'     => 'Belajar Langsung dari Industri, HMIF UMN Gelar CodeConnect ke Kawan Lama Group',
                'date'      => '20 April 2026',
                'image_url' => 'https://inf.umn.ac.id/app/storage/Berita/D9nHeOMej7007aR64pOsl24JIqrcDj8YJF4y9yCM.webp',
                'excerpt'   => 'HMIF UMN menggelar CodeConnect ke Kawan Lama Group untuk memberi mahasiswa pengalaman industri langsung dari profesional di lapangan.',
                'content'   => <<<TEXT
                TANGERANG - Mengisi waktu luang kuliah dengan pengalaman nyata di dunia kerja, Himpunan Mahasiswa Informatika (HMIF) UMN kembali menggelar program CodeConnect. Kali ini, para mahasiswa akan diajak berkunjung langsung ke kantor Kawan Lama Group yang berlokasi di Gedung Kawan Lama, Kembangan, Jakarta Barat. Kunjungan industri ini dijadwalkan berlangsung pada hari Senin, 20 April 2026, mulai pukul 11.00 hingga 18.00 WIB.

                Bagi yang belum familier, CodeConnect adalah kegiatan company visit rutin yang diinisiasi oleh HMIF UMN. Tujuannya jelas: memberi ruang bagi mahasiswa untuk belajar langsung dari para profesional, melihat operasional perusahaan sehari-hari, dan mengenal realitas industri IT dari dekat. Lebih dari itu, ajang ini menjadi kesempatan emas bagi mahasiswa untuk memperluas jaringan relasi dan menggali insight baru sebagai bekal merintis karier ke depannya.

                Selama kunjungan di Kawan Lama Group, peserta tidak hanya duduk diam mendengarkan teori. Berikut adalah beberapa agenda utama yang telah disiapkan:

                Office Tour: Mahasiswa akan diajak berkeliling untuk melihat dan merasakan langsung seperti apa suasana serta lingkungan kerja di dalam Kawan Lama Group.

                Cybersecurity Talk: Sesi pemaparan khusus yang membahas pengalaman praktis dan wawasan baru seputar dunia keamanan siber (Cybersecurity) langsung bersama ahlinya.

                Sharing Session: Forum diskusi untuk membedah skill apa saja yang benar-benar dibutuhkan di industri saat ini, mendengar pengalaman riil para pakar, serta mengetahui langkah persiapan yang tepat untuk meniti karier di bidang IT.

                Program seperti CodeConnect ini merupakan langkah konkret agar mahasiswa tidak hanya tajam secara teori di dalam kelas, tetapi juga paham ekspektasi industri dan siap beradaptasi dengan ritme dunia kerja yang sebenarnya.
                TEXT,
            ],
            [
                'category'    => 'INFORMATION',
                'title'       => 'Informatika UMN Resmi Sandang Status Akreditasi "Unggul" dari LAM INFOKOM',
                'date'        => '22 April 2026',
                'local_image' => 'headNews.webp',
                'excerpt'   => 'Program Studi Sarjana Informatika UMN secara resmi meraih peringkat akreditasi "Unggul" dari LAM INFOKOM, melengkapi akreditasi internasional ASIIN.',
                'content'   => <<<TEXT
                TANGERANG - Kabar baik kembali mewarnai perjalanan Program Studi Informatika Universitas Multimedia Nusantara (UMN). Berdasarkan keputusan terbaru, Program Studi Sarjana Informatika UMN secara resmi meraih peringkat akreditasi "Unggul" dari Lembaga Akreditasi Mandiri Informatika dan Komputer (LAM INFOKOM).

                Pencapaian ini menjadi langkah maju yang solid bagi prodi. Status akreditasi nasional tertinggi ini hadir untuk melengkapi hasil akreditasi internasional dari ASIIN yang sudah dikantongi oleh prodi Informatika UMN sebelumnya.

                Bagi mahasiswa dan calon mahasiswa, raihan ini bukan sekadar sertifikat di atas kertas. Status akreditasi Unggul ini adalah jaminan mutu. Hal ini membuktikan bahwa kualitas kurikulum, tenaga pengajar, hingga fasilitas di Informatika UMN sudah teruji dan memenuhi standar tertinggi pendidikan nasional sekaligus diakui secara global.

                Keberhasilan mempertahankan kualitas ini jelas memberikan keuntungan langsung bagi mahasiswa. Lulusan dari program studi dengan akreditasi Unggul otomatis memiliki daya saing dan kredibilitas yang lebih kuat saat melangkah ke dunia industri teknologi maupun saat ingin melanjutkan studi ke jenjang yang lebih tinggi.

                Tentu saja, pencapaian ini adalah hasil kerja keras seluruh dosen, staf, mahasiswa, dan alumni yang terus menjaga kualitas dan reputasi Informatika UMN.
                TEXT,
            ],
            [
                'category'  => 'OTHERS',
                'title'     => 'CURSOR 2026: HMIF UMN Fasilitasi Mahasiswa Informatika Belajar Bareng Hadapi UTS dan UAS',
                'date'      => '11 March 2026',
                'image_url' => 'https://inf.umn.ac.id/app/storage/Berita/NnP3EWkMvFSzFLxGxyAFeH6Z15hK23BQeL8ErgID.jpg',
                'excerpt'   => 'HMIF UMN menyelenggarakan CURSOR, program tutoring sebaya format hybrid untuk membantu mahasiswa Informatika siap menghadapi UTS dan UAS.',
                'content'   => <<<TEXT
                TANGERANG - Menjelang masa Ujian Tengah Semester (UTS) dan Ujian Akhir Semester (UAS), Himpunan Mahasiswa Informatika (HMIF) Universitas Multimedia Nusantara (UMN) kembali menyelenggarakan program CURSOR. Program belajar bersama ini dirancang khusus untuk membantu mahasiswa Program Studi Informatika mempersiapkan diri dan memahami materi perkuliahan dengan lebih matang.

                CURSOR hadir sebagai ruang diskusi dan tutoring yang dipandu oleh rekan mahasiswa yang sudah menguasai materi terkait. Tujuan utamanya adalah memastikan mahasiswa bisa lulus ujian dengan nilai yang memuaskan. Di sini, mahasiswa diajak untuk mengevaluasi kesalahan, memperbaiki pemahaman yang masih keliru, hingga mempelajari hal-hal baru dari mata kuliah yang mungkin belum sempat dibahas tuntas di kelas reguler.

                Pada semester ini, program CURSOR diselenggarakan dengan format hybrid sehingga mahasiswa bisa bertanya secara langsung untuk memecahkan keraguan mereka. Rangkaian kelas untuk persiapan UTS berlangsung pada tanggal 11 hingga 26 Maret 2026. Sementara itu, untuk persiapan menjelang UAS, program ini akan kembali dilaksanakan pada tanggal 18 hingga 30 Mei 2026. Beberapa mata kuliah yang menjadi fokus pada periode ini antara lain Probability & Statistics, Algorithms & Data Structure, Calculus, Operating System, hingga Machine Learning dan Computer Network.

                Lebih dari sekadar sesi bimbingan belajar, CURSOR juga menjadi momen yang tepat untuk membangun solidaritas. Proses belajar bersama ini mendekatkan sesama mahasiswa Informatika UMN, memberikan mereka kesempatan untuk saling terhubung, berinteraksi, dan menghadapi tekanan ujian secara bersama-sama dalam lingkungan yang suportif.

                Melalui pelaksanaan CURSOR 2026, HMIF UMN berharap mahasiswa tidak hanya lebih siap secara akademis, tetapi juga bisa mempererat keakraban antar mahasiswa Informatika UMN.
                TEXT,
            ],
            [
                'category'    => 'OTHERS',
                'title'       => 'HMIF Gen XVI Buka Ruang Evaluasi dan Inspirasi Lewat Studi Banding dengan I\'M KOM',
                'date'        => '05 March 2026',
                'local_image' => 'berita2.webp',
                'excerpt'   => 'HMIF Gen XVI menggelar studi banding internal pertama bersama I\'M KOM UMN untuk bertukar wawasan dan memperkuat kualitas organisasi.',
                'content'   => <<<TEXT
                Sebagai langkah awal untuk mengembangkan kualitas organisasi, Himpunan Mahasiswa Informatika (HMIF) Generasi XVI menggelar program kerja Studi Banding internal pertama mereka pada Kamis, 5 Maret 2026. Dalam edisi perdana ini, HMIF melibatkan seluruh jajaran pengurusnya untuk duduk bareng dan bertukar wawasan dengan Ikatan Mahasiswa Komunikasi (I'M KOM) UMN.

                Kegiatan ini bukan sekadar ajang silaturahmi biasa. Studi banding ini dirancang dengan target yang jelas, yaitu memperluas relasi antar himpunan, menggali inspirasi baru yang inovatif, dan yang paling krusial, menjadi sarana evaluasi internal. Dengan melihat langsung cara kerja himpunan lain, HMIF Gen XVI memiliki tolok ukur untuk menilai apa yang sudah berjalan efektif dan apa yang masih perlu dibenahi dalam sistem kerja mereka sendiri.

                Sekilas, latar belakang anak IT dan anak Komunikasi memang terlihat jauh berbeda. Namun saat bicara soal menjalankan program kerja kampus, tantangan lapangan yang dihadapi sering kali serupa. Lewat pertemuan ini, pengurus HMIF bisa belajar banyak tentang cara I'M KOM meracik strategi komunikasi publik yang luwes dan membangun daya tarik sebuah acara. Sebaliknya, teman-teman I'M KOM juga bisa melihat pendekatan terstruktur khas mahasiswa Informatika dalam mengeksekusi sebuah proyek.

                Semuanya berlangsung santai, penuh tawa, tapi tetap padat wawasan. Langkah ini jelas membawa dampak positif dan sejalan dengan cara kerja yang berpandangan ke depan. Berbagai ide dan masukan yang didapat dari pertemuan pada awal Maret ini akan langsung dijadikan modal untuk meningkatkan standar kualitas program kerja HMIF Gen XVI ke depannya.
                TEXT,
            ],
            [
                'category'    => 'EMPLOYMENT',
                'title'       => 'Tantang Skill Coding Kamu di Web Development Competition 2026',
                'date'        => '22 February 2026',
                'local_image' => 'berita3.webp',
                'excerpt'   => 'Universitas Atma Jaya Yogyakarta menggelar Web Development Competition 2026 dengan tema productivity tools dan total hadiah Rp 3.500.000.',
                'content'   => <<<TEXT
                TANGERANG - Bagi mahasiswa Informatika UMN yang ingin menguji kemampuan pemrograman web dan menambah portofolio nyata, ada kesempatan kompetisi tingkat nasional yang patut dicoba. Universitas Atma Jaya Yogyakarta (UAJY) melalui rangkaian Informatics Festival #14 (IFEST) menyelenggarakan ajang Web Development Competition 2026 dan membuka pendaftaran bagi mahasiswa aktif di seluruh Indonesia.

                Tahun ini, kompetisi tersebut mengangkat tema "Empowering Students Through Innovative Productivity Tools". Peserta ditantang untuk merancang dan membangun website yang tidak sekadar memiliki visual menarik, tetapi juga fungsional dan membawa dampak. Fokus utamanya adalah menciptakan alat produktivitas yang bisa memecahkan masalah sehari-hari dan membantu aktivitas mahasiswa. Ini adalah wadah yang tepat untuk membuktikan bahwa baris kode yang kamu tulis bisa menjadi solusi praktis.

                Kompetisi ini terbuka bagi mahasiswa aktif jenjang D3, D4, dan S1. Kalian bisa membentuk tim dengan jumlah maksimal tiga orang dari perguruan tinggi yang sama. Cukup dengan biaya pendaftaran sebesar Rp 50.000 per tim, peserta berkesempatan memperebutkan total hadiah senilai Rp 3.500.000 beserta piala dan sertifikat pemenang. Selain itu, seluruh peserta yang mengumpulkan karya akan mendapatkan e-certificate.

                Rangkaian kegiatan dimulai dengan masa pendaftaran dan pengumpulan karya dari tanggal 22 Februari hingga 17 Maret 2026. Setelah itu, tahap penjurian berlangsung pada 25 hingga 30 Maret 2026. Finalis yang terpilih akan diumumkan pada 31 Maret 2026 dan maju ke tahap presentasi final pada 11 April 2026.

                Jangan lewatkan kesempatan untuk mengasah kemampuan teknis sekaligus bersaing dengan developer muda dari berbagai kampus. Informasi lebih lengkap mengenai aturan main, pendaftaran, dan buku panduan lomba dapat diakses langsung melalui situs web resmi di ifest14.my.id.
                TEXT,
            ],
            [
                'category'    => 'INFORMATION',
                'title'       => 'Mahasiswa Informatika UMN Sabet Deretan Juara di Ajang Nasional dan Internasional',
                'date'        => '18 February 2026',
                'local_image' => 'berita4.webp',
                'excerpt'   => 'Mahasiswa Informatika UMN menorehkan deretan prestasi di kompetisi teknologi, bisnis, dan presentasi tingkat nasional maupun internasional di awal 2026.',
                'content'   => <<<TEXT
                TANGERANG - Mengawali tahun 2026, mahasiswa Program Studi Informatika Universitas Multimedia Nusantara (UMN) kembali unjuk gigi di luar kelas. Mereka membuktikan bahwa kemampuan anak IT tidak sebatas menulis baris kode di layar komputer, tetapi juga tajam dalam memecahkan masalah bisnis dan berani tampil di depan publik.

                Di ranah kompetisi teknologi, Khairiansyah Hafizh dan Lintang Balakosa Ardhana dari angkatan 2024 berhasil mengamankan posisi Juara 3 dalam ajang Developer Battle 2025. Beralih ke analisis bisnis, Felicia Annabel Ruriyanto (IF 2023) sukses meraih Juara 2 pada ajang Global Business Case Competition IPB 180 Degree Consulting.

                Keterampilan komunikasi publik yang matang juga membawa Audrey Christabelle H., Rafael Natanael, dan Descellia Ng (IF 2023) meraih penghargaan Best Presenter dalam International Business Case Competition (IBCC) 2026. Prestasi di forum akademis juga tidak kalah membanggakan. Linda Sundoko (IF 2023) berhasil menorehkan namanya sebagai peraih Best Presentation Award dalam Lifelong Learning Conference.

                Selain itu, Richard Wijaya (IF 2023) membuktikan bahwa mahasiswa teknologi memiliki pemahaman bahasa dan budaya yang kuat dengan keluar sebagai Juara 2 Duta Bahasa Provinsi Banten.

                Deretan capaian ini memperlihatkan satu realitas yang jelas. Mahasiswa Informatika UMN memiliki kualitas yang fleksibel dan relevan dengan tuntutan dunia kerja saat ini. Mereka jago secara teknis, cakap berkomunikasi, paham ekosistem bisnis, dan siap bersaing di mana saja.
                TEXT,
            ],
        ];
    }
}
