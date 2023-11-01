
@extends('layouts.app')
@section('content')
<div class="bg-white py-20 text-center", style="background-color: #FFFFFF">
    <h2 class="text-blue-500 text-4xl" style="color: #0A74DA">Reserva tu pasaje ahora!</h2>
    <div class="flex justify-center mt-8 space-x-4">
        <input type="text" placeholder="Fecha de viaje" class="border border-gray-400 p-2">
        <input type="text" placeholder="Origen" class="border border-gray-400 p-2">
        <input type="text" placeholder="Destino" class="border border-gray-400 p-2">
        <input type="text" placeholder="Cantidad de asientos" class="border border-gray-400 p-2">
        <button class="bg-orange-500 text-white px-4 py-2 rounded">Buscar</button>
    </div>
</div>


<div class="bg-white py-20 text-center", style="background-color: #EAEAEA">
    <h2 class="text-blue-500 text-4xl" style="color: #0A74DA">¿Hiciste una reserva?</h2>
    <div class="flex justify-center mt-8 space-x-4">
        <input type="text" placeholder="ej. ABCD01" class="border border-gray-400 p-2">
        <button class="bg-orange-500 text-white px-4 py-2 rounded" style="background-color: #FF6B6B  ">Botón</button>
    </div>
</div>
@endsection

