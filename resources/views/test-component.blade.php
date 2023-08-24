<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <!--   Core JS Files   -->

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script type='text/javascript'
        src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap&key=AlUje-BfB7q-XcFYespJdjtmZY9wrhc1ismON5fsYXgvCUfb2hzSfiEN8UwdqqJ9'
        async defer></script>
    <script>
        var map;

        function getAddressFromLatLng(latitude, longitude) {
            // Make a request to the Mapbox Geocoding API to get the address
            fetch(
                    `https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=pk.eyJ1IjoibXJqcmZzMjIiLCJhIjoiY2xsOGNyZTkxMDNjZjNjbWE1M3J2cHFscyJ9.CsbC7todtywY-2ZMFYaQAg`
                )
                .then(response => response.json())
                .then(datas => {
					// get kecamatan
					console.log(datas);
                    const neighborhoodFeatures = datas.features.filter(feature => feature.place_type.includes(
                        'neighborhood'));
                    const neighborhoodId = neighborhoodFeatures[0].id;
                    const neighborhoodFeature = datas.features.find(feature => feature.id === neighborhoodId);
                    const neighborhoodData = neighborhoodFeature.place_name;

                    var kelurahan = document.getElementById("kelurahan")
                    let getKelurahan;
                    getKelurahan = neighborhoodData.split(',')[0];
                    // // console.log(datas.features.length);
                    // if (datas.features.length == 6) {
                    //     getKelurahan = datas.features[2].place_name.split(',')[0];

                    // } else {
                    //     getKelurahan = datas.features[1].place_name.split(',')[0];
                    // }

                    // // Cek
                    // $.ajax({
                    //     url: `/cek-lokasi`,
                    //     type: 'POST',
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     },
                    //     data: {
                    //         nama_kelurahan: getKelurahan
                    //     },
                    //     dataType: 'json',
                    //     success: function(response) {
                    //         // console.log(response)
                    //         if (response.exist) {
                    //             $('#kelurahan-exist').html('Nama kelurahan sudah ada')
                    //             //    console.log('exists')
                    //         }
                    //     },
                    //     error: function(e) {
                    //         console.log(e)
                    //         alert('An error occurred while checking the username');
                    //     }
                    // });

                    kelurahan.innerHTML = getKelurahan
                    // Log the address to the console
                })
                .catch(error => {
                    console.error(error);
                });
            // return data;
        }

        function GetMap() {
            map = new Microsoft.Maps.Map('#myMap', {
                credentials: 'AlUje-BfB7q-XcFYespJdjtmZY9wrhc1ismON5fsYXgvCUfb2hzSfiEN8UwdqqJ9'
            });

            Microsoft.Maps.Events.addHandler(map, 'click', function(e) {
                var location = e.location;
                var latitude = location.latitude;
                var longitude = location.longitude;
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
                getAddressFromLatLng(latitude, longitude);
            });
        }
    </script>

</head>

<body>
    <div id="myMap" style="width: 500px; height: 400px;"></div>
    <br>
    <label for="latitude">Latitude:</label>
    <input type="text" id="latitude" readonly>
    <br>
    <label for="longitude">Longitude:</label>
    <input type="text" id="longitude" readonly>
    <h1 id="kelurahan"></h1>
    <p id="kelurahan-exist"></p>
</body>

</html>
