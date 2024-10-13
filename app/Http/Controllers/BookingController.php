<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\IndexBookingRequest;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Http\Requests\Booking\UpdateBookingRequest;
use App\Services\BookingService;
use App\Services\UserService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private $bookingService;
    private $userService;

    public function __construct(BookingService $bookingService, UserService $userService)
    {
        $this->bookingService = $bookingService;
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexBookingRequest $request)
    {
        $bookings = $this->bookingService->getByFilter(
            $request->validated(),
            $request->query('limit'),
            $request->query('offset')
        );

        return response()->json($bookings);
    }

    /**
     * @param  \App\Http\Requests\Booking\StoreBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {
        $booking = $this->bookingService->store($request->validated());

        return response()->json($booking, 201);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $booking = $this->bookingService->getById($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking);
    }

    /**
     * @param  \App\Http\Requests\Booking\UpdateBookingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, int $id)
    {
        $booking = $this->bookingService->getById($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $booking = $this->bookingService->update($id, $request->validated());

        return response()->json($booking);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $booking = $this->bookingService->getById($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        $this->bookingService->destroy($id);

        return response()->json(null, 204);
    }


    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userBookings(int $user_id)
    {
        $isUserExits = $this->userService->isExist($user_id);

        if (!$isUserExits) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $bookings = $this->bookingService->getByUserId($user_id);

        return response()->json($bookings);
    }
}
