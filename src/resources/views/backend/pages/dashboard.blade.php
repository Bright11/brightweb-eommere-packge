
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
          <div class="count_items_container">
            <div class="count_admin">
              <div class="admin_icon">
                <h1>N.P</h1>
                <i class="fa fa-address-card-o" style="font-size: 16px"></i>
              </div>
              <div class="number">
                <p>{{ $number_of_product }}</p>
              </div>
            </div>

            <div class="count_admin">
              <div class="admin_icon">
                <h1>TAB:</h1>
                <i class="fa fa-address-card-o" style="font-size: 16px"></i>
              </div>
              <div class="number">
                <p>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $total_amount_bought }}</p>
              </div>
            </div>

            <div class="count_admin">
              <div class="admin_icon">
                <h1>TAS:</h1>
                <i class="fa fa-address-card-o" style="font-size: 16px"></i>
              </div>
              <div class="number">
                <p>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $total_amount_seling }}</p>
              </div>
            </div>

            <div class="count_admin">
              <div class="admin_icon">
                <h1>Profit</h1>
                <i class="fa fa-address-card-o" style="font-size: 16px"></i>
              </div>
              <div class="number">
                <p>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $total_profit }}</p>
              </div>
            </div>

            <div class="count_admin">
              <div class="admin_icon">
                <h1>users</h1>
                <i class="fa fa-address-card-o" style="font-size: 16px"></i>
              </div>
              <div class="number">
                <p>{{ $number_of_users }}</p>
              </div>
            </div>
            <!-- chart -->
            <div class="chart_holder">
              <canvas id="myChart"></canvas>
            </div>

            <!--  -->
          </div>
        </div>

        <!--  -->
      </div>
    </div>
  </section>

     
   @endsection
   