<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Sale extends Model
{
    //
    //belongsTo設定
    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }
    
    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'id',
        'product_id',
        'created_at',
        'updated_at'
    ];



}
