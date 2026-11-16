<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pilota extends Model
{
    protected $table = 'pilota';
    protected $primaryKey = 'az';
    public $timestamps = false;

    protected $fillable = ['nev', 'nem', 'szuldat', 'nemzet'];

    protected $casts = ['szuldat' => 'date'];

    public function eredmenyek(): HasMany
    {
        return $this->hasMany(Eredmeny::class, 'pilotaaz', 'az');
    }
}
