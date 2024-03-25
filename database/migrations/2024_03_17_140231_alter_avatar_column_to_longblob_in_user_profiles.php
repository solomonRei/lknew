<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Using raw SQL to change the column type to LONGBLOB
        DB::statement("ALTER TABLE user_profiles MODIFY avatar LONGBLOB NULL");
    }

    public function down()
    {
        // Revert to the previous type or another suitable type if rolling back
        DB::statement("ALTER TABLE user_profiles MODIFY avatar LONGBLOB NULL");
    }
};
