<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('title');
            $table->text('content');
            $table->bigInteger('blog_category_id')->unsigned();
            $table
                ->foreign('blog_category_id')
                ->references('id')
                ->on('blog_categorys')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('cover');
            $table->string('status');
            $table->string('slug');
            $table->timestamps();
            $table->engine = "MyISAM";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
