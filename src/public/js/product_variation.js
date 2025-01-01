let variationIndex = 1;
if (typeof window.variationIndex === 'undefined') {
    window.variationIndex = 1;
}

// Function to add a new variation
function addVariation() {
    const variationForm = document.querySelector(".product_form");
    const addButton = variationForm.querySelector(".product_variation_div");

    // Create a container for the variation inputs and remove button
    const variationContainer = document.createElement("div");
    variationContainer.classList.add("variation_container");

    // Create the variation type input container
    const typeInputDiv = document.createElement("div");
    typeInputDiv.classList.add("input_div");

    const variationTypeInput = document.createElement("input");
    variationTypeInput.type = "text";
    variationTypeInput.id = `variation_${window.variationIndex}_type`;
    variationTypeInput.name = `variation_type[${window.variationIndex}]`;
    variationTypeInput.placeholder = "Enter variation type";

    typeInputDiv.appendChild(variationTypeInput);

    // Create the variation value input container
    const valueInputDiv = document.createElement("div");
    valueInputDiv.classList.add("input_div");

    const variationValueLabel = document.createElement("label");
    variationValueLabel.setAttribute("for", `variation_${window.variationIndex}_value`);
    variationValueLabel.textContent = "Variation Value:";

    const variationValueInput = document.createElement("input");
    variationValueInput.type = "text";
    variationValueInput.id = `variation_${window.variationIndex}_value`;
    variationValueInput.name = `variation_value[${window.variationIndex}]`;
    variationValueInput.placeholder = "Enter variation value";

    valueInputDiv.appendChild(variationValueLabel);
    valueInputDiv.appendChild(variationValueInput);

    // Create the remove button
    const removeButton = document.createElement("button");
    removeButton.type = "button";
    removeButton.textContent = "Remove";
    removeButton.classList.add("remove_variation_btn");

    // Add event listener to remove the variation container
    removeButton.addEventListener("click", () => {
        variationContainer.remove();
    });

    // Append inputs and remove button to the variation container
    variationContainer.appendChild(typeInputDiv);
    variationContainer.appendChild(valueInputDiv);
    variationContainer.appendChild(removeButton);

    // Insert the variation container before the add button
    variationForm.insertBefore(variationContainer, addButton);

    window.variationIndex++;
}

// Assuming you have a button to trigger adding a new variation

function addprogallery_url()
{
    const galleryForm = document.querySelector(".product_form");
    const addButton = document.querySelector(".product_variation_div");
    const galleryContainer = document.createElement("div");
    galleryContainer.classList.add("variation_container");
    const galleryInputDiv = document.createElement("div");
    galleryInputDiv.classList.add("input_div");
    const galleryInput = document.createElement("input");
    galleryInput.type = "text";
    galleryInput.id = `gallery_${window.variationIndex}`;
    galleryInput.name = `gallery[${window.variationIndex}]`;
    galleryInput.placeholder = "Enter gallery image URL";

    // remove image
   const  removeimageButton=document.createElement("button")
   removeimageButton.type="button";
   removeimageButton.textContent="Remove";
   removeimageButton.classList.add("remove_variation_btn");

//    adding eventlistener to the remove button
removeimageButton.addEventListener("click",()=>{
    galleryContainer.remove();
})

    galleryInputDiv.appendChild(galleryInput);
    galleryContainer.appendChild(galleryInputDiv);
    galleryForm.insertBefore(galleryContainer, addButton);
    galleryInputDiv.appendChild(removeimageButton);
    window.variationIndex++;
}


function addprogallery_from_pc()
{
    const galleryForm = document.querySelector(".product_form");
    const addButton = document.querySelector(".product_variation_div");
    const galleryContainer = document.createElement("div");
    galleryContainer.classList.add("variation_container");
    const galleryInputDiv = document.createElement("div");
    galleryInputDiv.classList.add("input_div");
    const galleryInput = document.createElement("input");
    galleryInput.type = "file";
    galleryInput.id = `gallery_${window.variationIndex}`;
    galleryInput.name = `gallery[${window.variationIndex}]`;
    galleryInput.placeholder = "Enter gallery image URL";

    // remove image
   const  removeimageButton=document.createElement("button")
   removeimageButton.type="button";
   removeimageButton.textContent="Remove";
   removeimageButton.classList.add("remove_variation_btn");

//    adding eventlistener to the remove button
removeimageButton.addEventListener("click",()=>{
    galleryContainer.remove();
})

    galleryInputDiv.appendChild(galleryInput);
    galleryContainer.appendChild(galleryInputDiv);
    galleryForm.insertBefore(galleryContainer, addButton);
    galleryInputDiv.appendChild(removeimageButton);
    window.variationIndex++;
}