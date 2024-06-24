@include('front.header')

<section class="yourself">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12 form_data">
            <form method="POST" action="/search">
    @csrf
    <section class="after">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="absences">

                        <label for="sel1" class="form-label">Search by State</label>

                        <select class="form-select" id="state" name="state">
                            <option value="">Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->state_code }}"
                                    {{ $states == $state->state_code ? 'selected' : '' }}>{{ $state->state }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="absences">
                        <label for="sel1" class="form-label">Search by City</label>
                        <select class="form-select" id="city" name="city">
                            <option value="">Select City</option>
                        </select>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-12 zipcodeshow" style="display: none;">
                    <div class="absences">

                        <label for="sel1" class="form-label">Search by Zipcode</label>
                        <select class="form-select" name="Phy_zip" id="Phy_zip">
                            <option value="">Select Zip</option>
                        </select>

                    </div>


                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-12 zipcodeinput">
                    <div class="absences">

                        <label for="sel1" class="form-label">Search by Zipcode</label>
                        <input class="form-input" name="Phy_zip" id="Phy_zip">

                    </div>


                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script type="text/javascript" >
        $(document).ready(function() {

            $('#state').on('change', function() {
                var state_code = this.value;
                //alert(state_id);
                localStorage.removeItem('city');
                $('#city').html('');
                // $.ajax({
                //     url: '{{ route('getCities') }}',
                //     type: 'POST',
                //     data: {
                //         state_code: state_code,
                //         _token: '{{ csrf_token() }}'
                //     },
                //     success: function(result) {
                //         var a = JSON.stringify(result)
                //         localStorage.setItem('city', a);
                //         getCities(result);
                //     }
                // });
                cities(state_code);
            });
        });

        // var state_code = localStorage.getItem('state_code');


        // if (state_code != '') {
        //     cities(state_code)
        // }


        function cities(state_code) {
            $.ajax({
                url: '{{ route('getCities') }}',
                type: 'POST',
                data: {
                    state_code: state_code,
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {

                    var a = JSON.stringify(result)
                    localStorage.setItem('state_code', state_code);
                    getCities(result);
                }
            });
        }

        function getCities(result) {
            $('#city').html('<option value="">Select City</option>');
            $.each(result, function(key, value) {

                var opt_value = value.id + '-' + value.city + '-' + value.state_code;
                $('#city').append('<option value="' + opt_value +
                    '"  {{ $states == $state->state_code ? 'selected' : '' }}  >' + value.city + '</option>');
            });

        }

        $(document).ready(function() {
            $('#city').on('change', function() {

                var text = this.value;
                $('#Phy_zip').html('');
                var Zipcode = fetchcityData(text);


            });
        });



        async function fetchcityData(text) {
    try {
        var citydata = text.split("-");
        var CityId = citydata[0];
        var CityName = citydata[1];
        var State = citydata[2];

        var apiUrl = `https://www.zipcodeapi.com/rest/q3CGoyPPl4puZfuQnsWhjRow1B8qRepisTOwzWOTES9x1qfNzVPU44CZeKoke6wT/city-zips.json/${CityName}/${State}`;
        var proxyUrl = `https://api.allorigins.win/get?url=${encodeURIComponent(apiUrl)}`;
       // alert(proxyUrl);

        console.log('Requesting URL:', proxyUrl); // Log the request URL

        const response = await fetch(proxyUrl);

        if (!response.ok) {
            console.error('Network response was not ok:', response.statusText);
            throw new Error('Network response was not ok: ' + response.statusText);
        }

        const data = await response.json();

        // Check if the response contains the expected data
        if (!data.contents) {
            console.error('Unexpected response format:', data);
            throw new Error('Unexpected response format');
        }

        const result = JSON.parse(data.contents);

       // $('#Phy_zip').html(''); // Clear previous options
        //$.each(result.zip_codes, function(key, value) {
           // $('#Phy_zip').append('<option value="' + value + '">' + value + '</option>');
       // });

       $('#Phy_zip').html(''); // Clear previous options

// Add a blank option at the beginning
            $('#Phy_zip').append('<option value="">Select Zip Code</option>');

            $.each(result.zip_codes, function(key, value) {
                $('#Phy_zip').append('<option value="' + value + '">' + value + '</option>');
            });
    } catch (error) {
        console.error('Fetch error:', error);
        //alert('There was an error fetching the city data. Please try again later.');
    }
}

    </script>
    <section class="after">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="absences">

                        <label for="sel1" class="form-label">Search by Class</label>
                        <select class="form-select" id="cls" name="cls">
                            <option value="">Select</option>
                            <option value="A">Authorized</option>
                            <option value="B"> Exempt</option>
                            <option value="C">Private Property</option>
                            <option value="D"> Private Passenger Business</option>
                            <option value="E">Private Passenger Non-Business</option>
                            <option Value="F">Migrant</option>
                            <option value="G">U.S. Mail</option>
                            <option value="I">Federal Gov't</option>
                            <option value="J">State Gov't</option>
                            <option value="K">Local Gov't</option>
                            <option value="L">Indian Tribe</option>
                            <!-- <option>Other</option>  -->
                        </select>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="absences">
                        <label for="sel1" class="form-label">Search by Carship</label>
                        <select class="form-select" id="CARSHIP" name="Carship">
                            <option value="">Select</option>
                            <option value="C">Carrier</option>
                            <option value="S">Shipper Only</option>
                            <option value="B">Broker</option>
                            <option value="R">Registrant</option>
                            <option value="F">Freight Forwarder</option>
                            <option value="T">Cargo Tank</option>
                        </select>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="absences">
                        <label for="sel1" class="form-label">Search by Power Units</label>


                    </div>


                    <div class="sliders_control">

                        <input id="fromSlider" type="range" name="TOT_PWR_min" value="1" min="0"
                            max="8" oninput="updateSliderValues()" />



                        <input id="toSlider" type="range" name="TOT_PWR_max" value="2" min="0"
                            max="8" oninput="updateSliderValues()" />

                    </div>
                    <div>
                        <label for="fromSlider">From:</label>
                        <span class="slider_value" id="fromValue">1</span>
                        <label for="toSlider">To:</label>
                        <span class="slider_value" id="toValue">2</span>
                    </div>
                    <input type="hidden" id="TOT_PWR_min" name="TOT_PWR_min" value="1">
                    <input type="hidden" id="TOT_PWR_max" name="TOT_PWR_max" value="2">

                </div>
            </div>
        </div>
    </section>

    <section class="payroll">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 col-12">
                    <div class="units">
                        <h4>Private passenger</h4>
                    </div>
                    <div class="indicators">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="private-passenger-yes">Yes</label>
                                <input class="form-check-input" type="radio" name="Private_passenger"
                                    id="private-passenger-yes" value="Yes">
                            </div>
                            <div class="form-check form-check-inline best time">
                                <label class="form-check-label" for="private-passenger-no">No</label>
                                <input class="form-check-input" type="radio" name="Private_passenger"
                                    id="private-passenger-no" value="No">

                            </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-5 col-md-6 col-12">
                    <div class="indictors ">
                        <h4> Hazmat Indicator</h4>
                    </div>
                    <div class="currency">
                        <div class="encodhing">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label" for="hazmat_indicator_yes">Yes</label>
                                <input class="form-check-input" type="radio" name="Hazmat_indicator"
                                    id="hazmat_indicator_yes" value="Y">
                            </div>
                            <div class="form-check form-check-inline  best time">
                                <label class="form-check-label" for="hazmat_indicator_no">No</label>
                                <input class="form-check-input" type="radio" name="Hazmat_indicator"
                                    id="hazmat_indicator_no" value="N">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tracking">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="carship">
                        <h5>CARGO TRANSPORTED</h5>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Genfreight">
                                    GENERAL FREIGHT
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Genfreight" value="x" name type="checkbox"
                                        id="Genfreight">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Household">
                                    HOUSEHOLD GOODS
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Household" value="x" type="checkbox"
                                        id="Household">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Metalsheet">
                                    METAL: SHEETS, COILS, ROLLS
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" type="checkbox" value="x" name="Metalsheet"
                                        id="Metalsheet">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Motorveh">
                                    MOTOR VEHICLES
                                </label>
                                <div class="synergy">
                                <input class="form-check-input" name=" Motorveh" value="x" type="checkbox"
                                    id="Motorveh">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Drivetow">
                                    DRIVEAWAY / TOWAWAY
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Drivetow" value="x" type="checkbox"
                                        id="Drivetow">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Logpole">
                                    LOGS, POLES, BEAMS
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Logpole" value="x" type="checkbox"
                                        id="Logpole">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Bldgmat">
                                    BUILDING MATERIALS
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Bldgmat" value="x" type="checkbox"
                                        id="Bldgmat">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="MobileHome">
                                    MOBILE HOMES
                                </label>
                                <div class="synergy">
                                <input class="form-check-input" name="MobileHome" value="x" type="checkbox"
                                    id="MobileHome">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Machlrg">
                                    MACHINERY, LARGE OBJECTS
                                </label>
                                <div class="synergy">
                                <input class="form-check-input" name="Machlrg" value="x" type="checkbox"
                                    id="Machlrg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Produce">
                                    FRESH PRODUCE
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Produce" value="x" type="checkbox"
                                        id="Produce">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Liqgas">
                                    LIQUIDS/GASES
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Liqgas" value="x" type="checkbox"
                                        id="Liqgas">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Intermodal">
                                    INTERMODAL CONTAINERS
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Intermodal" value="x" type="checkbox"
                                        id="Intermodal">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Passengers">
                                    PASSENGERS
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Passengers" value="x" type="checkbox"
                                        id="Passengers">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="withoutfddgfd">
                                <div class="form-check mb-2 mr-sm-2">
                                    <label class="form-check-label" for="Oilfield">
                                        OILFIELD EQUIPMENT
                                    </label>
                                    <div class="synergy">
                                        <input class="form-check-input" name="Oilfield" value="x" type="checkbox"
                                            id="Oilfield">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="withoutggg">
                                <div class="form-check mb-2 mr-sm-2">
                                    <label class="form-check-label" for="Livestock">
                                        LIVESTOCK
                                    </label>
                                    <div class="synergy">
                                        <input class="form-check-input" name="Livestock" value="x" type="checkbox"
                                            id="Livestock">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Grainfeed">
                                    GARBAGE, REFUSE, TRASH
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Grainfeed" value="x" type="checkbox"
                                        id="Grainfeed">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Coalcoke">
                                    COAL/COKE
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Coalcoke" value="x" type="checkbox"
                                        id="Coalcoke">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="better">
                                <div class="form-check mb-2 mr-sm-2">
                                    <label class="form-check-label" for="Meat">
                                        MEAT
                                    </label>
                                    <div class="synergy">
                                        <input class="form-check-input" name="Meat" value="x" type="checkbox"
                                            id="Meat">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="Garbage">
                                    GARBAGE, REFUSE, TRASH
                                </label>
                                <div class="synergy">
                                    <input class="form-check-input" name="Garbage" value="x" type="checkbox"
                                        id="Garbage">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Usmail">
                                U.S. MAIL
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Usmail" value="x" type="checkbox"
                                    id="Usmail">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Chem">
                                CHEMICALS
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Chem" value="x" type="checkbox"
                                    id="Chem">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Drybulk">
                                COMMODITIES DRY BULK
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Drybulk" value="x" type="checkbox"
                                    id="Drybulk">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Coldfood">
                                REFRIGERATED FOOD
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Coldfood" value="x" type="checkbox"
                                    id="Coldfood">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Beverages">
                                BEVERAGES
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Beverages" value="x" type="checkbox"
                                    id="Beverages">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Paperprod">
                                PAPER PRODUCTS
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Paperprod" value="x" type="checkbox"
                                    id="Paperprod">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Utility">
                                UTILITY
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Utility" value="x" type="checkbox"
                                    id="Utility">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Farmsupp">
                                FARM SUPPLIES
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Farmsupp" value="x" type="checkbox"
                                    id="Farmsupp">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Construct">
                                CONSTRUCTION
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Construct" value="x" type="checkbox"
                                    id="Construct">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Waterwell">
                                WATER-WELL
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Waterwell" value="x" type="checkbox"
                                    id="Waterwell">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="Cargoother">
                                OTHER
                            </label>
                            <div class="synergy">
                                <input class="form-check-input" name="Cargoother" value="x" type="checkbox"
                                    id="Cargoother">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="census">
                <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                Do you want to include the insurance data in the census ?
                            </label>
                            <input class="form-check-input" name="insurance_data" value="yes" type="checkbox"
                                id="insurance_dataff">
                        </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="network">
                        <button type="submit" class="btn btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" name="saveRunCount" value="NO">
</form>
            </div>
        </div>
    </div>
</section>

<script>
    function updateTextInput(val) {
        document.getElementById('selectRange').innerText = val;
        document.getElementById('selectedRangeTo').value = val;
    }

    function updateSliderValues() {
        const fromSlider = document.getElementById('fromSlider');
        const toSlider = document.getElementById('toSlider');
        const fromValue = parseInt(fromSlider.value);
        const toValue = parseInt(toSlider.value);

        if (fromValue > toValue) {
            fromSlider.value = toValue;
        }

        document.getElementById('fromValue').innerText = fromSlider.value;
        document.getElementById('toValue').innerText = toSlider.value;

        document.getElementById('TOT_PWR_min').value = fromSlider.value;
        document.getElementById('TOT_PWR_max').value = toSlider.value;
    }

    window.onload = function() {
        updateSliderValues();
    }

    $(document).ready(function() {
        $("#city").click(function() {
            $(".zipcodeshow").show();
            $(".zipcodeinput").hide();
        });
    });



</script>

@include('front.footer');
