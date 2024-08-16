<?php

namespace Database\Seeders;

use App\Models\Plant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $savour = [
            "manfaat1"=>"Meningkatkan daya tahan tubuh",
            "manfaat2"=>"Mengubah sel-sel abnormal menjadi seperti semula"
        ];
        $encode = json_encode($savour);
        $data = [
            'name' => 'Ginseng Panax',
            'slug' => 'ginseng-panax',
            'latin_name' => 'Panax Ginseng',
            'description' => "Ginseng (Panax) adalah spesies terna berkhasiat obat yang termasuk dalam 
            suku Araliaceae. Ginseng tumbuh di wilayah belahan bumi utara terutama di Siberia, Manchuria, Korea, dan Amerika Serikat. 
            Ginseng digunakan dalam pengobatan tradisional. Akar tanaman ini dapat memperbaiki aliran dan meningkatkan produksi sel darah merah, serta membantu pemulihan dari penyakit.",
            'image_url' => 'roots-ginseng-market-Asian-Korean.webp',
            'savour'=> $encode
        ];
        Plant::create($data);
    }
}
