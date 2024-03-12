<?php

namespace App\Models;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGetData($query, $month, $status)
    {
        $v = verta()->startMonth()->subMonths($month - 1);

        // Convert jalali to gregorian
        $data = Verta::jalaliToGregorian($v->year, $v->month, $v->day);

        // Convert gregorian to carbon
        $carbon = Carbon::create($data[0], $data[1], $data[2]);

        return $query->where('created_at', '>', $carbon)
            ->where('status', $status)
            ->get();
    }
}
