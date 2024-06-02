<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Database\Factories\FAQFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ query()
 *
 * @mixin \Eloquent
 */
class Faqs extends Model
{
    use HasFactory;

    protected $fillable = [
        'faqs_category_id',
        'question',
        'code',
        'answer',
    ];

    /**
     * Get the category that owns the FAQ.
     */
    
    public function category()
    {
        return $this->belongsTo(FaqsCategory::class, 'faqs_category_id');
    }
}
