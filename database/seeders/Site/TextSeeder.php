<?php

namespace Database\Seeders\Site;

use Illuminate\Database\Seeder;
use Domain\Site\Text\Models\Text;

class TextSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // Header / Hero
            [
                'name' => 'nom_entreprise',
                'fr'   => 'Société LALI',
                'en'   => 'Société LALI',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'description_entete',
                'fr'   => 'Savourez des snacks délicieux et sains, faits avec passion.',
                'en'   => 'Enjoy healthy and delicious snacks made with passion.',
                'fr_l' => null,
                'en_l' => null,
            ],

            // Why Us section (intro text)
            [
                'name' => 'text_apropos',
                'fr'   => 'Des ingrédients de qualité et un savoir-faire unique pour des snacks savoureux.',
                'en'   => 'Quality ingredients and unique know-how for tasty snacks.',
                'fr_l' => 'Des ingrédients de qualité et un savoir-faire unique pour des snacks savoureux.',
                'en_l' => 'Quality ingredients and unique know-how for tasty snacks.',
            ],
            // Why Us items
            [
                'name' => 'why_quality_title',
                'fr'   => 'Qualité',
                'en'   => 'Quality',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'why_quality_desc',
                'fr'   => 'Des produits contrôlés et approuvés.',
                'en'   => 'Products that are tested and approved.',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'why_innovation_title',
                'fr'   => 'Innovation',
                'en'   => 'Innovation',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'why_innovation_desc',
                'fr'   => 'Des saveurs originales et modernes.',
                'en'   => 'Original and modern flavors.',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'why_availability_title',
                'fr'   => 'Disponibilité',
                'en'   => 'Availability',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'why_availability_desc',
                'fr'   => 'En stock et livrés rapidement.',
                'en'   => 'In stock and delivered quickly.',
                'fr_l' => null,
                'en_l' => null,
            ],

            // Footer / Contact
            [
                'name' => 'address_line1',
                'fr'   => 'Yaoundé',
                'en'   => 'Yaoundé',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'address_line2',
                'fr'   => 'Cameroun',
                'en'   => 'Cameroon',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'contact_phone',
                'fr'   => '+237 678 805 224',
                'en'   => '+237 678 805 224',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'contact_email',
                'fr'   => 'contact@societelali.com',
                'en'   => 'contact@societelali.com',
                'fr_l' => null,
                'en_l' => null,
            ],

            // Social links
            [
                'name' => 'social_twitter',
                'fr'   => '#',
                'en'   => '#',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'social_facebook',
                'fr'   => 'https://web.facebook.com/profile.php?id=61552399170957',
                'en'   => 'https://web.facebook.com/profile.php?id=61552399170957',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'social_instagram',
                'fr'   => 'https://www.instagram.com/lalichips/',
                'en'   => 'https://www.instagram.com/lalichips/',
                'fr_l' => null,
                'en_l' => null,
            ],
            [
                'name' => 'social_linkedin',
                'fr'   => '#',
                'en'   => '#',
                'fr_l' => null,
                'en_l' => null,
            ],

            // Vidéo (optionnel, si vous stockez l'URL dans Text)
            [
                'name' => 'video1',
                'fr'   => 'https://www.youtube.com/watch?v=Y7f98aduVJ8',
                'en'   => 'https://www.youtube.com/watch?v=Y7f98aduVJ8',
                'fr_l' => null,
                'en_l' => null,
            ],
        ];

        foreach ($items as $data) {
            Text::updateOrCreate(
                ['name' => $data['name']],
                [
                    'fr'   => $data['fr'] ?? null,
                    'en'   => $data['en'] ?? null,
                    'fr_l' => $data['fr_l'] ?? null,
                    'en_l' => $data['en_l'] ?? null,
                ]
            );
        }
    }
}

