@extends('layouts.app')

@section('content')

    <h1>Order Success</h1>
    <p>Thank you for your order!</p>

    <h2>Order Details</h2>
    <p>Reservation Code: {{ $reservation->code }}</p>
    <p>Seat Amount: {{ $reservation->seat_amount }}</p>
    <p>Total: {{ $reservation->total }}</p>
    <p>Date: {{ $reservation->date }}</p>
    <p>Route ID: {{ $reservation->route_id }}</p>
@endsection
