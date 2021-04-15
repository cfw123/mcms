<?php

namespace App\Models\Admin;


use App\Models\Base;

/**
 * App\Models\Admin\Product
 *
 * @property int $id
 * @property string $name 名称
 * @property string $src 图片地址
 * @property string $cate 类别
 * @property string $subCate 子类别
 * @property string $isShow 是否展示
 * @property string $isHot 是否热门
 * @property string $isRem 是否推荐
 * @property string $site 所属网站
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereCate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereIsHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereIsRem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereSubCate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Base
{
    //
    protected $guarded = ['file'];
    public function getSrcAttribute($value) {
        return env('APP_URL').$value;
    }
}
