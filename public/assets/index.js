
//Selectors
const selectOrigin = document.getElementById('origins');
const selectDestination = document.getElementById('destinations');
const selectDate = document.getElementById('date');
const selectSeats = document.getElementById('seats');
const createReservation = document.getElementById('createReservation');
const baseRate = document.getElementById('baseRate');
const routeId = document.getElementById('routeId');
const searchReservationForm = document.getElementById('searchReservationForm');


const clearSelectDestination = () => {
    while (selectDestination.firstChild) {
        selectDestination.removeChild(selectDestination.firstChild);
    }
    const option = document.createElement('option');
    option.value = ''; //value vacio
    option.text = 'Selecciona Destino';
    option.selected = true;
    selectDestination.appendChild(option);
}


const clearSelectSeats = () => {
    while (selectSeats.firstChild) {
        selectSeats.removeChild(selectSeats.firstChild);
    }
    const option = document.createElement('option');
    option.value = ''; //value vacio
    option.text = 'Seleccione Asientos';
    option.selected = true;
    selectSeats.appendChild(option);
}

const addDestinationsToSelect = (destinations) => {
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

const addSeatsToSelect = (seats) => {
    clearSelectSeats();
    if(seats === 0){

        Swal.fire({
            title: 'No hay servicios disponibles para la ruta seleccionada',
            icon: 'error',
            showCancelButton: true,
            cancelButtonColor: '#d33',
          }).then((result) => {
            if (result.isConfirmed) {
              // User clicked 'Yes', proceed with your action
            }
          })
    }

    for (let i = 1; i <= seats; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.text = i;
        selectSeats.appendChild(option);
    }
}


const loadedDestinations = (e) => {
    const currentValue = selectOrigin.value;
    if (currentValue) {
        fetch(`/get/destinations/${currentValue}`)
            .then(response=>response.json())
            .then(data=>{
                const destinations = data.destination;
                console.log(destinations);
                addDestinationsToSelect(destinations);
            })
            .catch(error=>{
                console.error('Hubo un error: ', error);
            })
    } else {
        clearSelectDestination();
        clearSelectSeats();
    }
}

const addOriginsToSelect = (origins) => {
    origins.forEach(origin => {
        const option = document.createElement('option');
        option.value = origin;
        option.text = origin;
        selectOrigin.appendChild(option);
    });
}


const loadedOrigins = (e) => {
    selectSeats.disabled = true;
    createReservation.disabled = true;
    fetch('/get/origins')
        .then(response=>response.json())
        .then(data=>{
            console.log(data);
            console.log('funciona');
            const origins = data.origins;
            addOriginsToSelect(origins);
        })
        .catch(error=>{
            console.error('Hubo un error: ', error);
        })
}


const loadedSeats = (origin, destination, date) => {
    if(origin && destination && date){
        fetch(`/get/route/${origin}/${destination}/${date}`)
            .then(response=>response.json())
            .then(data=>{
                console.log(data);
                console.log('funciona');
                const seats = data.availableSeats;
                baseRate.value = data.route.base_rate;
                routeId.value = data.route.id;
                console.log(baseRate.value);
                console.log(routeId.value);
                console.log(seats);

                addSeatsToSelect(seats);
            })
            .catch(error=>{
                console.error('Hubo un error: ', error);
            })
    } else {
        clearSelectSeats();
    }
}


const checkInputs = () => {
    const originValue = selectOrigin.value;
    const destinationValue = selectDestination.value;
    const dateValue = selectDate.value;
    const seatsValue = selectSeats.value;

    if (originValue !== '' && destinationValue !== '' && dateValue !== '' && seatsValue !== '')  {
        if(!checkDate()){
            Swal.fire({
                title: 'La fecha seleccionada no es válida',
                icon: 'error',
                showCancelButton: true,
                cancelButtonColor: '#d33',
              }).then((result) => {
                if (result.isConfirmed) {
                    selectSeats.disabled = true;
                    createReservation.disabled = true;
                    return;
                }
              })
        }
        createReservation.disabled = false;
        selectSeats.disabled = false;
        baseRate.value = seatsValue * baseRate.value;
        console.log(baseRate.value);
        console.log(routeId.value);
        console.log(dateValue);
        console.log(selectDate.value);

    } else if (originValue !== '' && destinationValue !== '' && dateValue !== '') {
        selectSeats.disabled = false;
        createReservation.disabled = true;
        loadedSeats(originValue, destinationValue, dateValue);
    } else {
        selectSeats.disabled = true;
        createReservation.disabled = true;
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
    console.log(dateValue);
    console.log(today);
    console.log(date);
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

