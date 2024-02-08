<?php

namespace App\Models;

use App\Models\Credential;
use App\Models\HolidayType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Holiday extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'start_date',
        'end_date',
        'holiday_type_id',
        'credential_id',
    ];

    public function holidayType () {
        return $this->HasMany(HolidayType::class);
    }

    public function credential () {
        return $this->HasMany(Credential::class);
    }
}
