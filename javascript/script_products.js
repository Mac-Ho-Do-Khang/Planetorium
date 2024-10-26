// Object to store clicked planets
let selectedPlanets = {};

// Get all cart icons
const cartIcons = document.querySelectorAll(".cart-icon");

// Get the shopping items display element
const shoppingItemsDisplay = document.querySelector(".shoping-items");

// Function to update the shopping list display
function updateShoppingList() {
  // Clear the current shopping list
  shoppingItemsDisplay.innerHTML = "";

  // Iterate over selected planets and display them
  for (const [image_name, planet_name] of Object.entries(selectedPlanets)) {
    // Create a new div for the planet name
    const nameDiv = document.createElement("div");
    nameDiv.textContent = planet_name; // Set the text to the planet name
    nameDiv.className = "planet-thumbnail-name";
    const iconElement = document.createElement("ion-icon");
    iconElement.setAttribute("name", "close-circle"); // Set the icon name
    iconElement.className = "planet-thumbnail-remove";
    // Add click event listener to the remove icon
    iconElement.addEventListener("click", function () {
      // Remove the planet from selectedPlanets
      delete selectedPlanets[image_name];
      console.log(planet_name + " removed from cart.");

      // Update the shopping list display after removal
      updateShoppingList();
    });

    // Append the ion-icon element to the nameDiv
    nameDiv.appendChild(iconElement);
    // Create a new img element for the image name
    const imgElement = document.createElement("img");
    imgElement.src = image_name; // Set the source to the image name
    imgElement.alt = planet_name; // Optional: set an alt attribute for accessibility
    imgElement.className = "planet-thumbnail"; // Add the class

    // Append the nameDiv to the shoppingItemsDisplay
    shoppingItemsDisplay.appendChild(imgElement);
    shoppingItemsDisplay.appendChild(nameDiv);
  }
}

// Add click event listeners to each cart icon
cartIcons.forEach((icon) => {
  icon.addEventListener("click", function () {
    // Check if the user is logged in
    if (!isLoggedIn) {
      alert("You need to login first");
      return; // Stop further execution if not logged in
    }

    // Get the planet name from the data attributes
    const image = this.getAttribute("data-image");
    const planet_name = this.getAttribute("data-planetname");

    // Check if the planet is already in the object
    if (!selectedPlanets[image]) {
      // Add the clicked planet to the object
      selectedPlanets[image] = planet_name;
      console.log(planet_name + " added to cart.");

      // Update the shopping list display
      updateShoppingList();
    } else {
      console.log(planet_name + " is already in the cart.");
    }

    // Output the current selected planets (for demonstration)
    console.log("Selected planets:", selectedPlanets);
  });
});
