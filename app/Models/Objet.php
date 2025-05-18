<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objet extends Model
{
    protected $fillable = [
        'titre',
        'description', 
        'lieu',
        'date_trouvaille',
        'photo',
        'categorie',
        'statut',
        'user_id'
    ];

    protected $casts = ['date_trouvaille' => 'datetime']; // Conversion en Carbon

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}