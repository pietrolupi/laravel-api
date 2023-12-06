<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //creazione colonna foreign key
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            //assegnazione foreign key alla colonna appena creata
            $table->foreign('type_id')
            ->references('id')
            ->on('types')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //eliminazione foreign key
            $table->dropForeign(['type_id']);

            //eliminazione colonna foreign key
            $table->dropColumn('type_id');
        });


    }
};
