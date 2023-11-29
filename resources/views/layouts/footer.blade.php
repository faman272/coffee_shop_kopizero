  <!-- FOOTER -->
  <section class="footer">
      <div class="box-container">

          <div class="box">
              <h3>quick links</h3>
              <a href="#home"><i class="fas fa-arrow-right"></i> home</a>
              <a href="#about"><i class="fas fa-arrow-right"></i> about</a>
              <a href="#menu"><i class="fas fa-arrow-right"></i> menu</a>
              <a href="#review"><i class="fas fa-arrow-right"></i> review</a>
              <a href="#book"><i class="fas fa-arrow-right"></i> book</a>
          </div>

          <div class="box">
              <h3>contact info</h3>
              <a href="#"><i class="fas fa-phone"></i> +123-456-7890</a>
              <a href="#"><i class="fas fa-phone"></i> +111-222-3333</a>
              <a href="#"><i class="fas fa-envelope"></i> coffee@gmail.com</a>
              <a href="#"><i class="fas fa-envelope"></i> Perú, Lima</a>
          </div>

          <div class="box">
              <h3>contact info</h3>
              <a href="#"><i class="fab fa-facebook-f"></i> facebook</a>
              <a href="#"><i class="fab fa-twitter"></i> twitter</a>
              <a href="#"><i class="fab fa-instagram"></i> instagram</a>
              <a href="#"><i class="fab fa-linkedin"></i> linkedin</a>
              <a href="#"><i class="fab fa-twitter"></i> twitter</a>
          </div>
      </div>

      {{-- <div class="box">
          <h3>Our Location</h3>
          <div id="map"></div>
      </div> --}}

      <div class="credit"><span>Kopi Zero</span> | all rights reserved</div>
  </section>


  <!-- Include the Google Maps JavaScript API -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>

<script>
    function initMap() {
        // The location of your coffee shop
        var coffeeShop = {lat: -25.363, lng: 131.044};

        // The map, centered at your coffee shop
        var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 4, center: coffeeShop});

        // The marker, positioned at your coffee shop
        var marker = new google.maps.Marker({position: coffeeShop, map: map});
    }

    // Initialize the map when the window loads
    window.onload = initMap;
</script>

<style>
    /* Set the size of the div element that contains the map */
    #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the screen width */
    }
</style>