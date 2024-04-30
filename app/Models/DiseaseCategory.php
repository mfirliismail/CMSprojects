<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Disease> $disease
 * @property-read int|null $disease_count
 *
 * @method static \Database\Factories\DiseaseCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|DiseaseCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiseaseCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DiseaseCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|DiseaseCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiseaseCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiseaseCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiseaseCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DiseaseCategory whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class DiseaseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'name',
    ];

    public function disease()
    {
        return $this->hasMany(Disease::class);
    }
}
