<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToCakesTable extends Migration
{
    public function up()
    {
        Schema::table('cakes', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('cakes', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}
