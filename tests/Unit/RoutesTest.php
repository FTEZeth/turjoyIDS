<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Route;
use App\Models\Reservation;
use Tests\TestCase;

class RouteControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testAvailableSeatsRoute(){
        // Create a route
        $route = Route::create([
            'origin' => 'AAAAA',
            'destination' => 'BBBBB',
            'seat_quantity' => 10,
            'base_rate' => 100,
        ]);

        // Create a reservation for the route on the given date
        $date = '2023-11-16';
        $seatAmount = 6;
        $total = 500;
        $code = "AAAA00";

        Reservation::create([
            'code' => $code,
            'seat_amount' => $seatAmount,
            'total' => $total,
            'date' => $date,
            'route_id' => $route->id,
        ]);

        // Call the seats method with the given parameters
        $response = $this->get("/get/route/{$route->origin}/{$route->destination}/{$date}");

        // Assert that the response has the correct structure and values
        $response->assertJson([
            'availableSeats' => 4,
            'route' => [
                'id' => $route->id,
                'origin' => $route->origin,
                'destination' => $route->destination,
                'seat_quantity' => $route->seat_quantity,
                'base_rate' => $route->base_rate,
            ],
        ]);

    }

    public function testStoreMethod(){
        //Create route
        $route = Route::create([
            'origin' => 'AAAAA',
            'destination' => 'BBBBB',
            'seat_quantity' => 10,
            'base_rate' => 100,
        ]);

        //Create a request with the necessary parameters
        $data = [
            'seats' => 2,
            'baseRate' => 200,
            'date' => '2023-11-16',
            'routeId' => $route->id,
            'origins' => $route->origin,
            'destinations' => $route->destination,
        ];

        //Call the store method with the request
        $response = $this->post('/reservation', $data);

        //Assert that the response has the correct view and data
        $response->assertViewIs('client.order-success');
        $response->assertViewHas('reservation');
        $response->assertViewHas('origin', $route->origin);
        $response->assertViewHas('destination', $route->destination);

        //Assert that the reservation was created with the correct data
        $this->assertDatabaseHas('reservations', [
            'seat_amount' => $data['seats'],
            'total' => $data['seats'] * $data['baseRate'],
            'date' => $data['date'],
            'route_id' => $data['routeId'],
        ]);










    }
}
