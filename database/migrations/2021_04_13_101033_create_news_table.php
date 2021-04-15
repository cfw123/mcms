<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->default('')->comment('名称');
            $table->string('cate',32)->default('')->comment('类别');
            $table->string('subCate',32)->default('')->comment('子类别');
            $table->string('isShow',8)->default('T')->comment('是否展示');
            $table->string('isHot',8)->default('T')->comment('是否热门');
            $table->string('isRem',8)->default('T')->comment('是否推荐');
            $table->string('site',50)->default('')->comment('所属网站');
            $table->string('shot_cont',200)->default('')->comment('简介');
            $table->string('src',100)->default('')->comment('缩略图片');
            $table->text('content')->comment('新闻内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
