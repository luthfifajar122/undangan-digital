<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'name' => 'Elegan Jawa',
                'slug' => 'jawa',
                'category' => 'Klasik',
                'preview_image' => 'templates/preview/jawa.png',
                'blade_path' => 'templates.jawa.layout',
                'config_json' => [
                    'colors' => [
                        'primary' => '#8B6947',
                        'secondary' => '#D8C3A8',
                        'background' => '#FEFEFA',
                        'text' => '#3D2E1F',
                    ],
                    'fonts' => [
                        'heading' => 'Georgia, serif',
                        'body' => "'Instrument Sans', sans-serif",
                    ],
                    'layout' => [
                        'event_style' => 'vertical_cards',
                        'envelope_animation' => 'fade_slide',
                        'gallery_columns' => 3,
                    ],
                    'defaults' => [
                        'music_volume' => 0.3,
                        'countdown_show' => true,
                    ],
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Minimalis Modern',
                'slug' => 'minimalis',
                'category' => 'Modern',
                'preview_image' => 'templates/preview/minimalis.png',
                'blade_path' => 'templates.minimalis.layout',
                'config_json' => [
                    'colors' => [
                        'primary' => '#51483E',
                        'secondary' => '#D6C6B2',
                        'background' => '#FAF9F7',
                        'text' => '#2D2D2D',
                    ],
                    'fonts' => [
                        'heading' => "'Playfair Display', serif",
                        'body' => "'Inter', sans-serif",
                    ],
                    'layout' => [
                        'event_style' => 'vertical_cards',
                        'envelope_animation' => 'fade',
                        'gallery_columns' => 4,
                    ],
                    'defaults' => [
                        'music_volume' => 0.25,
                        'countdown_show' => true,
                    ],
                ],
                'is_active' => true,
            ],
            [
                'name' => 'Islami',
                'slug' => 'islami',
                'category' => 'Islami',
                'preview_image' => 'templates/preview/islami.png',
                'blade_path' => 'templates.islami.layout',
                'config_json' => [
                    'colors' => [
                        'primary' => '#415443',
                        'secondary' => '#A58A5D',
                        'background' => '#F5F3EF',
                        'text' => '#2C3E33',
                    ],
                    'fonts' => [
                        'heading' => "'Amiri', serif",
                        'body' => "'Instrument Sans', sans-serif",
                    ],
                    'layout' => [
                        'event_style' => 'vertical_cards',
                        'envelope_animation' => 'slide_up',
                        'gallery_columns' => 3,
                    ],
                    'defaults' => [
                        'music_volume' => 0.2,
                        'countdown_show' => true,
                    ],
                ],
                'is_active' => true,
            ],
        ];

        foreach ($templates as $template) {
            Template::create($template);
        }
    }
}
