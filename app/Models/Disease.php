<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $disease_category_id
 * @property string $name
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\DiseaseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Disease newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Disease newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Disease query()
 * @method static \Illuminate\Database\Eloquent\Builder|Disease whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disease whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disease whereDiseaseCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disease whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disease whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Disease whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Disease extends Model
{
    use HasFactory;
}
