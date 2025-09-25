<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'name' => 'Pengenalan Pemrograman Web',
                'file' => 'module-1-web-programming.pdf',
                'link_video' => [
                    'https://youtube.com/watch?v=intro-web-1',
                    'https://youtube.com/watch?v=intro-web-2',
                    'https://youtube.com/watch?v=intro-web-3'
                ],
                'category' => 'Web Development',
                'description' => 'Modul pengenalan dasar pemrograman web yang mencakup HTML, CSS, dan JavaScript. Cocok untuk pemula yang ingin memulai karir di bidang web development.',
                'author' => 'Prof. Ahmad Wijaya',
                'image' => 'modules/web-programming.jpg',
            ],
            [
                'name' => 'Database dan MySQL',
                'file' => 'module-2-database-mysql.pdf',
                'link_video' => [
                    'https://youtube.com/watch?v=mysql-basics-1',
                    'https://youtube.com/watch?v=mysql-basics-2'
                ],
                'category' => 'Database',
                'description' => 'Mempelajari konsep database relasional dan implementasinya menggunakan MySQL. Termasuk design database, query optimization, dan best practices.',
                'author' => 'Dr. Siti Rahma',
                'image' => 'modules/database-mysql.jpg',
            ],
            [
                'name' => 'Framework Laravel',
                'file' => 'module-3-laravel-framework.pdf',
                'link_video' => [
                    'https://youtube.com/watch?v=laravel-intro-1',
                    'https://youtube.com/watch?v=laravel-mvc-2',
                    'https://youtube.com/watch?v=laravel-eloquent-3',
                    'https://youtube.com/watch?v=laravel-auth-4'
                ],
                'category' => 'PHP Framework',
                'description' => 'Panduan lengkap menggunakan Laravel framework untuk membangun aplikasi web modern. Mencakup MVC, Eloquent ORM, Authentication, dan API development.',
                'author' => 'Ir. Budi Santoso',
                'image' => 'modules/laravel-framework.jpg',
            ],
            [
                'name' => 'Mobile App Development dengan React Native',
                'file' => 'module-4-react-native.pdf',
                'link_video' => [
                    'https://youtube.com/watch?v=react-native-setup-1',
                    'https://youtube.com/watch?v=react-native-components-2',
                    'https://youtube.com/watch?v=react-native-navigation-3'
                ],
                'category' => 'Mobile Development',
                'description' => 'Belajar membangun aplikasi mobile cross-platform menggunakan React Native. Dari setup environment hingga deployment ke App Store dan Google Play.',
                'author' => 'M.Kom. Lisa Permata',
                'image' => 'modules/react-native.jpg',
            ],
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}
