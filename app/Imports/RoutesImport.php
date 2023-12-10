<?php

namespace App\Imports;

use App\Models\Route;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RoutesImport implements ToCollection, WithHeadingRow {

    protected $validRows = [];
    protected $invalidRows = [];
    protected $duplicatedRows = [];
    protected $existingOriginsDestinations = [];


    public function collection(Collection $rows) {

        foreach ($rows as $row) {
            //verificar los nombres de las columnas

            try{
                $origin = $row['origen'];
                $destination = $row['destino'];
                $tarifaBase = $row['tarifa_base'];
                $cantidadDeAsientos = $row['cantidad_de_asientos'];
            }
            catch (\Exception $e){

                return back()->with('error', 'El archivo excel no tiene el formato correcto.');
            }

            if ($this->hasDuplicateOriginDestination($origin, $destination)) {
                $this->duplicatedRows[] = $row;
            } else {
                //validar campos
                if ($this->validateFields($row)) {
                    $tarifaBase = $row['tarifa_base'];

                    // Eliminar caracteres del entero
                    $tarifaBase = str_replace(['$', ',', '.'], '', $tarifaBase);

                    // Convertir a entero
                    $tarifaBase = (int)$tarifaBase;

                    // Asignar el valor limpio de tarifa base de nuevo a la fila
                    $row['tarifa_base'] = $tarifaBase;

                    $this->validRows[] = $row;
                    //registra la combinación de origen y destino
                    $this->existingOriginsDestinations[] = $origin . '-' . $destination;
                } else {
                    $this->invalidRows[] = $row;
                }
            }
        }
    }

    private function hasDuplicateOriginDestination($origin, $destination) {

        $key = $origin . '-' . $destination;
        return in_array($key, $this->existingOriginsDestinations);
    }

    public function getValidRows() {

        return $this->validRows;
    }

    public function getInvalidRows() {

        return $this->invalidRows;
    }

    public function getDuplicatedRows() {

        return $this->duplicatedRows;
    }


    public function model(array $row){

        return new Route([
            //
        ]);
    }

    public function validateFields($row){
        $origin = '';
        $destination = '';

        //validar campo de origen
        if(isset($row['origen'])){
            $origin = $row['origen'];
            if(!preg_match('/^[\p{L}\',.\s]{1,250}$/u',$origin)){
                return false;
            }

        } else {
            return false;
        }

        //validar campo de destino
        if(isset($row['destino'])){
            $destination = $row['destino'];
            if(!preg_match('/^[\p{L}\',.\s]{1,250}$/u',$destination)){
                return false;
            }
        } else {
            return false;
        }

        if($origin == $destination){
            return false;
        }

        //validar campo de tarifa base
        if (isset($row['tarifa_base'])) {
            $tarifaBase = $row['tarifa_base'];

            // Eliminar caracteres del entero
            $tarifaBase = str_replace(['$', ',', '.'], '', $tarifaBase);

            // Validar que sea un entero
            if(!is_numeric($tarifaBase)){
                return false;
            }
            // Convertir a entero
            $tarifaBase = (int)$tarifaBase;

            if($tarifaBase <= 0){
                return false;
            }

        } else {
            return false;
        }

        //validar campo de cantidad de asientos
        if (isset($row['cantidad_de_asientos'])) {
            $cantidadDeAsientos = $row['cantidad_de_asientos'];
            // Validar que sea un entero
            if(!is_numeric($cantidadDeAsientos)){
                return false;
            }
            // Convertir a entero
            $cantidadDeAsientos = (int)$cantidadDeAsientos;

            if($cantidadDeAsientos <= 0){
                return false;
            }

        } else {
            return false;
        }

        return true;

    }

}
