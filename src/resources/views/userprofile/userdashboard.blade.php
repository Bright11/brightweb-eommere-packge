@extends('brightweb::userprofile.userincludes.header')

@section('content')
<section class="admin_section">
    
        <div class="admin_content">
          <div class="count_items_container">
            <div class="count_admin">
              <div class="admin_icon">
                <h1>Number of Order</h1>
            
              </div>
              <div class="number">
                <p>{{$userorder}}</p>
              </div>
            </div>

            <div class="count_admin">
              <div class="admin_icon">
                <h1>Total amount paid</h1>
               
              </div>
              <div class="number">
                <p>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{$paid_amount}}</p>
              </div>
            </div>

            <div class="count_admin">
              <div class="admin_icon">
                <h1>Unread Messages</h1>
                
              </div>
              <div class="number">
                <p>{{$message}}</p>
              </div>
            </div>

            <div class="count_admin">
              <div class="admin_icon">
                <h1>Nu referrals</h1>
           
              </div>
              <div class="number">
                <p>{{$referralnumber}}</p>
              </div>
            </div>
            <!-- chart -->
            <div class="chart_holder">
              <canvas id="myChart"></canvas>
            </div>

            <!--  -->
          </div>
        </div>

      
  </section>

@endsection