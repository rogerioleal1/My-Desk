<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('type');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('system_id');
            $table->unsignedInteger('priority');
            $table->string('subject', 150);
            $table->text('description');
            $table->text('solution')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->index();
            $table->unsignedInteger('assigned_to')->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedTinyInteger('rating')->nullable();
            $table->dateTime('solved_at')->nullable();
            $table->timestamps();
            $table->softDeletes()->index();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('system_id')->references('id')->on('systems');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('assigned_to')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
