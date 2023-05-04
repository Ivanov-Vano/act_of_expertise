<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attachment;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dir = "/var/www/html/storage/app/public/attachments"; // Например /var/www/localhost/public
        if(!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        Attachment::factory(50)->create();
    }
}
