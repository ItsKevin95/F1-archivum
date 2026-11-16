<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gp extends Model
{
    protected $table = 'gp';
    protected $primaryKey = 'datum';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['datum', 'nev', 'helyszin'];

    public function eredmenyek(): HasMany
    {
        return $this->hasMany(Eredmeny::class, 'datum', 'datum');
    }
}
