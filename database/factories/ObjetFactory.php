<?php

use App\Models\Objet;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObjetFactory extends Factory
{
    protected $model = Objet::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->word,
            'description' => $this->faker->sentence,
            'lieu' => $this->faker->city,
            'date_trouvaille' => $this->faker->date(),
            'categorie' => $this->faker->randomElement(['vetement', 'electronique', 'autre']),
            'statut' => $this->faker->randomElement(['perdu', 'trouvé']),
            'user_id' => \App\Models\User::factory()
        ];
    }
}