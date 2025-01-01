


{{-- <script src="{{route("brightweb.js",['filename'=>'admin_chart.js'])}}"></script> --}}
<script src="{{ asset("vendor/brightweb/adminjs/admin_chart.js") }}"></script>

{{-- <script src="{{route("brightweb.js",['filename'=>'product_variation.js'])}}"></script> --}}
<script src="{{ asset("vendor/brightweb/adminjs/product_variation.js") }}"></script>

{{-- <script src="{{route("brightweb.js",['filename'=>'product_variation.js'])}}"></script> --}}
 <!-- DataTables JS -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables JS -->
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"
    ></script>
    <!-- DataTables Buttons JS -->
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"
    ></script>
    <!-- JSZip for Excel export -->
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"
    ></script>
    <!-- pdfmake for PDF export -->
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"
    ></script>
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"
    ></script>
    <!-- Buttons HTML5 export JS -->
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"
    ></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables JS -->
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"
    ></script>
    <!-- DataTables Buttons JS -->
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"
    ></script>
    <!-- JSZip for Excel export -->
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"
    ></script>
    <!-- pdfmake for PDF export -->
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"
    ></script>
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"
    ></script>
    <!-- Buttons HTML5 export JS -->
    <script
      type="text/javascript"
      charset="utf8"
      src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"
    ></script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
      $(document).ready(function () {
        $("#myTable").DataTable({
          dom: "Bftip",
          buttons: [
            {
              extend: "copy",
              className: "custom-btn btn btn-outline-primary",
            },
            {
              extend: "excel",
              className: "custom-btn btn btn-outline-success",
            },
            {
              extend: "pdf",
              className: "custom-btn btn btn-outline-danger",
              customize: function (doc) {
                var dataUrl = getBase64Image(document.querySelector("img"));
                doc.content[1].table.body.forEach(function (row, i) {
                  if (i > 0) {
                    row.push({
                      image: dataUrl,
                      width: 50,
                      height: 50,
                    });
                  }
                });
              },
            },
          ],
        });

        function getBase64Image(img) {
          var canvas = document.createElement("canvas");
          canvas.width = img.width;
          canvas.height = img.height;
          var ctx = canvas.getContext("2d");
          ctx.drawImage(img, 0, 0);
          var dataURL = canvas.toDataURL("image/png");
          return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
        }
      });
    </script>

    <style>
      .custom-btn {
        background-color: #4caf50; /* Green */
        border: none;
        color: white;
        padding: 10px 14px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 8px 6px;
        transition-duration: 0.4s;
        cursor: pointer;
        margin-bottom: 10px; /* Add margin bottom */
      }

      .custom-btn:hover {
        background-color: white;
        color: black;
        border: 2px solid #4caf50;
      }

      /* Hide DataTables bottom navigation, content, and headers */
      .dataTables_paginate,
      .dataTables_info,
      .dataTables_filter,
      .dataTables_length,
      .dataTables_scrollBody,
     
      .dataTables_scrollFoot {
        display: none !important;
      }
    </style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      flatpickr("#expires_at", {
          dateFormat: "d-m-Y", // Set the desired format
          minDate: "today" // Prevent past dates
      });
  });
</script>
   
  </body>

</html>

