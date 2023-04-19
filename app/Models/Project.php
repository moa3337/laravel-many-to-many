<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['type_id', 'title', 'image', 'text', 'published'];

    // # Relazioni

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // @ Getter

    public function getAbstract($max = 40)
    {
        return substr($this->text, 0, $max) . "...";
    }

    public static function generateSlug($title)
    {
        $possible_slug = Str::of($title)->slug('_');
        // toDo: controllare che lo slug sia unico, se no rigeneralo finchè non lo si trova
        $projects = Project::where('slug', $possible_slug)->get();
        $original_slug = $possible_slug;
        $i = 2;
        while (count($projects)) {
            $possible_slug = $original_slug . "." . $i;
            $projects = Project::where('slug', $possible_slug)->get();
            $i++;
        }

        return $possible_slug;
    }

    // Mutators - formattazione date

    protected function getUpdatedAttribute($value)
    {
        return date('d/m/y', strtotime($value));
    }
    protected function getCreatedAttribute($value)
    {
        return date('D/M/Y', strtotime($value));
    }
    public function getImageUri()
    {
        return $this->image ? asset('storage/' . $this->image) : 'https://media.istockphoto.com/id/1147544807/it/vettoriale/la-commissione-per-la-immagine-di-anteprima-grafica-vettoriale.jpg?s=612x612&w=0&k=20&c=gsxHNYV71DzPuhyg-btvo-QhhTwWY0z4SGCSe44rvg4=';
    }
}
