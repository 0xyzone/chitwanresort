<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Inquiry;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ResortDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Roles & Permissions setup
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $managerRole = Role::firstOrCreate(['name' => 'resort_manager', 'guard_name' => 'web']);
        $receptionistRole = Role::firstOrCreate(['name' => 'receptionist', 'guard_name' => 'web']);

        // Default Super Admin User (if not already existing)
        $admin = User::firstOrCreate(
            ['email' => 'admin@chitwantigerresorts.com'],
            [
                'name' => 'Resort Administrator',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($superAdminRole);

        // Receptionist User
        $receptionist = User::firstOrCreate(
            ['email' => 'reception@chitwantigerresorts.com'],
            [
                'name' => 'Front Desk Reception',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $receptionist->assignRole($receptionistRole);

        // 2. Room Categories
        $kingCategory = RoomCategory::firstOrCreate(
            ['slug' => 'king-suites'],
            [
                'name' => 'King Suites',
                'description' => 'Spacious master bedrooms equipped with plush king size bedding and quiet courtyard views.',
                'icon' => 'heroicon-o-home-modern',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $deluxeCategory = RoomCategory::firstOrCreate(
            ['slug' => 'deluxe-rooms'],
            [
                'name' => 'Deluxe Rooms',
                'description' => 'Comfortable and affordable retreat designed for leisure travelers and families visiting Nawalpur.',
                'icon' => 'heroicon-o-sparkles',
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        $balconyCategory = RoomCategory::firstOrCreate(
            ['slug' => 'riverfront-balcony'],
            [
                'name' => 'Riverfront & Balcony Rooms',
                'description' => 'Premium rooms featuring scenic private balconies overlooking the Narayani River and National Park horizon.',
                'icon' => 'heroicon-o-building-office-2',
                'is_active' => true,
                'sort_order' => 3,
            ]
        );

        // 3. Rooms (Real Resort Offerings from specifications)
        $deluxeRoom = Room::firstOrCreate(
            ['slug' => 'deluxe-room'],
            [
                'room_category_id' => $deluxeCategory->id,
                'name' => 'Deluxe Room',
                'base_price' => 2500.00,
                'capacity_adults' => 2,
                'capacity_children' => 1,
                'view_type' => 'Garden View',
                'bed_type' => 'Double Bed',
                'room_size' => '280 sq.ft',
                'amenities' => [
                    'Complimentary Breakfast',
                    'High-speed Free Wi-Fi',
                    'Attached Modern Bathroom',
                    'Air Conditioning & Ceiling Fan',
                    'Electric Kettle with Tea/Coffee',
                    '24/7 Hot & Cold Running Water',
                    'Daily Housekeeping',
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1566665797739-1674de7a421a?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?auto=format&fit=crop&w=1000&q=80',
                ],
                'description' => 'Our Deluxe Room offers cozy comfort and peaceful garden surroundings at an affordable rate. Fitted with warm Tharu ethnic touches, premium linens, air conditioning, and full Wi-Fi coverage.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $kingRoom = Room::firstOrCreate(
            ['slug' => 'king-size-room'],
            [
                'room_category_id' => $kingCategory->id,
                'name' => 'King Size Room',
                'base_price' => 3500.00,
                'capacity_adults' => 2,
                'capacity_children' => 2,
                'view_type' => 'Garden & Park View',
                'bed_type' => 'King Size Bed',
                'room_size' => '360 sq.ft',
                'amenities' => [
                    'Buffet Breakfast Included',
                    'Spacious King Size Bed',
                    'High-speed Free Wi-Fi',
                    'Mini-Bar Refrigerator',
                    'Smart LED TV',
                    'Attached En-Suite Bathroom',
                    'Air Conditioning',
                    'Work Desk & Lounge Chair',
                    'Pickup & Drop Available',
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?auto=format&fit=crop&w=1000&q=80',
                ],
                'description' => 'Indulge in spacious safari luxury with our signature King Size Room. Features an expansive plush king mattress, private seating lounge, stocked mini-bar, and picturesque views of the lush Devchuli landscape.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        $deluxeKingBalcony = Room::firstOrCreate(
            ['slug' => 'deluxe-king-room-with-balcony'],
            [
                'room_category_id' => $balconyCategory->id,
                'name' => 'Deluxe King Room with Balcony',
                'base_price' => 4500.00,
                'capacity_adults' => 2,
                'capacity_children' => 2,
                'view_type' => 'River & Forest View',
                'bed_type' => 'Super King Bed',
                'room_size' => '440 sq.ft',
                'amenities' => [
                    'Private Scenic Balcony with Outdoor Seating',
                    'Breakfast & Welcome Welcome Drink',
                    'Direct Views of Narayani River & Chitwan Forest',
                    'Mini-Bar Refrigerator & Tea Bar',
                    'Smart 43" LED Television',
                    'Luxury En-Suite Bathroom with Rain Shower',
                    'High-speed Free Wi-Fi',
                    '24-Hour Room Service',
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?auto=format&fit=crop&w=1200&q=80',
                'gallery' => [
                    'https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=1000&q=80',
                    'https://images.unsplash.com/photo-1591088398332-8a7791972843?auto=format&fit=crop&w=1000&q=80',
                ],
                'description' => 'Our crown jewel accommodation offering breathtaking golden-hour sunsets over the Narayani River. Step onto your private balcony to listen to birds and wildlife while enjoying morning tea.',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ]
        );

        // 4. Safari & Jungle Activities
        Activity::firstOrCreate(
            ['slug' => 'jeep-safari-chitwan'],
            [
                'title' => 'Chitwan Jeep Safari Exploration',
                'duration' => '4 Hours (Half Day)',
                'difficulty' => 'Easy',
                'excerpt' => 'Venture into the deep sal forest and grasslands to encounter One-Horned Rhinos, Royal Bengal Tigers, Deer, and exotic wildlife.',
                'description' => 'Experience the untamed wilderness of Chitwan National Park Buffer Zone on an open-top 4x4 Jeep Safari. Led by our licensed senior naturalists, you will visit ancient waterholes, rhino grazing tracks, and dense canopy corridors.',
                'price_per_person' => 2500.00,
                'featured_image' => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        Activity::firstOrCreate(
            ['slug' => 'narayani-river-boating'],
            [
                'title' => 'Scenic Boating on Narayani River',
                'duration' => '2 Hours',
                'difficulty' => 'Relaxing',
                'excerpt' => 'Drift along the serene waters of the Narayani River while spotting sunbathing Marsh Mugger crocodiles and Gharials.',
                'description' => 'A magical aquatic voyage along the banks of Narayani and Rapti rivers. Watch migratory bird colonies, freshwater fauna, and witness stunning Himalayan-backed sunsets directly from the boat.',
                'price_per_person' => 1500.00,
                'featured_image' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        Activity::firstOrCreate(
            ['slug' => 'bird-watching-walk'],
            [
                'title' => 'Dawn Bird Watching Expedition',
                'duration' => '2.5 Hours',
                'difficulty' => 'Easy Walk',
                'excerpt' => 'Over 540 species of native and Siberian migratory birds call this river delta home. Guided by seasoned ornithologists.',
                'description' => 'Devchuli and Piprahar river banks are globally celebrated bird havens. Spot Kingfishers, Bengal Floricans, Giant Hornbills, and storks in their natural wetlands as dawn breaks over the Narayani.',
                'price_per_person' => 1200.00,
                'featured_image' => 'https://images.unsplash.com/photo-1452570053594-1b985d6ea890?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ]
        );

        Activity::firstOrCreate(
            ['slug' => 'tharu-cultural-dance'],
            [
                'title' => 'Tharu Cultural Dance & Campfire',
                'duration' => '1.5 Hours',
                'difficulty' => 'Cultural Evening',
                'excerpt' => 'Immerse yourself in authentic indigenous Tharu stick dance rituals, ethnic attire, music, and fireside camaraderie.',
                'description' => 'The indigenous Tharu community carries centuries of harmony with Chitwan’s jungle. Every evening at Sishwar Chitwan Tiger Resort, enjoy traditional Danda Nach (stick dance) and drumming beside our bonfire.',
                'price_per_person' => 800.00,
                'featured_image' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=1200&q=80',
                'is_featured' => false,
                'is_active' => true,
                'sort_order' => 4,
            ]
        );

        // 5. Gallery items
        $galleryItems = [
            [
                'title' => 'One-Horned Rhino Grazing Near Narayani Bank',
                'category' => 'wildlife_safari',
                'image_path' => 'https://images.unsplash.com/photo-1575550959106-5a7defe28b56?auto=format&fit=crop&w=1000&q=80',
                'caption' => 'A magnificent greater one-horned rhinoceros grazing along the grassland during evening safari.',
            ],
            [
                'title' => 'Resort Evening Ambience & Outdoor Dining',
                'category' => 'resort_grounds',
                'image_path' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1000&q=80',
                'caption' => 'Warm illuminated paths and serene open-air restaurant seating under the Piprahar night sky.',
            ],
            [
                'title' => 'King Room Interior Styling',
                'category' => 'rooms',
                'image_path' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?auto=format&fit=crop&w=1000&q=80',
                'caption' => 'Handcrafted wooden fixtures, crisp white linens, and modern safari conveniences.',
            ],
            [
                'title' => 'Traditional Nepali Thali & Fresh Organic Cuisine',
                'category' => 'dining',
                'image_path' => 'https://images.unsplash.com/photo-1626777552726-4a6b54c97e46?auto=format&fit=crop&w=1000&q=80',
                'caption' => 'Farm-to-table local ingredients prepared with authentic regional Nepali herbs and flavors.',
            ],
            [
                'title' => 'Sunset Boating on the Narayani River',
                'category' => 'events',
                'image_path' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1000&q=80',
                'caption' => 'Golden reflections illuminating the waters where Nawalparasi meets Chitwan National Park.',
            ],
        ];

        foreach ($galleryItems as $idx => $item) {
            Gallery::firstOrCreate(
                ['title' => $item['title']],
                array_merge($item, [
                    'is_published' => true,
                    'sort_order' => $idx + 1,
                ])
            );
        }

        // 6. Testimonials
        $testimonials = [
            [
                'guest_name' => 'Bikash Adhikari',
                'guest_country' => 'Kathmandu, Nepal',
                'rating' => 5,
                'review_text' => 'Staying at Sishwar Chitwan Tiger Resort in Devchuli was the highlight of our family holiday. The river view from the Deluxe King room was breathtaking, and seeing two rhinos on our Jeep Safari was unforgettable!',
            ],
            [
                'guest_name' => 'Elena Rostova',
                'guest_country' => 'Germany',
                'rating' => 5,
                'review_text' => 'Quiet, authentic, and far away from the overcrowded tourist traps of Sauraha. The food was sensational and the morning bird watching walk with their naturalist was world-class.',
            ],
            [
                'guest_name' => 'Suman Thapa',
                'guest_country' => 'Pokhara, Nepal',
                'rating' => 5,
                'review_text' => 'The staff hospitality is 10/10. Great seminar and conference facilities, very clean rooms, reliable high-speed internet, and warm hospitality throughout our corporate retreat.',
            ],
        ];

        foreach ($testimonials as $idx => $testimonial) {
            Testimonial::firstOrCreate(
                ['guest_name' => $testimonial['guest_name']],
                array_merge($testimonial, [
                    'is_featured' => true,
                    'is_published' => true,
                    'sort_order' => $idx + 1,
                ])
            );
        }

        // 7. Seed Initial Sample Booking
        Booking::firstOrCreate(
            ['booking_code' => 'SCTR-DEMO01'],
            [
                'room_id' => $deluxeKingBalcony->id,
                'guest_name' => 'Rajesh Sharma',
                'guest_email' => 'rajesh.sharma@example.com',
                'guest_phone' => '9801234567',
                'check_in_date' => now()->addDays(2)->format('Y-m-d'),
                'check_out_date' => now()->addDays(4)->format('Y-m-d'),
                'adults' => 2,
                'children' => 1,
                'total_amount' => 9000.00,
                'status' => 'confirmed',
                'payment_status' => 'paid',
                'special_requests' => 'Please arrange early morning Jeep Safari pickup and airport drop to Bharatpur.',
                'admin_notes' => 'Confirmed via phone call. Advance received.',
            ]
        );

        // 8. Seed Initial Inquiry
        Inquiry::firstOrCreate(
            ['email' => 'corporate.retreat@example.com'],
            [
                'name' => 'Anil Pokharel',
                'phone' => '9851098765',
                'subject' => 'Corporate Seminar Package for 35 Guests',
                'message' => 'Hello team Sishwar, we are planning a 2-night corporate workshop next month for 35 participants. Could you please provide your seminar hall rates and group dinner buffet pricing?',
                'status' => 'unread',
            ]
        );
    }
}
