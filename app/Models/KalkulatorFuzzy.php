<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KalkulatorFuzzy extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'fuzzy_bbu' => 'array',
        'fuzzy_tbu' => 'array',
        'fuzzy_bbtb' => 'array',
        'kondisi_anak' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}