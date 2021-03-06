<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    public $timestamps = false;
    protected $perPage = 5;
    protected $fillable = ['name'];
    protected $appends = ['links'];

    public function episode()
    {
        return $this->hasMany(Episode::class);
    }

    public function getLinksAttribute(): array
    {
        return [
            'self' => '/api/series/' . $this->id,
            'episodes' => '/api/series/' . $this->id . '/episodes'
        ];
    }
}