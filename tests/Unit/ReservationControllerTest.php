<?php

namespace Tests\Unit;

use App\Models\Reservation;
use App\Models\Route;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ReservationControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testSearchReservationWithValidCode()
    {
        $route = Route::create([
            'origin' => 'AAAAA',
            'destination' => 'BBBBB',
            'seat_quantity' => 10,
            'base_rate' => 100,
        ]);

        // Create a reservation
        $date = '2023-11-16';
        $seatAmount = 6;
        $total = 500;
        $code = "AAAA00";

        $reservation = Reservation::create([
            'code' => $code,
            'seat_amount' => $seatAmount,
            'total' => $total,
            'date' => $date,
            'route_id' => $route->id,
        ]);

        // Call the searchReservation method with the reservation's code
        $response = $this->get('/get/reservation-by-code', [
            'code' => $reservation->code,
        ]);

        // Assert that the response has the correct status code and view
        $response->assertStatus(200);
        $response->assertViewIs('client.order-success');

        // Assert that the response view has the correct data
        $response->assertViewHas('reservation', $reservation);
        $response->assertViewHas('origin', $route->origin);
        $response->assertViewHas('destination', $route->destination);
    }

    public function testSearchReservationWithInvalidCode()
    {
        // Call the searchReservation method with an invalid code
        $response = $this->get('/get/reservation-by-code', [
            'code' => 'AAAAAAA00000',
        ]);

        // Assert that the response has the correct status code and view
        $response->assertStatus(302);
        $response->assertRedirect('/');

    }
}
