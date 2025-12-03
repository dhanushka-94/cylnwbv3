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
        Schema::table('sliders', function (Blueprint $table) {
            // Add new fields - all nullable to preserve existing data
            $table->string('alt_text')->nullable()->after('image_path');
            $table->string('button_text')->nullable()->after('link_url');
            $table->string('target')->default('_self')->after('link_url'); // _self or _blank
            $table->string('mobile_image_path')->nullable()->after('image_path');
            $table->dateTime('start_date')->nullable()->after('is_active');
            $table->dateTime('end_date')->nullable()->after('start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            // Remove the added columns if migration is rolled back
            $table->dropColumn([
                'alt_text',
                'button_text',
                'target',
                'mobile_image_path',
                'start_date',
                'end_date'
            ]);
        });
    }
};
