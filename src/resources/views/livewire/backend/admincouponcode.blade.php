
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
              <form class="product_form" wire:submit.prevent='savecoupon' >
                <div class="input_div">
                  <input type="text" wire:model="code" placeholder="Enter Coupon Code" value={{ $code }} />
                </div>
                <div class="input_div">
                  <input type="number" wire:model="usage_count" placeholder="Number of usage" value={{ $usage_count }} />
                </div>
                <div class="input_div">
                  <input type="text" wire:model="discount_percentage" placeholder="Discount in percentage" value={{ $discount_percentage }} />
                </div>
                <div class="input_div">
                  <input type="text" wire:model="expires_at" placeholder="Enter expiration date (dd-mm-yyyy)" required id="expires_at">
                </div>
                <div class="submit_div">
                  <button type="submit" class="submit_btn">Save</button>
                </div>
              </form>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Coupon Code</th>
                  <th scope="col">Num users</th>
                  <th scope="col">Percentage</th>
                  <th scope="col">Use onces</th>
                  <th scope="col">Expiring</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($coupons as $item)
                <tr>
                  <th scope="row">{{ $item->code }}</th>
                  <th scope="row">{{ $item->usage_count }}</th>
                  <th scope="row">%{{ $item->discount_percentage }}</th>
                  <th scope="row">{{ $item->one_time_use }}</th>
                  <th scope="row">{{ $item->expires_at }}</th>
                 @if($item->status=="active")
                 <td><button  wire:click="updatecat({{ $item->id }})">Deactivate</button></td>
                 @else
                 <td><button  wire:click="updatecat({{ $item->id }})">Activate</button></td>
                 @endif
                </tr>
                @empty
                    
                @endforelse
               
                
              </tbody>
            </table>
          </div>
      </div>
    </div>
    
  </section>