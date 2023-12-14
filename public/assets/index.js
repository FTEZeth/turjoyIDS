
//Selectors
const selectOrigin = document.getElementById('origins');
const selectDestination = document.getElementById('destinations');
const selectDate = document.getElementById('date');
const selectSeats = document.getElementById('seats');
const createReservation = document.getElementById('createReservation');
const baseRate = document.getElementById('baseRate');
let baseRateAux = 0;
const routeId = document.getElementById('routeId');
const searchReservationForm = document.getElementById('searchReservationForm');


// Function to clear and reset the 'Destination' dropdown options.
const clearSelectDestination = () => {
    while (selectDestination.firstChild) {
        selectDestination.removeChild(selectDestination.firstChild);
    }
    const option = document.createElement('option');
    option.value = '';
    option.text = 'Seleccione Destino';
    option.selected = true;
    selectDestination.appendChild(option);
}


// Function to clear and reset the 'Seats' dropdown options.
const clearSelectSeats = () => {
    console.log('entra a clearSelectSeats');
    while (selectSeats.firstChild) {
        selectSeats.removeChild(selectSeats.firstChild);
    }
    const option = document.createElement('option');
    option.value = '';
    option.text = 'Seleccione Asientos';
    option.selected = true;
    selectSeats.appendChild(option);
}

// Function to add destination options to the dropdown based on fetched data.
const addDestinationsToSelect = (destinations) => {
    console.log('entra a addDestinationsToSelect');
    clearSelectSeats();
    clearSelectDestination();
    selectDestination.dispatchEvent(new Event('change'));
    selectSeats.dispatchEvent(new Event('change'));
    destinations.forEach(destination => {
        const option = document.createElement('option');
        option.value = destination;
        option.text = destination;
        selectDestination.appendChild(option);
    });
}

// Function to add seat options to the dropdown or show an error if no seats are available.
const addSeatsToSelect = (seats) => {
    console.log('entra a addSeatsToSelect');
    clearSelectSeats();
    console.log('hay asientos?');
    if (seats === 0) {
        console.log('no hay asientos');
        Swal.fire({
            title: 'No hay servicios disponibles para la ruta seleccionada, por favor seleccione otra fecha',
            icon: 'error',
            confirmButtonColor: '#ff8a80',
            showCancelButton: false,
        }).then((result) => {
            if (result.isConfirmed) {
                // User clicked 'Yes', proceed with your action
            }
        })
    } else {
        console.log('hay asientos');

        for (let i = 1; i <= seats; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.text = i;
            selectSeats.appendChild(option);
        }
    }
}


// Function to fetch and load destinations based on the selected origin.
const loadedDestinations = (e) => {
    console.log('entra a loadedDestinations');
    const currentValue = selectOrigin.value;
    if (currentValue) {
        fetch(`/get/destinations/${currentValue}`)
            .then(response => response.json())
            .then(data => {
                const destinations = data.destination;
                addDestinationsToSelect(destinations);
            })
            .catch(error => {
                console.error('Hubo un error: ', error);
            })
    } else {
        clearSelectDestination();
        clearSelectSeats();
    }
}

// Function to add origin options to the 'Origin' dropdown based on fetched data.
const addOriginsToSelect = (origins) => {
    console.log('entra a addOriginsToSelect');
    origins.forEach(origin => {
        const option = document.createElement('option');
        option.value = origin;
        option.text = origin;
        selectOrigin.appendChild(option);
    });
}

// Function to fetch and load origins when the page is loaded.
const loadedOrigins = (e) => {
    console.log('entra a loadedOrigins');
    selectSeats.disabled = true;
    createReservation.disabled = true;
    fetch('/get/origins')
        .then(response=>response.json())
        .then(data=>{
            const origins = data.origins;
            addOriginsToSelect(origins);
        })
        .catch(error=>{
            console.error('Hubo un error: ', error);
        })
}

