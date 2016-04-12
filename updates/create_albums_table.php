<?php namespace Fes\Album\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateAlbumsTable extends Migration
{

    public function up()
    {
        Schema::create('fes_album_albums', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->date('album_date');
            $table->timestamps();
            $table->boolean('status')->default(1);
            $table->integer('sort_order');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fes_album_albums');
    }
}
