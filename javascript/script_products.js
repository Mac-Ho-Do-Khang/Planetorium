// Object to store clicked planets
var cart_icons;
var buttons;

// Fetch all planets for the first time the page is loaded
function first_fetch_all_planets() {
  const searchInput = document.querySelector("input[name='searcha_planet']");
  const planetContainer = document.querySelector(".planet-container");
  const searchQuery = searchInput.value.trim();
  fetch(`fetch_planets.php?search=${encodeURIComponent(searchQuery)}`)
    .then((response) => response.text())
    .then((data) => {
      planetContainer.innerHTML = data; // Update the content dynamically
      update_event_listeners();
    })
    .catch((error) => {
      console.error("Error fetching planets:", error);
    });
}
// Get all selected planets for the first time the page is loaded
function first_get_selected_planets() {
  selected_planets = {};
  const url = `user_planets.php?current_user=${encodeURIComponent(current_user)}`;

  fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok: " + response.statusText);
      }
      return response.text();
    })
    .then((data) => {
      const parser = new DOMParser();
      const xmlDoc = parser.parseFromString(data, "application/xml");
      const products = xmlDoc.getElementsByTagName("product");
      for (let i = 0; i < products.length; i++) {
        const pname = products[i].getElementsByTagName("pname")[0].textContent;
        const quantity = products[i].getElementsByTagName("quantity")[0].textContent;
        const image_source = products[i].getElementsByTagName("image_source")[0].textContent;
        selected_planets[image_source] = {
          pname: pname,
          quantity: quantity,
        };
      }
      updateShoppingList(selected_planets);
    })
    .catch((error) => {
      console.error("There was a problem with the fetch operation:", error);
    });
}
first_fetch_all_planets();
first_get_selected_planets();

const shoppingItemsDisplay = document.querySelector(".shoping-items");

