<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'gender', 'level', 'sub_category_id', 'job', 'icon', 'ability_max', 'ability_min', 'effect_1', 'effect_2', 'effect_3', 'handed', 'set_id', 'status'
    ];

    public function sub_category()
    {
        return $this->belongsTo('App\Models\SubCategory', 'sub_category_id', 'id');
    }

    public function set()
    {
        return $this->belongsTo('App\Models\Set', 'set_id', 'id');
    }

    public function scopeOnlyActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCategorySettable($query)
    {
        return $query->whereHas('sub_category.category', function ($query) {
            $query->where('name', 'character')->orWhere('name', 'jewelry');
        });
    }

    public function scopeSubCategorySettable($query)
    {
        return $query->whereHas('sub_category', function ($query) {
            $query->where('name', '!=', 'box')->where('name', '!=', 'sets');
        });
    }

    public function scopeNoSet($query)
    {
        return $query->where('set_id', null);
    }
}
