<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AbstractTest;

class BookingServiceTest extends AbstractTest
{
    use RefreshDatabase;

    /** @test */
    public function it_can_get_bookings_by_filter()
    {
        $booking1 = Booking::factory()->create(['user_id' => 1]);
        $booking2 = Booking::factory()->create();

        $bookingService = new BookingService();

        $bookings = $bookingService->getByFilter(['user_id' => 1]);
        $this->assertCount(1, $bookings);
        $this->assertEquals($booking1->id, $bookings[0]->id);

        $bookings = $bookingService->getByFilter([]);
        $this->assertCount(2, $bookings);
    }

    /** @test */
    public function it_can_get_booking_by_id()
    {
        $booking = Booking::factory()->create();
        $bookingService = new BookingService();

        $foundBooking = $bookingService->getById($booking->id);
        $this->assertEquals($booking->id, $foundBooking->id);
    }

    /** @test */
    public function it_can_store_new_booking()
    {
        $bookingData = [
            'user_id' => 1,
            'checkin_date' => '2023-12-20',
            'is_confirmed' => true
        ];
        $bookingService = new BookingService();

        $newBooking = $bookingService->store($bookingData);
        $this->assertDatabaseHas('bookings', $bookingData);
        $this->assertNotNull($newBooking->id);
    }

    /** @test */
    public function it_can_update_existing_booking()
    {
        $booking = Booking::factory()->create();
        $updatedData = [
            'checkin_date' => '2023-12-21',
        ];
        $bookingService = new BookingService();

        $updatedBooking = $bookingService->update($booking->id, $updatedData);
        $this->assertDatabaseHas('bookings', $updatedData);
        $this->assertEquals($updatedBooking->id, $booking->id);
    }

    /** @test */
    public function it_can_delete_booking()
    {
        $booking = Booking::factory()->create();
        $bookingService = new BookingService();

        $bookingService->destroy($booking->id);
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }

    /** @test */
    public function it_can_get_bookings_by_user_id()
    {
        $userBookings = Booking::factory()->count(3)->create(['user_id' => 1]);
        $otherBooking = Booking::factory()->create();

        $bookingService = new BookingService();
        $foundBookings = $bookingService->getByUserId(1);

        $this->assertCount(3, $foundBookings);
        $this->assertContainsOnlyInstancesOf(Booking::class, $foundBookings);
    }
}
