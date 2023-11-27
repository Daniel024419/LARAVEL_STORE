<?php

namespace App\Models\API\V1\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class productsModel extends Model
{
    use  HasFactory, Notifiable;


    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'price',
        'description',
        'picture',
        'expiry_date',
        'ftm_date',
        'password',
        'expired',
     ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expiry_date' => 'date',
        'ftm_date' => 'date',
        'expired' => 'boolean',
    ];
}