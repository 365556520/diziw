<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideotagsidVideoclasssidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videotagsid_videoclasssids', function (Blueprint $table) {
            $table->integer('videotags_id')->unsigned();
            $table->integer('videoclasss_id')->unsigned();

            $table->foreign('videotags_id')->references('id')->on('videotags')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('videoclasss_id')->references('id')->on('videoclasss')->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['videotags_id','videoclasss_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videotagsid_videoclasssids');
    }
}
