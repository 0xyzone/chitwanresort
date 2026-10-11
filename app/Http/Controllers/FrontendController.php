<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Inquiry;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Testimonial;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home(): View
    {
        $rooms = Room::with('category')->active()->take(3)->get();
        $activities = Activity::active()->take(4)->get();
        $testimonials = Testimonial::published()->take(4)->get();
        $galleryItems = Gallery::published()->take(6)->get();
        $categories = RoomCategory::active()->get();

        return view('frontend.home', compact('rooms', 'activities', 'testimonials', 'galleryItems', 'categories'));
    }

    public function rooms(Request $request): View
    {
        $categorySlug = $request->query('category');
        $query = Room::with('category')->active();

        if ($categorySlug) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $categorySlug));
        }

        $rooms = $query->get();
        $categories = RoomCategory::active()->withCount('rooms')->get();

        return view('frontend.rooms', compact('rooms', 'categories', 'categorySlug'));
    }

    public function roomDetail(string $slug): View
    {
        $room = Room::with('category')->where('slug', $slug)->firstOrFail();
        $relatedRooms = Room::with('category')
            ->active()
            ->where('id', '!=', $room->id)
            ->take(2)
            ->get();

        return view('frontend.room-detail', compact('room', 'relatedRooms'));
    }

    public function activities(): View
    {
        $activities = Activity::active()->get();

        return view('frontend.activities', compact('activities'));
    }

    public function activityDetail(string $slug): View
    {
        $activity = Activity::where('slug', $slug)->firstOrFail();
        $otherActivities = Activity::active()->where('id', '!=', $activity->id)->take(3)->get();

        return view('frontend.activity-detail', compact('activity', 'otherActivities'));
    }

    public function gallery(Request $request): View
    {
        $category = $request->query('category');
        $query = Gallery::published();

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $items = $query->get();

        return view('frontend.gallery', compact('items', 'category'));
    }

    public function contact(): View
    {
        return view('frontend.contact');
    }

    public function submitInquiry(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:3000',
        ]);

        $inquiry = Inquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'subject' => $validated['subject'] ?? 'Website Inquiry',
            'message' => $validated['message'],
            'status' => 'unread',
        ]);

        return back()->with('success', 'Thank you! Your inquiry has been sent to our resort team. We will contact you shortly.');
    }

    public function submitBooking(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'required|email|max:255',
            'guest_phone' => 'required|string|max:30',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'adults' => 'required|integer|min:1|max:10',
            'children' => 'nullable|integer|min:0|max:10',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        $room = Room::findOrFail($validated['room_id']);
        $cIn = Carbon::parse($validated['check_in_date']);
        $cOut = Carbon::parse($validated['check_out_date']);
        $nights = max(1, $cIn->diffInDays($cOut));
        $totalAmount = (float) $room->base_price * $nights;

        $booking = Booking::create([
            'room_id' => $room->id,
            'guest_name' => $validated['guest_name'],
            'guest_email' => $validated['guest_email'],
            'guest_phone' => $validated['guest_phone'],
            'check_in_date' => $cIn->format('Y-m-d'),
            'check_out_date' => $cOut->format('Y-m-d'),
            'adults' => (int) $validated['adults'],
            'children' => (int) ($validated['children'] ?? 0),
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'special_requests' => $validated['special_requests'] ?? null,
        ]);

        return redirect()->route('booking.confirmed', ['code' => $booking->booking_code])
            ->with('booking_success', true);
    }

    public function bookingConfirmed(string $code): View
    {
        $booking = Booking::with('room.category')->where('booking_code', $code)->firstOrFail();

        return view('frontend.booking-confirmed', compact('booking'));
    }
}
