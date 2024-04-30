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
 *
 * @method static \Database\Factories\SpecialistFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Specialist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Specialist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialist whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialist whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Specialist whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Specialist extends Model
{
    use HasFactory;
}