function updateShoppingList(selected_planets) {
  // Clear the current shopping list
  shoppingItemsDisplay.innerHTML = "";

  // Iterate over selected planets and display them
  for (const [image_link, planet_info] of Object.entries(selected_planets)) {
    const planet_name = planet_info.pname;
    const quantity = planet_info.quantity;
    // Create a new div for the planet name
    const nameDiv = document.createElement("div");
    nameDiv.textContent = planet_name; // Set the text to the planet name
    nameDiv.className = "planet-thumbnail-name";

    // Create the details div that will contain the increase/decrease icons and quantity span
    const detailsDiv = document.createElement("div");
    detailsDiv.className = "planet-thumbnail-details";

    // Create the decrease icon
    const decreaseIcon = document.createElement("ion-icon");
    decreaseIcon.setAttribute("name", "caret-back");
    decreaseIcon.className = "planet-thumbnail-decrease";
    decreaseIcon.addEventListener("click", function (e) {
      // Create a FormData object to send data
      const formData = new FormData();
      formData.append("image", image_link);
      formData.append("name", planet_name);
      formData.append("user", current_user);

      // Send the request using Fetch API
      fetch("unpurchase.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text()) // Get the response as text
        .then((data) => {
          // Parse the XML response
          const parser = new DOMParser();
          const xmlDoc = parser.parseFromString(data, "application/xml");
          const status = xmlDoc.getElementsByTagName("status")[0].textContent;

          if (status === "success") {
            if (isLoggedIn) alert(xmlDoc.getElementsByTagName("message")[0].textContent); // Show success message
          } else {
            console.error(
              "Error occurred: " + xmlDoc.getElementsByTagName("message")[0].textContent
            );
            alert("Error: " + xmlDoc.getElementsByTagName("message")[0].textContent); // Show error message
          }
        })
        .catch((error) => {
          console.error("Fetch error: ", error);
          alert("An error occurred while adding the planet using increase button.");
        });
      selected_planets = {};
      const xhr = new XMLHttpRequest();
      const url = `user_planets.php?current_user=${encodeURIComponent(current_user)}`;
      xhr.open("GET", url, true);
      xhr.onload = function () {
        if (xhr.status === 200) {
          const parser = new DOMParser();
          const xmlDoc = parser.parseFromString(xhr.responseText, "application/xml");
          const products = xmlDoc.getElementsByTagName("product");
          for (let i = 0; i < products.length; i++) {
            const pname = products[i].getElementsByTagName("pname")[0].textContent;
            const quantity = products[i].getElementsByTagName("quantity")[0].textContent;
            const image_source = products[i].getElementsByTagName("image_source")[0].textContent;
            selected_planets[image_source] = {
              pname: pname,
              quantity: quantity,
            };
          }
          updateShoppingList(selected_planets);
        }
      };
      xhr.send();
    });

    // Create the quantity span (initially empty)
    const quantitySpan = document.createElement("span");
    quantitySpan.className = "planet-thumbnail-quantity";
    quantitySpan.textContent = quantity;

    // Create the increase icon
    const increaseIcon = document.createElement("ion-icon");
    increaseIcon.setAttribute("name", "caret-forward");
    increaseIcon.className = "planet-thumbnail-increase";
    increaseIcon.addEventListener("click", function (e) {
      // Create a FormData object to send data
      const formData = new FormData();
      formData.append("image", image_link);
      formData.append("name", planet_name);
      formData.append("user", current_user);

      // Send the request using Fetch API
      fetch("purchase.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text()) // Get the response as text
        .then((data) => {
          // Parse the XML response
          const parser = new DOMParser();
          const xmlDoc = parser.parseFromString(data, "application/xml");
          const status = xmlDoc.getElementsByTagName("status")[0].textContent;

          if (status === "success") {
            if (isLoggedIn) alert(xmlDoc.getElementsByTagName("message")[0].textContent); // Show success message
          } else {
            console.error(
              "Error occurred: " + xmlDoc.getElementsByTagName("message")[0].textContent
            );
            alert("Error: " + xmlDoc.getElementsByTagName("message")[0].textContent); // Show error message
          }
        })
        .catch((error) => {
          console.error("Fetch error: ", error);
          alert("An error occurred while adding the planet using increase button.");
        });
      selected_planets = {};
      const xhr = new XMLHttpRequest();
      const url = `user_planets.php?current_user=${encodeURIComponent(current_user)}`;
      xhr.open("GET", url, true);
      xhr.onload = function () {
        if (xhr.status === 200) {
          const parser = new DOMParser();
          const xmlDoc = parser.parseFromString(xhr.responseText, "application/xml");
          const products = xmlDoc.getElementsByTagName("product");
          for (let i = 0; i < products.length; i++) {
            const pname = products[i].getElementsByTagName("pname")[0].textContent;
            const quantity = products[i].getElementsByTagName("quantity")[0].textContent;
            const image_source = products[i].getElementsByTagName("image_source")[0].textContent;
            selected_planets[image_source] = {
              pname: pname,
              quantity: quantity,
            };
          }
          updateShoppingList(selected_planets);
        }
      };
      xhr.send();
    });

    // Append the icons and quantity span to the detailsDiv
    detailsDiv.appendChild(decreaseIcon);
    detailsDiv.appendChild(quantitySpan);
    detailsDiv.appendChild(increaseIcon);

    // Create a new img element for the planet image
    const imgElement = document.createElement("img");
    imgElement.src = image_link; // Set the source to the image link
    imgElement.className = "planet-thumbnail"; // Add the class
    nameDiv.appendChild(detailsDiv); // Append the detailsDiv to the nameDiv

    // Append the img element and nameDiv to the shoppingItemsDisplay
    shoppingItemsDisplay.appendChild(imgElement);
    shoppingItemsDisplay.appendChild(nameDiv);
  }
}

function update_event_listeners() {
  // --------------Handle the shopping lists--------------
  cart_icons = document.querySelectorAll(".cart-icon");
  cart_icons.forEach((icon) => {
    icon.addEventListener("click", function (e) {
      if (!isLoggedIn) {
        alert("You need to login first");
        return; // Stop further execution if not logged in
      }

      // // Get the planet name from the data attributes
      // const image = this.getAttribute("data-image");
      // const planet_name = this.getAttribute("data-planetname");
      // // Check if the planet is already in the object
      // if (!selected_planets[image]) {
      //   // Add the clicked planet to the object
      //   selected_planets[image] = planet_name;
      //   console.log(image + " added to cart.");
      //   // Update the shopping list display
      //   updateShoppingList();
      // } else {
      //   console.log(planet_name + " is already in the cart.");
      // }
      selected_planets = {};
      const xhr = new XMLHttpRequest();
      const url = `user_planets.php?current_user=${encodeURIComponent(current_user)}`;
      xhr.open("GET", url, true);
      xhr.onload = function () {
        if (xhr.status === 200) {
          const parser = new DOMParser();
          const xmlDoc = parser.parseFromString(xhr.responseText, "application/xml");
          const products = xmlDoc.getElementsByTagName("product");
          for (let i = 0; i < products.length; i++) {
            const pname = products[i].getElementsByTagName("pname")[0].textContent;
            const quantity = products[i].getElementsByTagName("quantity")[0].textContent;
            const image_source = products[i].getElementsByTagName("image_source")[0].textContent;
            selected_planets[image_source] = {
              pname: pname,
              quantity: quantity,
            };
          }
          updateShoppingList(selected_planets);
        }
      };
      xhr.send();
    });
  });
  // --------------Handle the actual transaction--------------
  buttons = document.getElementsByClassName("cart-icon-container");
  for (let button of buttons) {
    button.addEventListener("click", function () {
      const planetImage = this.querySelector(".cart-icon").getAttribute("data-image");
      const planetName = this.querySelector(".cart-icon").getAttribute("data-planetname");
      const userName = current_user; // Get user name from PHP session

      // Create a FormData object to send data
      const formData = new FormData();
      formData.append("image", planetImage);
      formData.append("name", planetName);
      formData.append("user", userName);

      // Send the request using Fetch API
      fetch("purchase.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text()) // Get the response as text
        .then((data) => {
          // Parse the XML response
          const parser = new DOMParser();
          const xmlDoc = parser.parseFromString(data, "application/xml");
          const status = xmlDoc.getElementsByTagName("status")[0].textContent;

          if (status === "success") {
            if (isLoggedIn) alert(xmlDoc.getElementsByTagName("message")[0].textContent); // Show success message
          } else {
            console.error(
              "Error occurred: " + xmlDoc.getElementsByTagName("message")[0].textContent
            );
            alert("Error: " + xmlDoc.getElementsByTagName("message")[0].textContent); // Show error message
          }
        })
        .catch((error) => {
          console.error("Fetch error: ", error);
          alert("An error occurred while adding the planet.");
        });
    });
  }
}
update_event_listeners(); // Add event listeners to all cart icons the first time the page is loaded

const searchForm = document.querySelector(".search-form");
searchForm.addEventListener("submit", function (e) {
  e.preventDefault(); // Prevent default form submission when Enter is pressed
  searchIcon.click();
});

searchIcon = document.querySelector(".search-icon");
searchIcon.addEventListener("click", function (e) {
  e.preventDefault();
  const search_content = document.querySelector(".search-bar").value;
  // If empty searh bar, load all planets
  if (search_content.trim() === "") {
    first_fetch_all_planets();
    return;
  }
  const url = `filter.php?product=${encodeURIComponent(search_content)}`;

  // Send the request using Fetch API
  fetch(url, {
    method: "GET",
  })
    .then((response) => response.text()) // Get the response as text
    .then((data) => {
      // Parse the XML response
      const parser = new DOMParser();
      const xmlDoc = parser.parseFromString(data, "application/xml");
      const status = xmlDoc.getElementsByTagName("status")[0].textContent;

      if (status === "not found") {
        alert(xmlDoc.getElementsByTagName("message")[0].textContent);
      } else {
        // planet found
        const searchInput = document.querySelector("input[name='searcha_planet']");
        const planetContainer = document.querySelector(".planet-container");
        const searchQuery = searchInput.value.trim();
        fetch(`fetch_planets.php?search=${encodeURIComponent(searchQuery)}`)
          .then((response) => response.text())
          .then((data) => {
            planetContainer.innerHTML = data; // Update the content dynamically
            update_event_listeners();
          })
          .catch((error) => {
            console.error("Error fetching planets:", error);
          });
      }
    })
    .catch((error) => {
      console.error("Fetch error: ", error);
      alert("An error occurred while searching the planet.");
    });
});

categories = document.querySelectorAll(".dropdown-content-category");
categories.forEach((category) => {
  category.addEventListener("click", function (e) {
    e.preventDefault();
    const planetContainer = document.querySelector(".planet-container");
    fetch(`categorize_planets.php?category=${encodeURIComponent(category.textContent)}`)
      .then((response) => response.text())
      .then((data) => {
        planetContainer.innerHTML = data; // Update the content dynamically
        update_event_listeners();
      })
      .catch((error) => {
        console.error("Error fetching planets:", error);
      });
  });
});
