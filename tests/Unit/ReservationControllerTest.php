<?php

namespace Tests\Unit;

use App\Models\Reservation;
use App\Models\Route;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Http\Controllers\model_controllers\ReservationController;

class ReservationControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testSearchReservationWithValidCode(){
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

        $response->assertViewHas('reservation', $reservation);
        $response->assertViewHas('origin', $route->origin);
        $response->assertViewHas('destination', $route->destination);

        // Assert that the response has the correct status code and view
        $response->assertStatus(302);
        $response->assertRedirect();
        $response->assertViewIs('client.order-success');

        // Assert that the response view has the correct data
        $response->assertViewHas('reservation', $reservation);
        $response->assertViewHas('origin', $route->origin);
        $response->assertViewHas('destination', $route->destination);
    }

    public function testSearchReservationWithInvalidCode(){
        // Call the searchReservation method with an invalid code
        $response = $this->get('/get/reservation-by-code', [
            'code' => 'AAAAAAA00000',
        ]);

        // Assert that the response has the correct status code and view
        $response->assertStatus(302);
        $response->assertRedirect('/');

    }

    public function testGenerateReservationNumber(){
        //Create a reservation
        $reservation = Reservation::create([
            'code' => 'AAAA00',
            'seat_amount' => 6,
            'total' => 500,
            'date' => '2023-11-16',
            'route_id' => 1,
        ]);

        //Create a new ReservationController instance
        $reservationControler = new ReservationController();

        //Call the generateReservationNumber method
        $newCode = $reservationControler->generateReservationNumber();

        //Assert that the new code is not equal to the existing reservation code
        $this->assertNotEquals($newCode, $reservation->code);

        //Assert that the new code has the correct format
        $this->assertMatchesRegularExpression('/^[A-Z]{4}[0-9]{2}$/', $newCode);

        //Assert that the new code is unique
        $this->assertNull(Reservation::where('code', $newCode)->first());




    }
}
