<?php

namespace App\Http\Controllers\model_controllers;

use App\Imports\RoutesImport;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexAddRoutes() {

        //si las variables ya existen, las actualizo
        if (session('validRows') || session('invalidRows') || session('duplicatedRows')) {
            session()->put('validRows', []);
            session()->put('invalidRows', []);
            session()->put('duplicatedRows', []);
        } else {
            //si no existen, las creo
            session(['validRows' => []]);
            session(['invalidRows' => []]);
            session(['duplicatedRows' => []]);
        }

        return view('admin_routes.index', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows')
        ]);

    }

    public function routeCheck(Request $request) {

        $messages = makeMessages();

        //validar características del archivo a subir
        $this->validate($request, [
            'document' => ['required','mimes:xlsx' ,'min:6', 'max:5120'],
        ], $messages);

        //validar el archivo una vez subido
        if( $request->hasFile('document')) {
            $file = request()->file('document'); //la key 'document' debe ser el mismo nombre que en el frontend (min 20:30 RES001)

            $import = new RoutesImport();
            Excel::import($import, $file);

            //obtener filas válidas e inválidas
            $validRows = $import->getValidRows();
            $invalidRows = $import->getInvalidRows();
            $duplicatedRows = $import->getDuplicatedRows();

            //agregar o reemplazad filaz validas en la bdd
            foreach ($validRows as $row) {

                $origin = $row['origen'];
                $destination = $row['destino'];

                $route = Route::where('origin', $origin) //si el origen es igual al que se entregó por excel
                    ->where('destination', $destination) //si el destino es igual al que se entregó por excel
                    ->first();


                if(isset($route)) {
                    $route->update([
                        'seat_count' => $row['cantidad_de_asientos'],
                        'base_rate' => $row['tarifa_base'],
                    ]);
                } else {
                    Route::create ([
                        'origin' => $origin,
                        'destination' => $destination,
                        'seat_count' => $row['cantidad_de_asientos'],
                        'base_rate' => $row['tarifa_base'],
                    ]);
                }
            }

            $invalidRows = array_filter($invalidRows, function ($invalidrow) {
                return $invalidrow['origen'] !== null || $invalidrow['destino'] !== null || $invalidrow['cantidad_de_asientos'] !== null || $invalidrow['tarifa_base'] !== null;
            });
        }
        session()->put('validRows', $validRows);
        session()->put('invalidRows', $invalidRows);
        session()->put('duplicatedRows', $duplicatedRows);

        return redirect()->route('routesAdd.index');
    }

    public function indexRoutes(request $request){

        return view('admin_routes.index', [
            'validRows' => session('validRows'),
            'invalidRows' => session('invalidRows'),
            'duplicatedRows' => session('duplicatedRows')
        ]);

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }

    public function index()
    {
        $this->indexAddRoutes();

    }
}
