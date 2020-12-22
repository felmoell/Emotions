<!Doctype HTML>
<html>

<body>

  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
      integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
      crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
      integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
      crossorigin=""></script>


    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/apple-icon-57x57.png')}}"
      type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/apple-icon-60x60.png')}}"
      type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/apple-icon-72x72.png')}}"
      type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/apple-icon-76x76.png')}}"
      type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/apple-icon-114x114.png')}}"
      type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/apple-icon-120x120.png')}}"
      type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/apple-icon-144x144.png')}}"
      type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/apple-icon-152x152.png')}}"
      type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/apple-icon-180x180.png')}}"
      type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/favicon-32x32.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/favicon-96x96.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/favicon-16x16.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('../resources/views/favicon.ico/android-icon-192x192.png')}}"
      type="image/x-icon">
    <link rel="manifest" href="../favicon.ico/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../favicon.ico/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>Punkt erstellen</title>

  </head>
  <div class="row">
    <div class="col-sm-8 offset-sm-2">
      <h1 class="display-3">Punkt hinzufügen</h1>
      <div>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div><br />
        @endif
        <form method="post" enctype="multipart/form-data" action="{{ route('points.store') }}">
          @csrf
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" />
          </div>

          <div class="form-group">
            <label for="text">Text:</label>
            <input type="text" class="form-control" name="text" value="{{ old('text') }}" />
          </div>

          <div class="form-group">
            <label for="QRnumber">Punkte:</label>
            <input type="text" class="form-control" name="QRnumber" value="{{ old('QRnumber') }}" />
          </div>
          <div class="form-group">
            <label for="longitude">longitude:</label>
            <input type="text" class="form-control" name="longitude" id="longitude_input"
              value="{{ old('longitude') }}" />
          </div>
          <div class="form-group">
            <label for="latitude">latitude:</label>
            <input type="text" class="form-control" name="latitude" id="latitude_input" value="{{ old('latitude') }}" />
          </div>
          <div class="form-group">
            <label for="photo_upload">Foto</label>
            <input type="file" class="form-control-file" name="photo" id="photo_upload">
          </div>
          <button type="submit" class="btn btn-primary">Punkt hinzufügen</button>
        </form>
      </div>
    </div>
  </div>

  <div class="row">

    <div class="col-sm-8 offset-sm-2">
      <h2>Klicke auf einen Punkt auf der Karte, um die Koordinaten auszuwählen.</h2>
      <div id="mapid" style="height: 480px;"></div>
      <script>
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(geoSuccess);
        } else {
          alert("Geolocation is not supported by this browser.");
        }

        function geoSuccess(position) {
          var lat = position.coords.latitude;
        var lng = position.coords.longitude;
          var mymap = L.map('mapid').setView([lat, lng], 13);
          L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={token}', {
            maxZoom: 15,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            token: 'pk.eyJ1IjoiYmFjaGVsb3JhcmJlb3QiLCJhIjoiY2tkOHB1eHFvMmUwMTJ0bnRnMHpoNmVpMyJ9.xQedn9fGEL6Can_Od4Ef-Q'
          }).addTo(mymap);

          mymap.on('click', function (e) {
            document.getElementById("longitude_input").value = e.latlng.lng;
            document.getElementById("latitude_input").value = e.latlng.lat;
          });
        }
      </script>
    </div>
  </div>
</body>

</html>