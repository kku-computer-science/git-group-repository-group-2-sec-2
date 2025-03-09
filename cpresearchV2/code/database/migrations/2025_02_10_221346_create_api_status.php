<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('api_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('api_name')->unique();
            $table->enum('status', ['active', 'inactive']);
            $table->timestamp('last_checked');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_statuses');
    }
};

