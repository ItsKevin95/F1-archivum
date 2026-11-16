<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Eredmeny extends Model
{
    protected $table = 'eredmeny';
    public $timestamps = false;

    protected $fillable = ['datum', 'pilotaaz', 'helyezes', 'hiba', 'csapat', 'tipus', 'motor'];

    public function gp(): BelongsTo
    {
        return $this->belongsTo(Gp::class, 'datum', 'datum');
    }

    public function pilota(): BelongsTo
    {
        return $this->belongsTo(Pilota::class, 'pilotaaz', 'az');
    }
}
