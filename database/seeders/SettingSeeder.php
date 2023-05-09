<?php

namespace Database\Seeders;

// use anlutro\LaravelSettings\Facades\Setting;
use App\Models\Settings;
use App\Models\Tenant;
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
        $settings = [
            'site_name' => 'Laravel 8.x',
            'site_description' => 'This is test description',
            'contact_email' => 'tesing123@yopmail.com',
            'footer_text' => 'Copyright © 2023',
        ];

        foreach ($settings as $key => $value) {
            // Setting::set($key, $value);
            Settings::create([
                'key' => $key,
                'value' => $value,
                'tenant_id' => Tenant::inRandomOrder()->first()->id,
            ]);
        }
    }
}
