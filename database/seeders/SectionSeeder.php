<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'id'     => 1,
                'name'    => 'What is BizShiksha ?',
                'key'    => 'what_is_bizshiksha',
                'year_experience'  => 10,
                'short_description'   => null,
                'description'  => '<p>it is an e-learning platform where you can learn different type of skills that will be helpful to create a better future for you.it is an e-learning platform where you can learn different type of skills that will be helpful to create a better future for you.it is an e-learning latform where you can learn different type of skills that will be helpful to create a better future for you a better future for you.</p>',
                'features' => '<li>The vision of BizShiksha is to develop.</li><li>The vision of BizShiksha is to develop.</li><li>The vision of BizShiksha is to develop entrepreneurial.</li>',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'id'     => 2,
                'name'    => 'Why BizShiksha ?',
                'key'    => 'why_bizshiksha',
                'year_experience'  => null,
                'short_description'   => null,
                'description'  => '<p>It is an E-learning platform where you can learn different type of skills that will be helpful to create a better future for you.
                <br>
                BizShiksha is also an affiliate marketing platform where you can earn through promoting products and services.</p>',
                'features' => '<li>The vision of BizShiksha is to develop.</li><li>The vision of BizShiksha is to develop.</li><li>The vision of BizShiksha is to develop entrepreneurial.</li>',
                'status' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
        ];

        Section::insert($sections);
    }
}
