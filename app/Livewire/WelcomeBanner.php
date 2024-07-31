<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WelcomeBanner extends Component
{
    public function render()
    {
        $motivasiBekerja = [
            "Kerja keras adalah kunci kesuksesan.",
            "Impianmu akan menjadi kenyataan jika kamu bekerja keras untuk itu.",
            "Setiap usaha yang kamu lakukan saat ini akan membawa hasil di masa depan.",
            "Jangan pernah menyerah, karena kesuksesan memerlukan ketekunan.",
            "Ketika kamu merasa lelah, ingatlah mengapa kamu memulai.",
            "Kamu memiliki potensi untuk mencapai apa pun yang kamu inginkan.",
            "Kesuksesan datang kepada mereka yang tidak takut mencobanya.",
            "Jangan biarkan rintangan menghentikanmu, gunakan sebagai pijakan menuju puncak.",
            "Ketika kamu bekerja dengan passion, pekerjaanmu bukan lagi pekerjaan.",
            "Berani mengambil risiko adalah langkah pertama menuju kesuksesan.",
            "Hindari menunda-nunda pekerjaan, selesaikan sekarang juga.",
            "Kamu adalah arsitek masa depanmu sendiri.",
            "Sukses adalah hasil dari kedisiplinan dan kerja keras.",
            "Jadilah orang yang memberikan yang terbaik di setiap tugas yang kamu lakukan.",
            "Pikirkan tentang potensi positif, bukan tentang hambatan.",
            "Kerja keras adalah investasi dalam dirimu sendiri.",
            "Jangan takut mencoba hal baru, itulah cara untuk tumbuh.",
            "Kamu tidak pernah tahu sejauh mana kamu bisa pergi sampai kamu mencoba.",
            "Kamu lebih kuat dari yang kamu kira, jangan pernah meremehkan dirimu sendiri.",
            "Keberhasilan adalah perjalanan, bukan tujuan akhir.",
            "Setiap langkah kecil adalah kemajuan menuju tujuanmu.",
            "Kesuksesan datang kepada mereka yang gigih dan tekun.",
            "Jangan biarkan kegagalan menghentikanmu, lihatlah itu sebagai pelajaran berharga.",
            "Saat kamu berhenti berharap dan mulai bekerja, itulah saat sesuatu terjadi.",
            "Tetap fokus pada tujuanmu, jangan tergoda oleh distraksi.",
            "Bekerja dengan tekad adalah kunci untuk mencapai prestasi luar biasa.",
            "Kamu adalah pencipta cerita hidupmu sendiri.",
            "Pikirkan tentang kesuksesan, bukan tentang kegagalan.",
            "Jangan khawatir tentang apa yang bisa salah, fokus pada apa yang bisa kamu capai.",
            "Setiap hari adalah kesempatan untuk menjadi lebih baik dari kemarin.",
            "Tetap bersyukur atas apa yang kamu miliki saat ini, sambil mencari lebih banyak lagi.",
            "Kamu adalah penentu nasibmu sendiri, bukan kebetulan.",
            "Lakukan apa yang kamu cintai, dan kamu tidak akan pernah merasa bekerja sehari pun.",
            "Kamu memiliki waktu yang terbatas, gunakanlah dengan bijaksana untuk mencapai impianmu.",
            "Kesuksesan adalah hasil dari konsistensi dalam usaha.",
            "Jangan pernah menyerah pada apa yang kamu impikan.",
            "Setiap pekerjaan besar dimulai dengan tindakan kecil.",
            "Jadilah sumber inspirasi bagi orang lain dengan kerja kerasmu.",
            "Jangan membandingkan dirimu dengan orang lain, tetapi dengan dirimu sendiri yang kemarin.",
            "Pikirkan tentang tujuanmu, bukan tentang hambatanmu.",
            "Kejarlah kesuksesan, bukan hanya menghindari kegagalan.",
            "Jangan pernah mengabaikan peluang kecil, karena mereka dapat menjadi besar.",
            "Kamu memiliki potensi tak terbatas untuk mencapai apa pun yang kamu inginkan.",
            "Setiap usaha yang kamu lakukan hari ini adalah investasi dalam masa depanmu.",
            "Jika kamu tidak pernah mencoba, kamu tidak akan pernah tahu apa yang mungkin kamu capai.",
            "Kerja keras adalah bahasa yang semua orang pahami.",
            "Kamu adalah pilihan yang kamu buat, jadi pilihlah dengan bijaksana.",
            "Ketika kamu memberikan yang terbaik, hasilnya akan mengikuti dengan sendirinya.",
            "Pikirkan positif, bertindak positif, dan hasilnya akan positif."
        ];

        // Contoh mengakses satu kalimat secara acak dari array di atas:
        $motivasiHariIni = $motivasiBekerja[rand(0, count($motivasiBekerja) - 1)];

        $currentHour = Carbon::now('Asia/Jakarta')->hour;

        if ($currentHour >= 4 && $currentHour < 12) {
            $greeting = 'Selamat pagi';
        } elseif ($currentHour >= 12 && $currentHour < 15) {
            $greeting = 'Selamat siang';
        } elseif ($currentHour >= 15 && $currentHour < 18) {
            $greeting = 'Selamat sore';
        } else {
            $greeting = 'Selamat malam';
        }

        $user = Auth::user();

        return view('livewire.welcome-banner',[
            'salam' => $greeting,
            'kalimat' => $motivasiHariIni,
            'user' => $user
        ]);
    }
}
