<section class="sharable_Section">
    <div class="share_details" >
        <h1>Share This Product</h1>
        <!-- Social media share links as list items with Font Awesome icons -->

        <ul class="social-icons">
        @php
            $url = route('productDetails', ['slug' => $pro_details->slug]);
            if ($referral) {
                $urlWithUserId = $url . '?referral=' . $referral;
            } else {
                $urlWithUserId = $url;
            }
        @endphp

        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($urlWithUserId) }}" target="_blank" class="fa fa-facebook"></a></li>
        <li><a href="https://twitter.com/intent/tweet?url={{ urlencode($urlWithUserId) }}" target="_blank" class="fa fa-twitter"></a></li>
        <li><a href="https://plus.google.com/share?url={{ urlencode($urlWithUserId) }}" target="_blank"  class="fa fa-google"></a></li>
        <li><a href="https://www.linkedin.com/shareArticle?url={{ urlencode($urlWithUserId) }}" target="_blank" class="fa fa-linkedin"></a></li>

        <li><a href="whatsapp://send?text={{ urlencode('Check out this product: ' . $urlWithUserId) }}" target="_blank"><i class="fa fa-whatsapp"></i></a></li>

        <li><a href="https://www.instagram.com/share?url={{ urlencode($urlWithUserId) }}" target="_blank" class="fa fa-instagram"></a></li>
        
        <li><a href="https://t.me/share/url?url={{ urlencode($urlWithUserId) }}&text={{ urlencode('Check out this product: ' . $urlWithUserId) }}" target="_blank" class="fa fa-telegram"></a></li>

        <li><a href="https://chat.whatsapp.com/ABCDEF123456" target="_blank" class="fa fa-whatsapp"></a></li>

        <li><a href="mailto:?body={{ urlencode($urlWithUserId) }}" target="_blank" class="fa fa-envelope"></a></li>
        <li><a href="sms:?body={{ urlencode($urlWithUserId) }}" target="_blank" class="fa fa-comment"></a></li>

        <li><a href="https://pinterest.com/pin/create/button/?url={{ urlencode($urlWithUserId) }}&media=IMAGE_URL&description=DESCRIPTION_HERE" target="_blank" class="fa fa-pinterest-square"></a></li>
    </ul>
    </div>
   
</section>
