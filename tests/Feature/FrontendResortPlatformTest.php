<?php

namespace Tests\Feature;

use App\Filament\Resources\Activities\ActivityResource;
use App\Filament\Resources\Bookings\BookingResource;
use App\Filament\Resources\Galleries\GalleryResource;
use App\Filament\Resources\Inquiries\InquiryResource;
use App\Filament\Resources\RoomCategories\RoomCategoryResource;
use App\Filament\Resources\Rooms\RoomResource;
use App\Filament\Resources\Testimonials\TestimonialResource;
use App\Models\Activity;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\User;
use Database\Seeders\ResortDatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class FrontendResortPlatformTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(ResortDatabaseSeeder::class);
    }

    public function test_homepage_renders_successfully_with_resort_branding(): void
    {
        $response = $this->get(route('home'));

        $response->assertSuccessful();
        $response->assertSee('Sishwar Chitwan Tiger Resort');
        $response->assertSee('Devchuli-17, Piprahar');
        $response->assertSee('King Size Room');
        $response->assertSee('Deluxe Room');
    }

    public function test_rooms_catalog_renders_and_filters_by_category(): void
    {
        $response = $this->get(route('rooms.index'));

        $response->assertSuccessful();
        $response->assertSee('Rooms &amp; Suites', false);
        $response->assertSee('NPR 2,500');

        $category = RoomCategory::first();
        $filteredResponse = $this->get(route('rooms.index', ['category' => $category->slug]));
        $filteredResponse->assertSuccessful();
        $filteredResponse->assertSee($category->name);
    }

    public function test_room_detail_page_renders_with_pricing_and_amenities(): void
    {
        $room = Room::first();

        $response = $this->get(route('rooms.show', $room->slug));

        $response->assertSuccessful();
        $response->assertSee($room->name);
        $response->assertSee(number_format($room->base_price));
        $response->assertSee('Reserve Directly');
    }

    public function test_guest_can_submit_booking_and_redirect_to_confirmation(): void
    {
        $room = Room::first();

        $checkIn = now()->addDays(2)->format('Y-m-d');
        $checkOut = now()->addDays(5)->format('Y-m-d');

        $response = $this->post(route('booking.submit'), [
            'room_id' => $room->id,
            'guest_name' => 'John Doe',
            'guest_email' => 'john@example.com',
            'guest_phone' => '+9779800000000',
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'adults' => 2,
            'children' => 0,
            'special_requests' => 'Late check-in please.',
        ]);

        $booking = Booking::where('guest_email', 'john@example.com')->first();
        $this->assertNotNull($booking);
        $this->assertStringStartsWith('SCTR-', $booking->booking_code);
        $this->assertEquals(3 * $room->base_price, $booking->total_amount);

        $response->assertRedirect(route('booking.confirmed', ['code' => $booking->booking_code]));

        $confirmResponse = $this->get(route('booking.confirmed', ['code' => $booking->booking_code]));
        $confirmResponse->assertSuccessful();
        $confirmResponse->assertSee($booking->booking_code);
        $confirmResponse->assertSee('WhatsApp');
    }

    public function test_activities_page_and_activity_detail_page_render(): void
    {
        $response = $this->get(route('activities.index'));
        $response->assertSuccessful();
        $response->assertSee('Safari &amp; Experiences', false);

        $activity = Activity::first();
        $detailResponse = $this->get(route('activities.show', $activity->slug));
        $detailResponse->assertSuccessful();
        $detailResponse->assertSee($activity->title);
    }

    public function test_gallery_page_renders_with_items(): void
    {
        $response = $this->get(route('gallery.index'));

        $response->assertSuccessful();
        $response->assertSee('Moments Captured');
    }

    public function test_contact_page_renders_and_guest_can_submit_inquiry(): void
    {
        $response = $this->get(route('contact'));

        $response->assertSuccessful();
        $response->assertSee('078-545455');
        $response->assertSee('info@chitwantigerresorts.com');

        $inquiryResponse = $this->post(route('inquiry.submit'), [
            'name' => 'Maya Sharma',
            'email' => 'maya@example.com',
            'phone' => '9841234567',
            'subject' => 'Corporate Seminar',
            'message' => 'We are interested in booking the seminar hall for 2 days.',
        ]);

        $inquiryResponse->assertRedirect();
        $this->assertDatabaseHas('inquiries', [
            'email' => 'maya@example.com',
            'subject' => 'Corporate Seminar',
        ]);
    }

    public function test_super_admin_can_access_filament_resort_resources(): void
    {
        $admin = User::where('email', 'admin@chitwantigerresorts.com')->first();

        // Ensure Shield super_admin has permissions or bypass
        $superAdminRole = Role::where('name', 'super_admin')->first();
        $admin->syncRoles([$superAdminRole]);

        $this->actingAs($admin)
            ->get(RoomResource::getUrl('index'))
            ->assertSuccessful();

        $this->actingAs($admin)
            ->get(RoomCategoryResource::getUrl('index'))
            ->assertSuccessful();

        $this->actingAs($admin)
            ->get(BookingResource::getUrl('index'))
            ->assertSuccessful();

        $this->actingAs($admin)
            ->get(ActivityResource::getUrl('index'))
            ->assertSuccessful();

        $this->actingAs($admin)
            ->get(GalleryResource::getUrl('index'))
            ->assertSuccessful();

        $this->actingAs($admin)
            ->get(InquiryResource::getUrl('index'))
            ->assertSuccessful();

        $this->actingAs($admin)
            ->get(TestimonialResource::getUrl('index'))
            ->assertSuccessful();
    }
}
