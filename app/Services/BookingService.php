<?php

namespace App\Services;

use App\Http\Filters\BookingFilter;
use App\Models\Booking;
use App\Services\Abstract\AbstractDataService;

class BookingService extends AbstractDataService
{

    public function __construct()
    {
        $this->model = new Booking();
    }
    public function getByFilter($query, int $limit = null, int $offset = null)
    {
        $filter = app()->make(BookingFilter::class, ["queryParams" => $query]);

        $bookings = $this->model->filter($filter);

        if ($limit !== null) {
            $bookings->limit($limit);
        }

        if ($offset !== null) {
            $bookings->offset($offset);
        }

        return $bookings->get();
    }

    public function getById(int $id)
    {
        return $this->model->find($id);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $this->getById($id)->update($data);
        return $this->getById($id);
    }

    public function destroy(int $id)
    {
        $this->getById($id)->delete();
    }

    public function getByUserId(int $user_id)
    {
        return $this->model->where("user_id", $user_id)->get();
    }
}
