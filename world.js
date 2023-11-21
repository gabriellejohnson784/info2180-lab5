const lookupButton = document.getElementById("lookup");
const lookupCitiesButton = document.getElementById("lookupCities");
const countryInput = document.getElementById("country");
const resultElement = document.getElementById("result");

lookupButton.addEventListener("click", function (event) {
    event.preventDefault();

    const country = countryInput.value.trim().replace(/(<([^>]+)>)/gi, "");

    if (country !== "") {
        CountryData(country);
    }
});

lookupCitiesButton.addEventListener("click", function (event) {
    event.preventDefault();

    const country = countryInput.value.trim().replace(/(<([^>]+)>)/gi, "");

    if (country !== "") {
        CitiesData(country);
    }
});

function CountryData(country) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                resultElement.innerHTML = xhr.responseText;
            } else {
                console.error('Error fetching data:', xhr.statusText);
                resultElement.innerHTML = 'Error fetching data.';
            }
        }
    };

    xhr.open("GET", `world.php?country=${country}`, true);
    xhr.send();
}

function CitiesData(country) {
    const xhrCities = new XMLHttpRequest();
    xhrCities.onreadystatechange = function () {
        if (xhrCities.readyState === 4) {
            if (xhrCities.status === 200) {
                resultElement.innerHTML = xhrCities.responseText;
            } else {
                console.error('Error fetching data:', xhrCities.statusText);
                resultElement.innerHTML = 'Error fetching data.';
            }
        }
    };

    xhrCities.open("GET", `world.php?country=${country}&lookup=cities`, true);
    xhrCities.send();
}
