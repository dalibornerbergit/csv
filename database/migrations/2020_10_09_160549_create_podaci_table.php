<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodaciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podaci', function (Blueprint $table) {
            $table->id();
            $table->string('ime', 50);
            $table->string('prezime', 50);
            $table->string('postanski_br', 16);
            $table->string('grad');
            $table->string('telefon', 16);
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
        Schema::dropIfExists('podaci');
    }
}
