
let variationIndex=1;
    // Ensure variationIndex is correctly set on page load
    if (typeof window.variationIndex === 'undefined') {
        window.variationIndex = 1;
    }

    // Function to add a new variation

    const variationForm = document.querySelector('.product_form'); // Assuming the form has this ID
        const variation_div = document.querySelector('.product_variation_div'); // Assuming the button has this ID

    function addVariation() {
        
        
        if (!variationForm || !variation_div) {
            console.error('Form or Add Button not found');
            return;
        }

        const variationContainer = document.createElement("div");
        variationContainer.classList.add('variation_container');
        
        const variationId = `variation_${window.variationIndex}`;
        variationContainer.setAttribute("id", variationId);
        variationContainer.innerHTML = `
            <div class='input_div'>
               <input type="hidden" name="variations[${window.variationIndex}][id]" value="">
                <input type="text" name="variations[${window.variationIndex}][variation_type]" placeholder="Variation Type">
            </div>
            <div class='input_div'>
                <input type="text" name="variations[${window.variationIndex}][variation_value]" placeholder="Variation Value">
            </div>
            <button type="button" onclick="remove_variation_item('${variationId}')">Remove</button>
        `;

        // Append the variationContainer to the form before the add button
        variationForm.insertBefore(variationContainer, variation_div);

        window.variationIndex++;
    }
    function remove_variation_item(variationId){
        const variation_div=document.getElementById(variationId);
        if(variationId){
            variation_div.remove();
        }
    }





// Function to add a gallery URL input
function addProGalleryFromPC() {
 
if(!variationForm || !variation_div){
    console.error("Form or add button not found");
    return;
}
const variationContainer=document.createElement("div");
    variationContainer.classList.add('variation_container');

    const variationId= `variation_${window.variationIndex}`;

    variationContainer.setAttribute("id", variationId);
    variationContainer.innerHTML=`
    <div class='input_div'>
        <input type="hidden" name="product_gallery[${window.variationIndex}][id]" value="">
        <input type="file" name="product_gallery[${window.variationIndex}][image_from_pc]">
        <button type="button" onclick="remove_variation_gallery('${variationId}')">Remove</button>
    </div>`;

    variationForm.insertBefore(variationContainer,variation_div);
    window.variationIndex++;
}

function remove_variation_gallery(variationId)
{
    const variation_div=document.getElementById(variationId);
    if(variationId){
        variation_div.remove();
    }
}

// Function to add a gallery file input
function addProGalleryFromURL() {
    
    
    if(!variationForm || !variation_div){
        console.error("Form or add button not found");
        return;
    }
    const variationContainer=document.createElement("div");
        variationContainer.classList.add('variation_container');
    
        const variationId= `variation_${window.variationIndex}`;
    
        variationContainer.setAttribute("id", variationId);
        variationContainer.innerHTML=`
        <div class='input_div'>
            <input type="hidden" name="product_gallery[${window.variationIndex}][id]" value="">
            <input type="text" name="product_gallery[${window.variationIndex}][image_from_url]">
            <button type="button" onclick="remove_variation_gallery('${variationId}')">Remove</button>
        </div>`;
    
        variationForm.insertBefore(variationContainer,variation_div);
        window.variationIndex++;
    }
    
    function remove_variation_gallery(variationId)
    {
        const variation_div=document.getElementById(variationId);
        if(variationId){
            variation_div.remove();
        }
    }




    function my_image_type() {
   

        const product_image_url = document.querySelector(".product_image_url");
        const product_image_pc = document.querySelector(".product_image_pc");
        const choose_image_btn=document.querySelector(".choose_image_btn button")
    
        const product_image_pc_input = document.querySelector(".product_image_pc input");
        const product_image_url_input = document.querySelector(".product_image_url input");
    
        if (product_image_pc.classList.contains('my_image_type')) {
            product_image_pc.classList.remove('my_image_type');
            product_image_url.classList.add('my_image_type');
             product_image_pc_input.value=''
            choose_image_btn.innerHTML="Choose from URL";
        } else if (product_image_url.classList.contains('my_image_type')) {
            product_image_url.classList.remove('my_image_type');
            product_image_pc.classList.add('my_image_type');
            product_image_url_input.value=''
            choose_image_btn.innerHTML="Choose from PC";
        }
    }



    function admin_open_sidebar(){
        var admin_sidebar=document.querySelector('.admin_sidebar');
        // toggle
        admin_sidebar.classList.toggle('show_on_bobile');
        
      }