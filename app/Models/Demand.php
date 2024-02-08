<?php

namespace App\Models;

use App\Models\User;
use App\Models\Holiday;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demand extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'date',
        'user_id',
        'holiday_id',
    ];

    public function user () {
        return $this->HasMany(User::class);
    }

    public function holiday () {
        return $this->HasMany(Holiday::class);
    }
}
