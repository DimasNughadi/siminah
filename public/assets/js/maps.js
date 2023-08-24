var map;

function getAddressFromLatLng(latitude, longitude) {
    // Make a request to the Mapbox Geocoding API to get the address
    fetch(
        `https://api.mapbox.com/geocoding/v5/mapbox.places/${longitude},${latitude}.json?access_token=pk.eyJ1IjoibXJqcmZzMjIiLCJhIjoiY2xsOGNyZTkxMDNjZjNjbWE1M3J2cHFscyJ9.CsbC7todtywY-2ZMFYaQAg`
    )
        .then((response) => response.json())
        .then((datas) => {
            // console.log(datas);
            
            const neighborhoodFeatures = datas.features.filter((feature) =>
                feature.place_type.includes("neighborhood")
            );
            const neighborhoodId = neighborhoodFeatures[0].id;
            const neighborhoodFeature = datas.features.find(
                (feature) => feature.id === neighborhoodId
            );
            const neighborhoodData = neighborhoodFeature.place_name;

            var kelurahan = document.getElementById("nama_kelurahan");
            let getKelurahan;
            getKelurahan = neighborhoodData.split(",")[0];

            // Cek
            $.ajax({
                url: `/cek-lokasi`,
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                data: {
                    nama_kelurahan: getKelurahan,
                },
                dataType: "json",
                success: function (response) {
                    if (response.exist) {
                        $("#kelurahan-exist").html("Nama kelurahan sudah ada");
                        // disable button
                        $("#sumbit-tambah-lokasi").prop("disabled", true);
                    } else {
                        $("#kelurahan-exist").html("");
                        $("#sumbit-tambah-lokasi").prop("disabled", false);
                    }
                },
                error: function (e) {
                    console.log(e);
                    alert("An error occurred while checking the username");
                },
            });

            kelurahan.value = getKelurahan;
            // Log the address to the console
        })
        .catch((error) => {
            console.error(error);
        });
    // return data;
}

function GetMap() {
    map = new Microsoft.Maps.Map("#maps", {
        credentials:
            "AlUje-BfB7q-XcFYespJdjtmZY9wrhc1ismON5fsYXgvCUfb2hzSfiEN8UwdqqJ9",
    });

    Microsoft.Maps.Events.addHandler(map, "click", function (e) {
        var location = e.location;
        var latitude = location.latitude;
        var longitude = location.longitude;
        document.getElementById("latitude").value = latitude;
        document.getElementById("longitude").value = longitude;
        const koordinat = latitude + ', ' + longitude
        document.querySelector('#koordinat').value = koordinat;
        getAddressFromLatLng(latitude, longitude);
    });
}
