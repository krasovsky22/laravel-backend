<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsForeignIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->foreignId('pick_up_location')->constrained('locations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('delivery_location')->constrained('locations')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropForeign(['pick_up_location']);
            $table->dropForeign(['delivery_location']);
            $table->dropForeign(['created_by']);
        });
    }
}
