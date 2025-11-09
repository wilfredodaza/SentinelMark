<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Models\Configuration;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        $c_model = new Configuration();
        $c_model->save([
            'name_app' => 'Sentinel Mark',
            'icon_app' => '',
            'email' => '',
            'intro' => NULL,
            'footer' => NULL,
            'register' => 'active',
            'meta_description' => NULL,
            'meta_keywords' => NULL,
            'background_image' => NULL,
            'favicon' => 'Logo1.svg',
            'background_img_vertical' => NULL,
            'primary_color' => 'ce3226',
            'secundary_color' => '464987',
            'captcha' => 'active'
        ]);
    }
}
