@extends('brightweb::backend.layouts.header')
   

@section('content')
<section class="admin_section">
    <div class="admin_container">
      <!-- top ba -->
     @include("brightweb::backend.layouts.topbar")
      <div class="page_admin_container">
        <div class="admin_sidebar">
          @include("brightweb::backend.layouts.sidebar")
        </div>
        <div class="admin_content">
      
         <div class="container_forms">
          <div class="admin_container_main">
            <form  action=""  class="product_form" method="post">
                @csrf
               
                <div class="input_div">
                   <select name="status">
                    <option value="{{ $paymentchecker->order_status }}">{{ $paymentchecker->order_status }}</option>
                    <option value="Processing">Processing</option>
                    <option value="On the way">On the way</option>
                    <option value="completed">Completed</option>
                   </select>
                   @error('status') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="input_div">
                  <textarea placeholder="Optional Message" name="message" cols="30" rows="10"></textarea>
                </div>
                
                <div class="submit_div">
                    <button type="submit" class="submit_btn">Save</button>
                </div>
            </form>
           
          </div>
        </div>
         
        </div>
      </div>
    </div>
  </section>

@endsection

    