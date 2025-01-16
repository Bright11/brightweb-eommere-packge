
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
                  <input type="number" wire:model="max_users" placeholder="Number of usage" value={{ $max_users }} />
                </div>
                <div class="input_div">
                  <input type="text" wire:model="discount_percentage" placeholder="Discount in percentage" value={{ $discount_percentage }} />
                </div>
                <div class="input_div">
                 <select wire:model="onetimeusage">
                  <option value="">One time usage</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                 </select>
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
                  <th scope="col">Use once</th>
                  <th scope="col">Expiring</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($coupons as $item)
                <tr>
                  <th scope="row">{{ $item->code }}</th>
                  @if ($item->max_users==0)
                  <th scope="row">Unlimited</th>
                  @else
                  <th scope="row">{{ $item->max_users }}</th>
                  @endif
                 
                  <th scope="row">{{ $item->discount_percentage }}%</th>
                  @if ($item->one_time_use==true)
                  <th scope="row">Yes</th>
                  @else
                  <th scope="row">No</th>
                  @endif
                 
                  <th scope="row">{{ \Carbon\Carbon::parse($item->expires_at)->format('Y-m-d') }} </th>
                 @if($item->status=="active")
                 <td><button  wire:click="activate({{ $item->id }})">Activate</button></td>
                 @else
                 <td><button  wire:click="activate({{ $item->id }})">Deactivate</button></td>
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