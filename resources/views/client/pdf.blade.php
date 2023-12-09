<!DOCTYPE html>
<html lang="en">

<head>
    <title>Comprobante de Reserva</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaeaea;
        }

        .container {
            margin: auto;
            padding: 20px;
            width: 50%;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #0a74da;
            color: #fff;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        th {
            text-align: left;
            font-weight: bold;
            background-color: #fff;
        }

        td {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <p>Tu reserva ha sido realizada con éxito</p>
            </div>

            <div class="content">
                <table>
                    <tbody>
                        <tr>
                            <th scope="row">Código de reserva</th>
                            <td>{{ $reservation->code }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Ciudad de origen</th>
                            <td>{{ $reservation->route->origin }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Ciudad de destino</th>
                            <td>{{ $reservation->route->destination }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Día de la reserva</th>
                            <td>{{ date('d/m/Y', strtotime($reservation->date)) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Cantidad de asientos</th>
                            <td>{{ $reservation->seat_amount }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Fecha de la compra</th>
                            <td>{{ date('d/m/Y h:i:s A', strtotime($reservation->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Total pagado</th>
                            <td>${{ number_format((int)$reservation->total, 0, ',', '.') }} CLP</td>
                        </tr>
                        <tr>
                            <th scope="row">Medio de pago</th>
                            <td>{{ $reservation->payment_method }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
