<?php

namespace App\Imports;

use App\Models\Route;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RoutesImport implements ToCollection, WithHeadingRow {

    protected $validRows = [];
    protected $invalidRows = [];
    protected $duplicatedRows = [];
    protected $existingOriginsDestinations = [];


    public function collection(Collection $rows) {
        foreach ($rows as $row) {

            //importante que tengan el mismo nombre que en el archivo 'origen' y 'destino'
            $origin = $row['origen'];
            $destination = $row['destino'];

            if ($this->hasDuplicateOriginDestination($origin, $destination)) {

                $this->duplicatedRows[] = $row;
            } else {
                //limpiar campo de tarifa base
                if (isset($row['tarifa_base'])) {
                    $tarifaBase = $row['tarifa_base'];

                    // Utilizar una expresión regular para eliminar todos los caracteres que no sean dígitos
                    $tarifaBase = str_replace(['$', ',', '.'], '', $tarifaBase);

                    // Convertir la cadena resultante a un número entero
                    try {

                        $tarifaBase = (int)$tarifaBase;

                    } catch (Exception $e) {
                        $this->invalidRows[] = $row;
                        continue;
                    }

                    // Asignar el valor limpio de tarifa base de nuevo a la fila
                    $row['tarifa_base'] = $tarifaBase;
                }
                //validar nombres de campos y que sean numéricos y requeridos
                if (isset($row['origen']) && isset($row['destino']) && isset($row['cantidad_de_asientos']) && isset ($row['tarifa_base']) && is_numeric($row['cantidad_de_asientos']) && is_numeric($row['tarifa_base'])) {
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


    public function model(array $row)
    {
        return new Route([
            //
        ]);
    }
}
