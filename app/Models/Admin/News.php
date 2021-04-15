<?php

namespace App\Models\Admin;

use App\Models\Base;

/**
 * App\Models\Admin\News
 *
 * @property int $id
 * @property string $name 名称
 * @property string $cate 类别
 * @property string $subCate 子类别
 * @property string $isShow 是否展示
 * @property string $isHot 是否热门
 * @property string $isRem 是否推荐
 * @property string|null $site 所属网站
 * @property string|null $shot_cont 简介
 * @property string|null $src 缩略图片
 * @property string|null $content 新闻内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereCate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereIsHot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereIsRem($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereShotCont($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereSubCate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\News whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class News extends Base
{
    //
    protected $guarded = ['file'];
    public function getSrcAttribute($value) {
        return env('APP_URL').$value;
    }
}