// Function to fetch and load available seats and update form state based on selected origin, destination, and date.
const loadedSeats = (origin, destination, date) => {
    console.log('entra a loadedSeats');
    console.log('origen: ', origin, 'destino', destination, 'fecha', date);
    if(origin && destination && date){
        console.log('entra a if de loadedSeats');
        fetch(`/get/route/${origin}/${destination}/${date}`)
            .then(response=>response.json())
            .then(data=>{
                console.log('entra a fetch');
                console.log(data);
                baseRateAux = 0;
                const seats = data.availableSeats;
                baseRateAux = data.route.base_rate;
                routeId.value = data.route.id;
                console.log('baseRateAux: ', baseRateAux);

                addSeatsToSelect(seats);
            })
            .catch(error=>{
                console.error('Hubo un error: ', error);
            })
    } else {
        console.log('entra a else de loadedSeats');
        clearSelectSeats();
    }
}


const checkInputs = (event) => {

    console.log('Triggered by:', event.target.id);
    console.log('entra a checkInputs');

    const originValue = selectOrigin.value;
    const destinationValue = selectDestination.value;
    const dateValue = selectDate.value;
    const seatsValue = selectSeats.value;

    console.log('Esta seleccionado or, dest, fecha y seats?');
    if (originValue !== '' && destinationValue !== '' && dateValue !== '' && seatsValue !== '')  {
        console.log('Si');
        console.log('es la fecha valida?')
        if(!checkDate()){
            console.log('No');
            Swal.fire({
                title: 'La fecha seleccionada no es válida',
                icon: 'error',
                showCancelButton: true,
                cancelButtontext: 'Volver',
                cancelButtonColor: '#ff8a80',
                showconfirmButton: false,
              }).then((result) => {
                if (result.isConfirmed) {
                    selectSeats.disabled = true;
                    createReservation.disabled = true;
                    return;
                }
              })
        }
        if(event.target.id === 'destinations'){
            loadedSeats(originValue, destinationValue, dateValue);
            selectSeats.disabled = false;
            return;
        }
        console.log('Si');
        console.log('cambio precio');
        createReservation.disabled = false;
        selectSeats.disabled = false;
        console.log('baseRateAux:', baseRateAux)
        baseRate.value = seatsValue * baseRateAux;

    } else if (originValue !== '' && destinationValue !== '' && dateValue !== '') {
        console.log('Solo falta seleccionar asientos');
        console.log('habilito asientos y reseteo baseRate')
        selectSeats.disabled = false;
        createReservation.disabled = true;
        baseRate.value = 0;
        loadedSeats(originValue, destinationValue, dateValue);
    } else {
        console.log('No');
        console.log('deshabilito asientos y reseteo baseRate');
        baseRate.value = '0';
        selectSeats.disabled = true;
        createReservation.disabled = true;
        baseRate.value = 0;
    }
}

const getBaseRate = () => {
    baseRate = selectSeats.value

}

const checkDate = () => {
    const dateValue = selectDate.value;
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const date = new Date(dateValue);
    date.setDate(date.getDate() + 1);
    date.setHours(0, 0, 0, 0);
    if(date.getTime() >= today.getTime()){
        return true;
    } else {
        selectDate.value = '';
        return false;
    }
}

const showSearchError = () => {
    // Nuevo bloque para mostrar el mensaje de error con animación grande
    Swal.fire({

        title: 'Error',
        text: 'Por favor ingrese un código de reserva',
        icon: 'error',
        confirmButtonText: 'OK',
        confirmButtonColor: '#0A74DA', // Color del botón OK
        customClass: {
            popup: 'animated tada' // Clase de animación de SweetAlert2
        }
    }).then((result) => {
        // ... Puedes agregar lógica adicional si es necesario
        if (result.isConfirmed) {
            // Acción si se hace clic en OK
        } else if (result.isDismissed) {
            // Acción si se hace clic en Cancelar o se cierra el cuadro de diálogo
        }
    });
}



document.addEventListener('DOMContentLoaded', loadedOrigins);
selectOrigin.addEventListener('change', loadedDestinations);

selectOrigin.addEventListener('change', checkInputs);
selectDestination.addEventListener('change', checkInputs);
selectDate.addEventListener('change', checkInputs);
selectSeats.addEventListener('change', checkInputs);

searchReservationForm.addEventListener('submit', (event) => {
    const codeValue = document.getElementsByName('code')[0].value;
    if (!codeValue) {
        event.preventDefault(); // Evitar que el formulario se envíe
        showSearchError();
    }
});

