<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['label', 'color'];

    // # ralazioni

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // # HTML

    public function getBadgeHTML()
    {
        return '<span class="badge rounded-pill" style="background-color:' .  $this->color  . '">' .
            $this->label .
            '</span>';
    }
}
