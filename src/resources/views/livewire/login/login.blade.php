<section class="product_section">
    <div class="loginform_container">
 @if ($switchform==true)
 @include('brightweb::frontend.frontendforms.loginform')
 @else
 @include('brightweb::frontend.frontendforms.registerform')
 @endif
    </div>
</section>
 <!--  -->