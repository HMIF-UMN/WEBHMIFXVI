import { CategoryKey } from "./categories";

export interface NewsArticle {
  id: number;
  category: CategoryKey;
  title: string;
  date: string;
  image: string;
  imageAlt: string;
  excerpt: string;
  content: string;
}

export const newsArticles: Record<number, NewsArticle> = {
  1: {
    id: 1,
    category: "INFORMATION",
    title: 'Informatika UMN Resmi Sandang Status Akreditasi "Unggul" dari LAM INFOKOM',
    date: "22 April 2026",
    image: "/headNews.webp",
    imageAlt: "Featured image",
    excerpt: "TANGERANG - Kabar baik kembali mewarnai perjalanan Program Studi Informatika Universitas Multimedia Nusantara (UMN)...",
    content: `TANGERANG - Kabar baik kembali mewarnai perjalanan Program Studi Informatika Universitas Multimedia Nusantara (UMN). Berdasarkan keputusan terbaru, Program Studi Sarjana Informatika UMN secara resmi meraih peringkat akreditasi "Unggul" dari Lembaga Akreditasi Mandiri Informatika dan Komputer (LAM INFOKOM).

Pencapaian ini menjadi langkah maju yang solid bagi prodi. Status akreditasi nasional tertinggi ini hadir untuk melengkapi hasil akreditasi internasional dari ASIIN yang sudah dikantongi oleh prodi Informatika UMN sebelumnya.

Bagi mahasiswa dan calon mahasiswa, raihan ini bukan sekadar sertifikat di atas kertas. Status akreditasi Unggul ini adalah jaminan mutu. Hal ini membuktikan bahwa kualitas kurikulum, tenaga pengajar, hingga fasilitas di Informatika UMN sudah teruji dan memenuhi standar tertinggi pendidikan nasional sekaligus diakui secara global.

Keberhasilan mempertahankan kualitas ini jelas memberikan keuntungan langsung bagi mahasiswa. Lulusan dari program studi dengan akreditasi Unggul otomatis memiliki daya saing dan kredibilitas yang lebih kuat saat melangkah ke dunia industri teknologi maupun saat ingin melanjutkan studi ke jenjang yang lebih tinggi.

Tentu saja, pencapaian ini adalah hasil kerja keras seluruh dosen, staf, mahasiswa, dan alumni yang terus menjaga kualitas dan reputasi Informatika UMN.`,
  },
  2: {
    id: 2,
    category: "OTHERS",
    title: "HMIF Gen XVI Buka Ruang Evaluasi dan Inspirasi Lewat Studi Banding dengan I'M KOM",
    date: "05 March 2026",
    image: "/berita2.webp",
    imageAlt: "HMIF Gen XVI",
    excerpt: "Tangerang - Sebagai langkah awal untuk mengembangkan kualitas organisasi, Himpunan Mahasiswa Informatika (HMIF) Generasi XVI menggelar program...",
    content: `TANGERANG - Menjelang masa Ujian Tengah Semester (UTS) dan Ujian Akhir Semester (UAS), Himpunan Mahasiswa Informatika (HMIF) Universitas Multimedia Nusantara (UMN) kembali menyelenggarakan program CURSOR. Program belajar bersama ini dirancang khusus untuk membantu mahasiswa Program Studi Informatika mempersiapkan diri dan memahami materi perkuliahan dengan lebih matang.

CURSOR hadir sebagai ruang diskusi dan tutoring yang dipandu oleh rekan mahasiswa yang sudah menguasai materi terkait. Tujuan utamanya adalah memastikan mahasiswa bisa lulus ujian dengan nilai yang memuaskan. Di sini, mahasiswa diajak untuk mengevaluasi kesalahan, memperbaiki pemahaman yang masih keliru, hingga mempelajari hal-hal baru dari mata kuliah yang mungkin belum sempat dibahas tuntas di kelas reguler.

Pada semester ini, program CURSOR diselenggarakan dengan format hybrid sehingga mahasiswa bisa bertanya secara langsung untuk memecahkan keraguan mereka. Rangkaian kelas untuk persiapan UTS berlangsung pada tanggal 11 hingga 26 Maret 2026. Sementara itu, untuk persiapan menjelang UAS, program ini akan kembali dilaksanakan pada tanggal 18 hingga 30 Mei 2026. Beberapa mata kuliah yang menjadi fokus pada periode ini antara lain Probability & Statistics, Algorithms & Data Structure, Calculus, Operating System, hingga Machine Learning dan Computer Network.

Lebih dari sekadar sesi bimbingan belajar, CURSOR juga menjadi momen yang tepat untuk membangun solidaritas. Proses belajar bersama ini mendekatkan sesama mahasiswa Informatika UMN, memberikan mereka kesempatan untuk saling terhubung, berinteraksi, dan menghadapi tekanan ujian secara bersama-sama dalam lingkungan yang suportif.

Melalui pelaksanaan CURSOR 2026, HMIF UMN berharap mahasiswa tidak hanya lebih siap secara akademis, tetapi juga bisa mempererat keakraban antar mahasiswa Informatika UMN.`,
  },
  3: {
    id: 3,
    category: "EMPLOYMENT",
    title: "Tantang Skill Coding Kamu di Web Development Competition 2026",
    date: "22 February 2026",
    image: "/berita3.webp",
    imageAlt: "Web Development Competition",
    excerpt: "Tangerang - Bagi mahasiswa Informatika UMN yang ingin menguji kemampuan pemrograman web dan menambah portofolio nyata, ada kesempatan kompetis...",
    content: `TANGERANG - Bagi mahasiswa Informatika UMN yang ingin menguji kemampuan pemrograman web dan menambah portofolio nyata, ada kesempatan kompetisi tingkat nasional yang patut dicoba. Universitas Atma Jaya Yogyakarta (UAJY) melalui rangkaian Informatics Festival #14 (IFEST) menyelenggarakan ajang Web Development Competition 2026 dan membuka pendaftaran bagi mahasiswa aktif di seluruh Indonesia.

Tahun ini, kompetisi tersebut mengangkat tema "Empowering Students Through Innovative Productivity Tools". Peserta ditantang untuk merancang dan membangun website yang tidak sekadar memiliki visual menarik, tetapi juga fungsional dan membawa dampak. Fokus utamanya adalah menciptakan alat produktivitas yang bisa memecahkan masalah sehari-hari dan membantu aktivitas mahasiswa. Ini adalah wadah yang tepat untuk membuktikan bahwa baris kode yang kamu tulis bisa menjadi solusi praktis.

Kompetisi ini terbuka bagi mahasiswa aktif jenjang D3, D4, dan S1. Kalian bisa membentuk tim dengan jumlah maksimal tiga orang dari perguruan tinggi yang sama. Cukup dengan biaya pendaftaran sebesar Rp 50.000 per tim, peserta berkesempatan memperebutkan total hadiah senilai Rp 3.500.000 beserta piala dan sertifikat pemenang. Selain itu, seluruh peserta yang mengumpulkan karya akan mendapatkan e-certificate.

Rangkaian kegiatan dimulai dengan masa pendaftaran dan pengumpulan karya dari tanggal 22 Februari hingga 17 Maret 2026. Setelah itu, tahap penjurian berlangsung pada 25 hingga 30 Maret 2026. Finalis yang terpilih akan diumumkan pada 31 Maret 2026 dan maju ke tahap presentasi final pada 11 April 2026.

Jangan lewatkan kesempatan untuk mengasah kemampuan teknis sekaligus bersaing dengan developer muda dari berbagai kampus. Informasi lebih lengkap mengenai aturan main, pendaftaran, dan buku panduan lomba dapat diakses langsung melalui situs web resmi di ifest14.my.id.`,
  },
  4: {
    id: 4,
    category: "BEASISWA",
    title: "Mahasiswa Informatika UMN Sabet Deretan Juara di Ajang Nasional dan Internasional",
    date: "18 February 2026",
    image: "/berita4.webp",
    imageAlt: "Mahasiswa Informatika Juara",
    excerpt: "Tangerang - Mengawali tahun 2026, mahasiswa Program Studi Informatika Universitas Multimedia Nusantara (UMN) kembali unjuk gigi di luar kelas....",
    content: `TANGERANG - Mengawali tahun 2026, mahasiswa Program Studi Informatika Universitas Multimedia Nusantara (UMN) kembali unjuk gigi di luar kelas. Mereka membuktikan bahwa kemampuan anak IT tidak sebatas menulis baris kode di layar komputer, tetapi juga tajam dalam memecahkan masalah bisnis dan berani tampil di depan publik.

Di ranah kompetisi teknologi, Khairiansyah Hafizh dan Lintang Balakosa Ardhana dari angkatan 2024 berhasil mengamankan posisi Juara 3 dalam ajang Developer Battle 2025. Beralih ke analisis bisnis, Felicia Annabel Ruriyanto (IF 2023) sukses meraih Juara 2 pada ajang Global Business Case Competition IPB 180 Degree Consulting.

Keterampilan komunikasi publik yang matang juga membawa Audrey Christabelle H., Rafael Natanael, dan Descellia Ng (IF 2023) meraih penghargaan Best Presenter dalam International Business Case Competition (IBCC) 2026. Prestasi di forum akademis juga tidak kalah membanggakan. Linda Sundoko (IF 2023) berhasil menorehkan namanya sebagai peraih Best Presentation Award dalam Lifelong Learning Conference.

Selain itu, Richard Wijaya (IF 2023) membuktikan bahwa mahasiswa teknologi memiliki pemahaman bahasa dan budaya yang kuat dengan keluar sebagai Juara 2 Duta Bahasa Provinsi Banten.

Deretan capaian ini memperlihatkan satu realitas yang jelas. Mahasiswa Informatika UMN memiliki kualitas yang fleksibel dan relevan dengan tuntutan dunia kerja saat ini. Mereka jago secara teknis, cakap berkomunikasi, paham ekosistem bisnis, dan siap bersaing di mana saja.`,
  },
};

export function getOtherArticles(excludeId: number): NewsArticle[] {
  return Object.values(newsArticles).filter((article) => article.id !== excludeId);
}

