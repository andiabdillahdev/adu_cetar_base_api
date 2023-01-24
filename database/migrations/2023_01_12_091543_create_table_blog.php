<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_blog', function (Blueprint $table) {
            $table->unsignedBigInteger('id_category_blog');
            $table->id();
            $table->foreign('id_category_blog')->references('id')->on('category_blogs');
            $table->string('title');
            $table->date('date');
            $table->text('body');
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
        Schema::dropIfExists('table_blog');
    }
}
