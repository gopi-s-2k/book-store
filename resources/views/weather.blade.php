<div id="req-location"
     class="card shadow-sm border-0 position-fixed bottom-0 start-0 end-0 m-3"
     style="display:none; z-index:1050;">
    <div class="card-body d-flex justify-content-between align-items-center">
        <span class="fw-bold">
            Get weather for your current location
        </span>

        <button id="getLocationBtn"
                class="btn btn-success">
            Use current location
        </button>
    </div>
</div>

<div id="usr-loc-weather"
     class="card shadow-sm border-0 position-fixed bottom-0 start-0 end-0 m-3"
     style="display:none; z-index:1050;">

    <div class="card-body">

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-4">

            <div class="d-flex align-items-center">
                <img id="usr-loc-icon"
                     src="https://openweathermap.org/img/wn/04d@2x.png"
                     width="64"
                     height="64">

                <div class="ms-3">
                    <h5 id="usr-loc-name" class="mb-0"></h5>
                    <small id="usr-loc-desc"
                           class="text-muted text-capitalize">
                    </small>
                </div>
            </div>

            <div class="text-center">
                <div class="h2 mb-0">
                    <span id="usr-loc-temp"></span>°
                </div>
            </div>

            <div>
                <strong>Feels Like:</strong>
                <span id="usr-loc-feels-like"></span>°
            </div>

            <div>
                <strong>Humidity:</strong>
                <span id="usr-loc-humidity"></span>%
            </div>

            <div>
                <strong>Wind:</strong>
                <span id="usr-loc-wind"></span> m/s
            </div>

            <button id="refreshCurrentWeather"
                    class="btn btn-outline-primary btn-sm">
                Refresh
            </button>

        </div>

    </div>
</div>
<script>
    function startWithCurrentLocaiton(userAction = false) {
        if (!navigator.geolocation) {
            if (userAction) {
                showToast("Geolocation is not supported by your browser.");
            }
            return;
        }
        navigator.geolocation.getCurrentPosition(
            function(position) {
                let lat = position.coords.latitude;
                let lon = position.coords.longitude;
                getWeatherForLatLon(lat, lon);
            },
            function(error) {
                let errMsg = "";
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        errMsg = ("Access denied for location. Allow location access in site-settings");
                        break;
                    case error.POSITION_UNAVAILABLE:
                        errMsg = ("Location information is unavailable.");
                        break;
                    case error.TIMEOUT:
                        errMsg = ("Unable to locate you! timed out.");
                        break;
                    default:
                        errMsg = ("An unknown error occurred.");
                        break;
                }
                $("#req-location").show();
                if (userAction) {
                    showToast(errMsg);
                }
            }, {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }
    $(document).ready(function() {
        $('#getLocationBtn,#refreshCurrentWeather').on('click', function() {
            startWithCurrentLocaiton(true);
        });
        startWithCurrentLocaiton();
    });

    var ajaxLatLon = null;
    function getWeatherForLatLon(lat, lon) {
        if(ajaxLatLon !== null){
            ajaxLatLon.abort();
        }
        ajaxLatLon = $.ajax({
        url: "{{route("weather.latlon")}}",
            type: 'GET',
            data: {
                lat,
                lon
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    processLocaitonResponse(response.data);
                }
            },

            error: function(xhr, status, error) {
                // console.error("AJAX request failed:", status, error);
                let response = xhr.responseJSON;
                showToast(response.message);
            }
        });
    }

    function processLocaitonResponse(locData) {
        $("#usr-loc-name").text(locData.name);
        weather = locData.weather[0];
        $("#usr-loc-icon").attr("src", `https://openweathermap.org/img/wn/${weather.icon}@2x.png`);
        $("#usr-loc-temp").text(locData.main?.temp ?? "--");
        $("#usr-loc-desc").text(weather?.description ?? "---");
        $("#usr-loc-feels-like").text(locData?.main?.feels_like ?? "--");
        $("#usr-loc-humidity").text(locData?.main?.humidity ?? "--");
        $("#usr-loc-wind").text(locData?.wind?.speed ?? "--");
        $("#usr-loc-weather").show();
        $("#req-location").hide();
    }
</script>