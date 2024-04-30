<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $banner
 * @property int $event_type
 * @property int $geo_type
 * @property int $status_type
 * @property int $specialist_id
 * @property string $start_date
 * @property string $end_date
 * @property string $location
 * @property string $contact
 * @property string|null $email
 * @property string|null $web_url
 * @property bool $is_publish
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Database\Factories\EventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereBanner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereGeoType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereIsPublish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSpecialistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStatusType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereWebUrl($value)
 *
 * @mixin \Eloquent
 */
class Event extends Model
{
    use HasFactory;
}
