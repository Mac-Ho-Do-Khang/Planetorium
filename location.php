<?php
session_start();
include("database.php");
$isLoggedIn = isset($_SESSION['user']);
$current_user = isset($_SESSION['user']) ? $_SESSION['user'] : "guest";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planetorium - Locations</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="css/map_style.css" />
    <link rel="stylesheet" href="css/queries.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="icon" href="content/img/fevv.png" />
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet" />
    <script
        type="module"
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script
        nomodule
        src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        #map {
            width: 100%;
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="index.php?page=home"><img src="content/img/app/logobc.png" class="logo" /></a>
        <nav class="header-nav">
            <ul class="header-nav-list">
                <li><a class="header-nav-link" href="index.php?page=home">Home</a></li>
                <div class="dropdown">
                    <li><a class="header-nav-link" href="index.php?page=products">Products &#9660;</a></li>
                    <div class="dropdown-content">
                        <a href="index.php?page=products">Earth-like</a>
                        <a href="index.php?page=products">Watery</a>
                        <a href="index.php?page=products">Ring</a>
                    </div>
                </div>
                <li><a class="header-nav-link" href="index.php?page=contacts">Contacts</a></li>

                <!-- Check if user is logged in -->
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="user-info">
                        <ion-icon class="user-icon" name="person-circle"></ion-icon>
                        <div class="info">
                            <p><?php echo $_SESSION['user']; ?></p>
                            <p><?php echo "(" . $_SESSION['name'] . ")"; ?></p>
                            <!-- Log out button -->
                            <form action="logout.php" method="post" style="display: inline;">
                                <input type="submit" value="Log out" class="logout-btn" />
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    echo "AAAAAAAAAAA";
                                    session_unset();
                                    session_destroy();
                                    header('Location: index.php?page=login');
                                    exit();
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Show login and register links if not logged in -->
                    <li><a class="header-nav-link" href="index.php?page=login">Login</a></li>
                    <li>
                        <a href="index.php?page=register" class="header-nav-link call-to-action">Sign up</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <button class="mobile-btn">
            <ion-icon class="mobile-icon" name="menu"></ion-icon>
            <ion-icon class="mobile-icon" name="close"></ion-icon>
        </button>
    </header>

    <section class="call-to-action" id="register">
        <div class="container">
            <div class="cta grid-container" style="--column: 2">
                <div class="cta-box">
                    <h2 class="subheading">Where you are, where we are</h2>
                    <p class="cta-text">
                        Explore the universe your way: Select a location, choose a campus, or pin your coordinates!
                    </p>
                    <form class="cta-form" name="form">
                        <div class="grid-container" style="--column: 2; --c-gap: 3.2rem; --r-gap: 2.4rem">
                            <div>
                                <label for="campus">Campuses</label>
                                <select id="campus" name="campus" onchange="fetchStates()">
                                    <option value="">---Campuses---</option>
                                </select>
                            </div>
                            <div class="seperator">
                                <label>------------------------------------------------------------------------</label>
                            </div>
                            <div>
                                <label for="country">Country</label>
                                <select id="country" name="country" onchange="fetchStates()">
                                    <option value="">---Country---</option>
                                </select>
                            </div>
                            <div>
                                <label for="state">State:</label>
                                <select id="state" name="state" onchange="fetchCities()">
                                    <option value="">---State---</option>
                                </select>
                            </div>
                            <div>
                                <label for="city">City:</label>
                                <select id="city" name="city" onchange="showMap()">
                                    <option value="">---City---</option>
                                </select>
                            </div>
                            <div><label for="zoom">Zoom Level:</label>

                                <input type="number" id="zoom" name="zoom" min="1" max="19" value="10" />

                            </div>
                            <div class="seperator">
                                <label>------------------------------------------------------------------------</label>
                            </div>
                            <div>
                                <label for="latitude">Latitude:</label>
                                <input type="text" id="latitude" name="latitude" placeholder="Enter Latitude" />
                            </div>
                            <div>
                                <label for="longitude">Longitude:</label>
                                <input type="text" id="longitude" name="longitude" placeholder="Enter Longitude" />
                            </div>
                            <button class="btn btn-full" type="button" onclick="showMap()">Show Map</button>
                        </div>
                    </form>
                </div>
                <div id="map"></div>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- <script>
        const geonamesUsername = "xitrumbumbum"; // Replace with your free GeoNames username

        let mapInitialized = false; // Flag to check if the map has been initialized

        async function fetchCountries() {
            try {
                const response = await fetch(`http://api.geonames.org/countryInfoJSON?username=${geonamesUsername}`);
                const data = await response.json();
                const countrySelect = document.getElementById("country");
                countrySelect.innerHTML = '<option value="">---Country---</option>';
                data.geonames.forEach(country => {
                    countrySelect.innerHTML += `<option value="${country.geonameId}">${country.countryName}</option>`;
                });
            } catch (error) {
                console.error("Error fetching countries:", error);
            }
        }

        async function fetchStates() {
            const countryId = document.getElementById("country").value;
            const stateSelect = document.getElementById("state");
            const citySelect = document.getElementById("city");
            stateSelect.innerHTML = '<option value="">---State---</option>';
            citySelect.innerHTML = '<option value="">---City---</option>';
            if (!countryId) return;

            try {
                const response = await fetch(`http://api.geonames.org/childrenJSON?geonameId=${countryId}&username=${geonamesUsername}`);
                const data = await response.json();
                data.geonames.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.geonameId}">${state.name}</option>`;
                });
            } catch (error) {
                console.error("Error fetching states:", error);
            }
        }

        async function fetchCities() {
            const stateId = document.getElementById("state").value;
            const citySelect = document.getElementById("city");
            citySelect.innerHTML = '<option value="">---City---</option>';
            if (!stateId) return;

            try {
                const response = await fetch(`http://api.geonames.org/childrenJSON?geonameId=${stateId}&username=${geonamesUsername}`);
                const data = await response.json();
                data.geonames.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.lat},${city.lng}">${city.name}</option>`;
                });
            } catch (error) {
                console.error("Error fetching cities:", error);
            }
        }

        function showMap() {
            const cityValue = document.getElementById("city").value;
            const latitudeValue = document.getElementById("latitude").value;
            const longitudeValue = document.getElementById("longitude").value;
            const zoomValue = document.getElementById("zoom").value;

            // Check if coordinates are entered manually
            if (latitudeValue && longitudeValue) {
                const lat = parseFloat(latitudeValue);
                const lng = parseFloat(longitudeValue);
                if (isNaN(lat) || isNaN(lng)) {
                    alert("Please enter valid latitude and longitude.");
                    return;
                }

                // Initialize or update the map with manual coordinates
                if (!mapInitialized) {
                    window.map = L.map("map").setView([lat, lng], 10);
                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                        attribution: "&copy; OpenStreetMap contributors"
                    }).addTo(window.map);
                    mapInitialized = true; // Set the map as initialized
                } else {
                    window.map.setView([lat, lng], 10);
                }

                // Add a marker for the entered coordinates
                L.marker([lat, lng]).addTo(window.map)
                    .bindPopup(`(${lat} , ${lng})`)
                    .openPopup();
            }
            // Otherwise, use selected city
            else if (cityValue) {
                const [lat, lng] = cityValue.split(",").map(Number);

                // Initialize the map if it's not initialized yet
                if (!mapInitialized) {
                    window.map = L.map("map").setView([lat, lng], zoomValue);
                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                        attribution: "&copy; OpenStreetMap contributors"
                    }).addTo(window.map);
                    mapInitialized = true; // Set the map as initialized
                } else {
                    window.map.setView([lat, lng], zoomValue);
                }

                // Add a marker for the selected city
                L.marker([lat, lng]).addTo(window.map)
                    .bindPopup(`${cityValue}`)
                    .openPopup();
            } else {
                alert("Please either select a city or enter coordinates.");
            }
        }

        // Initialize
        fetchCountries();
    </script> -->
    <script>
        const geonamesUsername = "xitrumbumbum"; // Replace with your free GeoNames username

        let mapInitialized = false; // Flag to check if the map has been initialized
        const predefinedAddresses = [{
                name: "Eiffel Tower, Paris",
                lat: 48.8584,
                lng: 2.2945
            },
            {
                name: "Statue of Liberty, New York",
                lat: 40.6892,
                lng: -74.0445
            },
            {
                name: "Taj Mahal, India",
                lat: 27.1751,
                lng: 78.0421
            },
            {
                name: "Sydney Opera House, Australia",
                lat: -33.8568,
                lng: 151.2153
            },
            {
                name: "Great Wall of China",
                lat: 40.4319,
                lng: 116.5704
            }
        ];

        async function fetchCountries() {
            try {
                const response = await fetch(`http://api.geonames.org/countryInfoJSON?username=${geonamesUsername}`);
                const data = await response.json();
                const countrySelect = document.getElementById("country");
                countrySelect.innerHTML = '<option value="">---Country---</option>';
                data.geonames.forEach(country => {
                    countrySelect.innerHTML += `<option value="${country.geonameId}">${country.countryName}</option>`;
                });
            } catch (error) {
                console.error("Error fetching countries:", error);
            }
        }

        async function fetchStates() {
            const countryId = document.getElementById("country").value;
            const stateSelect = document.getElementById("state");
            const citySelect = document.getElementById("city");
            stateSelect.innerHTML = '<option value="">---State---</option>';
            citySelect.innerHTML = '<option value="">---City---</option>';
            if (!countryId) return;

            try {
                const response = await fetch(`http://api.geonames.org/childrenJSON?geonameId=${countryId}&username=${geonamesUsername}`);
                const data = await response.json();
                data.geonames.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.geonameId}">${state.name}</option>`;
                });
            } catch (error) {
                console.error("Error fetching states:", error);
            }
        }

        async function fetchCities() {
            const stateId = document.getElementById("state").value;
            const citySelect = document.getElementById("city");
            citySelect.innerHTML = '<option value="">---City---</option>';
            if (!stateId) return;

            try {
                const response = await fetch(`http://api.geonames.org/childrenJSON?geonameId=${stateId}&username=${geonamesUsername}`);
                const data = await response.json();
                data.geonames.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.lat},${city.lng}">${city.name}</option>`;
                });
            } catch (error) {
                console.error("Error fetching cities:", error);
            }
        }

        function populateAddressList() {
            const addressSelect = document.getElementById("campus");
            addressSelect.innerHTML = '<option value="">---Select Address---</option>';
            predefinedAddresses.forEach((address, index) => {
                addressSelect.innerHTML += `<option value="${index}">${address.name}</option>`;
            });
        }

        function showMap() {
            const cityValue = document.getElementById("city").value;
            const latitudeValue = document.getElementById("latitude").value;
            const longitudeValue = document.getElementById("longitude").value;
            const zoomValue = parseInt(document.getElementById("zoom").value, 10) || 10;
            const addressIndex = document.getElementById("campus").value;

            let lat, lng;

            // Use selected address if provided
            if (addressIndex) {
                const selectedAddress = predefinedAddresses[addressIndex];
                lat = selectedAddress.lat;
                lng = selectedAddress.lng;
            }
            // Use manually entered coordinates
            else if (latitudeValue && longitudeValue) {
                lat = parseFloat(latitudeValue);
                lng = parseFloat(longitudeValue);
                if (isNaN(lat) || isNaN(lng)) {
                    alert("Please enter valid latitude and longitude.");
                    return;
                }
            }
            // Use selected city
            else if (cityValue) {
                [lat, lng] = cityValue.split(",").map(Number);
            } else {
                alert("Please either select a city, address, or enter coordinates.");
                return;
            }

            // Initialize or update the map
            if (!mapInitialized) {
                window.map = L.map("map").setView([lat, lng], zoomValue);
                L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                    attribution: "&copy; OpenStreetMap contributors"
                }).addTo(window.map);
                mapInitialized = true; // Set the map as initialized
            } else {
                window.map.setView([lat, lng], zoomValue);
            }

            // Add a marker
            L.marker([lat, lng]).addTo(window.map)
                .bindPopup(`(${lat}, ${lng})`)
                .openPopup();
        }

        // Initialize
        fetchCountries();
        populateAddressList();
    </script>

</body>

</html>