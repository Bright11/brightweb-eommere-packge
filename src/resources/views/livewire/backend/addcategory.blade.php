<section class="admin_section">
    <div class="admin_container">
    
      <!-- top ba -->
     @include("brightweb::backend.layouts.topbar")
      <div class="page_admin_container">
        <div class="admin_sidebar">
          @include("brightweb::backend.layouts.sidebar")
        </div>
        <div class="admin_content">
            <div class="admin_container_main">
              @if (session()->has('message'))
              <div style="color: red">{{ session('message') }}</div>
          @endif
          @if ($errors->has('name'))
          @error('name') <span class="error" style="color: red">{{ $message }}</span> @enderror
      @endif
              <form class="product_form" wire:submit.prevent='savecategory' >
                <div class="input_div">
                  <input type="text" wire:model="name" placeholder="Product name" value={{ $name }} />
                </div>
                <div class="submit_div">
                  <button type="submit" class="submit_btn">Save</button>
                </div>
              </form>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Update</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($fetchcategory as $item)
                <tr>
                  <th scope="row">{{ $item->name }}</th>
                  <td><button  wire:click="updatecat({{ $item->id }})">Update</button></td>
                  <td><a href="#" wire:click="deletecat({{ $item->id }})">Delete</a></td>
                </tr>
                @empty
                    
                @endforelse
               
                
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </section>