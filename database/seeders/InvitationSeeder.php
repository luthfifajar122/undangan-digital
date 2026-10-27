<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Guest;
use App\Models\Invitation;
use App\Models\Template;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $templates = Template::all();

        foreach ($templates as $template) {
            $invitation = Invitation::create([
                'template_id' => $template->id,
                'slug' => $template->slug.'-demo',
                'bride_name' => $faker->firstNameFemale,
                'groom_name' => $faker->firstNameMale,
                'bride_parents' => 'Bapak '.$faker->firstName.' & Ibu '.$faker->firstNameFemale,
                'groom_parents' => 'Bapak '.$faker->firstName.' & Ibu '.$faker->firstNameFemale,
                'event_date' => now()->addMonths(3)->format('Y-m-d'),
                'event_time' => '10:00:00',
                'address' => $faker->address,
                'venue_name' => 'Gedung '.$faker->city,
                'maps_link' => 'https://maps.google.com/?q='.urlencode($faker->city),
                'story' => $faker->paragraph(3),
                'whatsapp_number' => '628'.$faker->numerify('##########'),
                'status' => 'published',
                'settings_json' => [
                    'colors' => $template->config_json['colors'] ?? [],
                ],
            ]);

            // Create multiple events
            Event::create([
                'invitation_id' => $invitation->id,
                'name' => 'Akad Nikah',
                'date' => $invitation->event_date,
                'time' => '10:00:00',
                'venue_name' => $invitation->venue_name,
                'address' => $invitation->address,
                'sort_order' => 1,
            ]);

            Event::create([
                'invitation_id' => $invitation->id,
                'name' => 'Resepsi',
                'date' => $invitation->event_date,
                'time' => '12:00:00',
                'venue_name' => $invitation->venue_name,
                'address' => $invitation->address,
                'sort_order' => 2,
            ]);

            // Create guests
            for ($i = 0; $i < 20; $i++) {
                Guest::create([
                    'invitation_id' => $invitation->id,
                    'name' => $faker->name,
                    'category' => $faker->randomElement(['keluarga', 'teman', 'kerja', 'lain-lain']),
                    'phone' => '628'.$faker->numerify('##########'),
                    'token' => Guest::generateToken(),
                ]);
            }
        }
    }
}
