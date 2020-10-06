<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortofoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portofolios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('portofolio_name');
            $table->integer('category_id')->unsigned();
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('portofolio_categorys')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('price');
            $table->text('description');
            $table->string('status');
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
        Schema::dropIfExists('portofolios');
    }
}
