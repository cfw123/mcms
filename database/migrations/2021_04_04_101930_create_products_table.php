<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->default('')->comment('名称');
            $table->string('src',50)->default('')->comment('图片地址');
            $table->string('cate',32)->default('')->comment('类别');
            $table->string('subCate',32)->default('')->comment('子类别');
            $table->string('isShow',8)->default('T')->comment('是否展示');
            $table->string('isHot',8)->default('T')->comment('是否热门');
            $table->string('isRem',8)->default('T')->comment('是否推荐');
            $table->string('site',50)->default('')->comment('所属网站');
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
        Schema::dropIfExists('products');
    }
}
