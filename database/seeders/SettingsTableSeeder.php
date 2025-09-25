<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['key' => 'about_title', 'value' => 'Mengenal Lebih Dekat <span class="highlight">E-Modul</span> Platform']);
        Setting::create(['key' => 'about_description', 'value' => 'E-Modul Platform hadir sebagai solusi inovatif untuk pembelajaran berdiferensiasi. Kami berkomitmen untuk menyediakan akses mudah ke modul ajar berkualitas tinggi yang dirancang untuk memenuhi beragam gaya dan kebutuhan belajar.']);
        Setting::create(['key' => 'about_vision_title', 'value' => 'Visi Kami']);
        Setting::create(['key' => 'about_vision_description', 'value' => 'Menjadi platform terdepan dalam memfasilitasi pendidikan yang inklusif dan adaptif, memberdayakan setiap individu untuk mencapai potensi akademis dan personal terbaiknya.']);
        Setting::create(['key' => 'about_mission_title', 'value' => 'Misi Kami']);
        Setting::create(['key' => 'about_mission_list', 'value' => '<li>Menyediakan modul ajar berdiferensiasi yang inovatif dan relevan.</li>
                <li>Memastikan aksesibilitas materi pembelajaran bagi semua kalangan.</li>
                <li>Mendukung pendidik dalam menciptakan lingkungan belajar yang dinamis dan efektif.</li>
                <li>Mendorong kolaborasi dan berbagi pengetahuan di komunitas pendidikan.</li>']);
        Setting::create(['key' => 'about_closing_text', 'value' => 'Kami percaya bahwa dengan teknologi dan pedagogi yang tepat, proses belajar dapat menjadi pengalaman yang lebih menarik, personal, dan efektif. Bergabunglah dengan kami dalam perjalanan membangun masa depan pendidikan!']);

        Setting::create(['key' => 'home_title', 'value' => 'Buat dan Pelajari<br>Modul Ajar<br>Berdiferensiasi <span class="highlight">lebih<br>Menyenangkan</span>']);
        Setting::create(['key' => 'home_description', 'value' => 'Selamat datang di E-Modul. All in one platform pembuatan dan
                pembelajaran modul ajar berdiferensiasi sekaligus.']);
    }
}