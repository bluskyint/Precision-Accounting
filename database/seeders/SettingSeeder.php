<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'head_title' => 'precision',
            'seo_title' => 'precision',
            'seo_description' => 'precision',
            'seo_keywords' => 'precision',
            'address' => 'precision',
            'location' => 'precision',
            'email' => 'precision@gmail.com',
            'phone' => '123456789',
            'sms' => '123456789',
            'whatsapp' => 'http://precision.com',
            'linkedin' => 'http://precision.com',
            'facebook' => 'http://precision.com',
            'twitter' => 'http://precision.com',
            'youtube' => 'http://precision.com',
        ]);
    }
}
