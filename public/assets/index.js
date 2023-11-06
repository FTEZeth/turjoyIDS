
//Selectors
const selectOrigin = document.getElementById('origins');
const selectDestination = document.getElementById('destinations');

const clearSelect = () => {
    while (selectDestination.firstChild) {
        selectDestination.removeChild(selectDestination.firstChild);
    }
}

const addDestinationsToSelect = (destinations) => {
    clearSelect();
    const option = document.createElement('option');
    option.value = ''; //value vacio
    option.text = 'Selecciona un destino';
    option.selected = true;
    selectDestination.appendChild(option);
    destinations.forEach(destination => {
        const option = document.createElement('option');
        option.value = destination;
        option.text = destination;
        selectDestination.appendChild(option);
    });
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

document.addEventListener('DOMContentLoaded', loadedOrigins);
selectOrigin.addEventListener('change', loadedDestinations);
//selectDestination.addEventListener('change', verifySeating);

