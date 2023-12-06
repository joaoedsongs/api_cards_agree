<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    # Relations
        public function types(){
            return $this->belongsToMany(Type::class, 'card_type');
        }
        public function rarity(){
            return $this->hasOne(Rarity::class, 'id', 'rarity_id');
        }

        public function expansion(){
            return $this->hasOne(Expansion::class, 'id', 'expansion_id');
        }

    # Casts
        protected $casts = [
            'created_at' => 'datetime:d-m-Y',
            'updated_at' => 'datetime:d-m-Y',
        ];

}
