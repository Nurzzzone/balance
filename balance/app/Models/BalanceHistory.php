<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BalanceHistory
 *
 * @property int $id
 * @property float $value
 * @property float $balance
 * @property int $user_id
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\Models\User $owner
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceHistory whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceHistory whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceHistory whereValue($value)
 * @mixin \Eloquent
 */
class BalanceHistory extends Model
{
    use HasFactory;
    protected $table = 'balance_history';
    protected $fillable = ['value','balance'];
    public const UPDATED_AT = null;

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value): array
    {
        return [
            'date' => Carbon::parse($value)->format('d M Y'),
            'time' => Carbon::parse($value)->toTimeString()
        ];
    }
}
