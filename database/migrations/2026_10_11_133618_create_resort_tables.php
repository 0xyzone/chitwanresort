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
        Schema::create('room_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_category_id')->nullable()->constrained('room_categories')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('base_price', 10, 2);
            $table->unsignedInteger('capacity_adults')->default(2);
            $table->unsignedInteger('capacity_children')->default(1);
            $table->string('view_type')->default('Garden View');
            $table->string('bed_type')->default('King Size');
            $table->string('room_size')->nullable();
            $table->json('amenities')->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('room_id')->constrained('rooms')->cascadeOnDelete();
            $table->string('guest_name');
            $table->string('guest_email');
            $table->string('guest_phone');
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->unsignedInteger('adults')->default(1);
            $table->unsignedInteger('children')->default(0);
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->string('status')->default('pending'); // pending, confirmed, checked_in, completed, cancelled
            $table->string('payment_status')->default('unpaid'); // unpaid, partial, paid
            $table->text('special_requests')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('duration')->nullable();
            $table->string('difficulty')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price_per_person', 10, 2)->nullable();
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category')->default('resort_grounds'); // rooms, wildlife_safari, resort_grounds, dining, events
            $table->string('image_path')->nullable();
            $table->string('video_url')->nullable();
            $table->text('caption')->nullable();
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('status')->default('unread'); // unread, contacted, closed
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name');
            $table->string('guest_country')->default('Nepal');
            $table->unsignedTinyInteger('rating')->default(5);
            $table->text('review_text');
            $table->string('avatar')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->boolean('is_published')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('galleries');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('room_categories');
    }
};
