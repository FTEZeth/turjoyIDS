namespace Tests\Unit;

use App\Models\Route;
use App\Models\Reservation;
use Tests\TestCase;

class RouteControllerTest extends TestCase
{
    public function test_it_returns_available_seats_and_route_for_given_origin_destination_and_date()
    {
        // Create a route
        $route = Route::factory()->create([
            'origin' => 'New York',
            'destination' => 'Los Angeles',
            'seat_quantity' => 50,
        ]);

        // Create a reservation for the route on the given date
        $date = '2022-01-01';
        $seatAmount = 10;
        Reservation::factory()->create([
            'route_id' => $route->id,
            'date' => $date,
            'seat_amount' => $seatAmount,
        ]);

        // Call the seats method with the given parameters
        $response = $this->get("/seats/{$route->origin}/{$route->destination}/{$date}");

        // Assert that the response has the correct structure and values
        $response->assertJson([
            'availableSeats' => 40,
            'route' => [
                'id' => $route->id,
                'origin' => $route->origin,
                'destination' => $route->destination,
                'seat_quantity' => $route->seat_quantity,
            ],
        ]);
    }
}
