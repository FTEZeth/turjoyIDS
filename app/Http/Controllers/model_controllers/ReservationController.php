<?php

namespace App\Http\Controllers\model_controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\model_controllers\RouteController;
use App\Models\Route;
use Illuminate\Support\Str;
use Dompdf\Dompdf;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {




        if($this->verifyRequest($request)){return redirect('/');}

        //$uri = generatePDF();

        $reservation = Reservation::create([
            'code' => $this->generateReservationNumber(),
            'seat_amount' => $request->seats,
            'total' => $request->baseRate,
            'date' => $request->date,
            'route_id' => $request->routeId,
            //'pdf' => $uri,
            'payment_method' => $request->paymentMethod,
        ]);

        /*
        $messages = makeMessages();
        $this->validate($request, [
            'seat_amount' => ['required'],
            'total' => ['required'],
            'date' => ['required'],
            'route_id' => ['required'],
            'payment_method' => ['required'],
        ], $messages);
        */

        return redirect('/voucher')->with([
        'reservation' => $reservation,
        'origin' => $request->origins,
        'destination' => $request->destinations,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function showVoucher(Reservation $reservation){
        //dd(session('refreshed'));
        if(session('reservation') != null && session('origin') != null && session('destination') != null){
            //dd('entro al if');
            return view('client.order-success', [
                'reservation' => session('reservation'),
                'origin' => session('origin'),
                'destination' => session('destination'),
            ]);
        } else {
            return redirect('/');
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    public function generateReservationNumber()
    {

        do {
            $letters = randomString(4); // Genera 4 letras aleatorias
            $numbers = mt_rand(10, 99); // Genera 2 números aleatorios

            $code = $letters . $numbers;

            $response = Reservation::where('code', $code)->first();
        } while ($response);

        return $code;
    }

    public function searchReservation(Request $request)
    {
        $messages = makeMessages();

        // Validar que se proporciona un código de reserva
        $this->validate($request, [
            'code' => 'required'
        ], $messages);

        // Obtener el código de reserva de la solicitud
        $code = $request->code;

        // Buscar la reserva por código
        $reservation = Reservation::where('code', $code)->first();

        // Validar si la reserva no existe
        if (!$reservation) {
            // Almacenar el código en la sesión para que esté disponible en la vista
            session(['searchedCode' => $code]);
            // Retornar a la vista anterior
            return back();
        }

        $route = $reservation->route;

        // Reserva encontrada, retornar la vista con datos
        return view('client.order-success', [
            'reservation' => $reservation,
            'origin' => $route->origin,
            'destination' => $route->destination,
        ]);
    }

    //Agregar validaciones

    public function verifyRequest(Request $request){

        $routeTest = Route::where('origin', $request->origins)
        ->where('destination', $request->destinations)
        ->first();

        if($routeTest == null){return true;}

        $routeSeats = new RouteController();

        $seatTest = $routeSeats->seats($request->origins, $request->destinations, $request->date);
        $seatTest = $seatTest->getData();
        $seatTest = $seatTest->availableSeats;

        if($seatTest < $request->seats){return true;}

        $currentDate = date('Y-m-d');
        $currentDate = strtotime($currentDate);

        if($request->date < $currentDate){return true;}

        //if($request->baseRate != $routeTest->seat_quantity * )

    }

    public function generatePDF(){
        //logica que crea el pdf
        //return $uri;

    }
    public function paymentMethodSelection(Request $request)
    {
        $payment_method = $request->input('paymentMethod');

        // Perm any necessary logic based on the selected payment method
        return $payment_method;
        // Return a response or redirect to another page
    }
}
