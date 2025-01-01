<form  action="{{ route('addproduct', ['id' => $product->id ?? null]) }} "  class="product_form" method="post" enctype="multipart/form-data" >
    @csrf
   
    <div class="input_div">
        <input type="text" value="{{ $product->name??null }}" name="name" placeholder="Product name" />
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="input_div">
        <select name="category_id">
            @if ($product)
            <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
            @endif
            <option value="">Choose Category</option>
            @forelse($getcategory as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @empty
                <option value="">No categories available</option>
            @endforelse
        </select>
        @error('category_id') <span class="error">{{ $message }}</span> @enderror
    </div>
    
    <div class="input_div">
        <input type="number" name="buying_price" placeholder="Product bought price" value="{{ $product->buying_price??null }}" />
        @error('buying_price') <span class="error">{{ $message }}</span> @enderror
    </div>
    
    <div class="input_div">
        <input type="number"  value="{{ $product->selling_price??null }}" name="selling_price" placeholder="Product selling price" />
        @error('selling_price') <span class="error">{{ $message }}</span> @enderror
    </div>
    
    <div class="input_div">
        <input type="number"  value="{{ $product->discount??null }}" name="discount" placeholder="Product discount" />
        @error('discount') <span class="error">{{ $message }}</span> @enderror
    </div>
    
    <div class="input_div">
        <input type="number"  value="{{ $product->qty??null }}" name="qty" placeholder="Product quantity" />
        @error('qty') <span class="error">{{ $message }}</span> @enderror
    </div>
    
    <div class="input_div product_image_url my_image_type">
        <input type="text" name="image_url" placeholder="Image URL" />
        @error('image_url') <span class="error">{{ $message }}</span> @enderror
    </div>
    
    <div class="input_div product_image_pc">
        <input type="file" name="image_pc" />
        @error('image_pc') <span class="error">{{ $message }}</span> @enderror
    </div>
   @if ($product)
   @if ($product->image_pc)
   <img width="50" height="50" src="{{ asset("product/$product->image_pc") }}" alt="{{ $item->name }}">
   @else
   <img width="50" height="50" src="{{$product->image_url}}" alt="{{ $item->name }}">
   @endif
       
   @endif
    
    <div class="choose_image_btn">
        <button type="button" onclick="my_image_type()">Choose Image URL</button>
    </div>
    
    <div class="input_div">
        <textarea name="description" placeholder="Product description">{{ $product->description??null }}</textarea>
        @error('description') <span class="error">{{ $message }}</span> @enderror
    </div>
    
    <div class="input_div">
        <textarea name="keywords" placeholder="Product keywords">{{ $product->keywords??null }}</textarea>
        @error('keywords') <span class="error">{{ $message }}</span> @enderror
    </div>

  @if ($product)
  @if ($product->variations)
  <label for="">Product varaition</label>
 @forelse ($product->variations as $index=> $item)

 <div class='input_div'>
    <input type="hidden" name="variations[{{ $index }}][id]" value="{{ $item->id }}">
  <input type="text" name="variations[{{ $index }}][variation_type]" placeholder="Variation Type" value="{{ $item->variation_type }}">
</div>
<div class='input_div'>
  <input type="text" name="variations[{{ $index }}][variation_value]" placeholder="Variation Value" value="{{ $item->variation_value}}">
</div>
 @empty
     
 @endforelse
  @endif
  @endif

    <div class="product_variation_div">
        <button id="add_variation_btn" type="button" onclick="addVariation()">Add Variation</button>
        <button type="button" id="addimg" onclick="addProGalleryFromPC()">Add Image from PC</button>
        <button type="button" id="addimg" onclick="addProGalleryFromURL()">Image URL</button>
    </div>

    <div class="submit_div">
        <button type="submit" class="submit_btn">Save</button>
    </div>
</form>

