@include('front.header')
<style>
    .range_container {
        display: flex;
        flex-direction: column;
        width: 80%;
        margin: 35% auto;
    }

    .sliders_control {
        position: relative;
        min-height: 15px;
    }

    .form_control {
        position: relative;
        display: flex;
        justify-content: space-between;
        font-size: 24px;
        color: #635a5a;
    }

    input[type=range]::-webkit-slider-thumb {
        -webkit-appearance: none;
        pointer-events: all;
        width: 24px;
        height: 24px;
        background-color: #0060aa;
        border-radius: 50%;
        box-shadow: 0 0 0 1px #C6C6C6;
        cursor: pointer;
    }

    input[type=range]::-moz-range-thumb {
        -webkit-appearance: none;
        pointer-events: all;
        width: 24px;
        height: 24px;
        background-color: #0060aa;
        border-radius: 50%;
        box-shadow: 0 0 0 1px #C6C6C6;
        cursor: pointer;
    }

    input[type=range]::-webkit-slider-thumb:hover {
        background: #0060aa;
    }

    input[type=range]::-webkit-slider-thumb:active {
        box-shadow: inset 0 0 3px #387bbe, 0 0 9px #387bbe;
        -webkit-box-shadow: inset 0 0 3px #387bbe, 0 0 9px #387bbe;
    }

    input[type="range"] {
        -webkit-appearance: none;
        appearance: none;
        height: 10px;
        width: 100%;
        position: absolute;
        background-color: #0060aa;
        pointer-events: none;
    }

    #fromSlider {
        height: 0;
        z-index: 1;
        top: 5px;
    }

    .form_data {
	padding: 0px 30px;
}


@media screen and (max-width: 1400px) {
  .finaces .form-check-label {
    font-size: 14px !important;
  }
  .finaces #inlineCheck {
    font-size: 19px !important;
    margin: 3px auto !important;
  }
  .form-label {
    display: block !important;
  }
}
</style>



<section class="yourself">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12 form_data">
            <form method="POST" action="{{ route('search') }}">
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

        var state_code = localStorage.getItem('state_code');


        if (state_code != '') {
            cities(state_code)
        }


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

        $('#Phy_zip').html(''); // Clear previous options
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
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                <input class="form-check-input" type="radio" name="Private_passenger"
                                    id="inlineRadio1" value="Yes">
                            </div>
                            <div class="form-check form-check-inline best time">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                                <input class="form-check-input" type="radio" name="Private_passenger"
                                    id="inlineRadio2" value="No">

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
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                <input class="form-check-input" type="radio" name="Hazmat_indicator"
                                    id="inlineRadio1" value="Y">
                            </div>
                            <div class="form-check form-check-inline  best time">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                                <input class="form-check-input" type="radio" name="Hazmat_indicator"
                                    id="inlineRadio2" value="N">

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
                            <label class="form-check-label" for="inlineFormCheck">
                                GENERAL FREIGHT
                            </label>
                            <input class="form-check-input" name="Genfreight" value="x" name type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                HOUSEHOLD GOODS
                            </label>
                            <input class="form-check-input" name="Household" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                METAL: SHEETS, COILS, ROLLS
                            </label>
                            <input class="form-check-input" type="checkbox" value="x" name="Metalsheet"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                MOTOR VEHICLES
                            </label>
                            <input class="form-check-input" name=" Motorveh" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                DRIVEAWAY / TOWAWAY
                            </label>
                            <input class="form-check-input" name="Drivetow" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                LOGS, POLES, BEAMS
                            </label>
                            <input class="form-check-input" name="Logpole" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                BUILDING MATERIALS
                            </label>
                            <input class="form-check-input" name="Bldgmat" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                MOBILE HOMES
                            </label>
                            <input class="form-check-input" name="MobileHome" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                MACHINERY, LARGE OBJECTS
                            </label>
                            <input class="form-check-input" name="Machlrg" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                FRESH PRODUCE
                            </label>
                            <input class="form-check-input" name="Produce" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                LIQUIDS/GASES
                            </label>
                            <input class="form-check-input" name="Liqgas" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                INTERMODAL CONTAINERS
                            </label>
                            <input class="form-check-input" name="Intermodal" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                PASSENGERS
                            </label>
                            <input class="form-check-input" name="Passengers" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="withoutfddgfd">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="inlineFormCheck">
                                    OILFIELD EQUIPMENT
                                </label>
                                <input class="form-check-input" name="Oilfield" value="x" type="checkbox"
                                    id="inlineCheck">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="withoutggg">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="inlineFormCheck">
                                    LIVESTOCK
                                </label>
                                <input class="form-check-input" name="Livestock" value="x" type="checkbox"
                                    id="inlineCheck">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                GARBAGE, REFUSE, TRASH
                            </label>
                            <input class="form-check-input" name="Grainfeed" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                COAL/COKE
                            </label>
                            <input class="form-check-input" name="Coalcoke" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="better">
                            <div class="form-check mb-2 mr-sm-2">
                                <label class="form-check-label" for="inlineFormCheck">
                                    MEAT
                                </label>
                                <input class="form-check-input" name="Meat" value="x" type="checkbox"
                                    id="inlineCheck">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                GARBAGE, REFUSE, TRASH
                            </label>
                            <input class="form-check-input" name="Garbage" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                U.S. MAIL
                            </label>
                            <input class="form-check-input" name="Usmail" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                CHEMICALS
                            </label>
                            <input class="form-check-input" name="Chem" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                COMMODITIES DRY BULK
                            </label>
                            <input class="form-check-input" name="Drybulk" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                REFRIGERATED FOOD
                            </label>
                            <input class="form-check-input" name="Coldfood" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                BEVERAGES
                            </label>
                            <input class="form-check-input" name="Beverages" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                PAPER PRODUCTS
                            </label>
                            <input class="form-check-input" name="Paperprod" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                UTILITY
                            </label>
                            <input class="form-check-input" name="Utility" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                FARM SUPPLIES
                            </label>
                            <input class="form-check-input" name="Farmsupp" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                CONSTRUCTION
                            </label>
                            <input class="form-check-input" name="Construct" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                WATER-WELL
                            </label>
                            <input class="form-check-input" name="Waterwell" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                OTHER
                            </label>
                            <input class="form-check-input" name="Cargoother" value="x" type="checkbox"
                                id="inlineCheck">
                        </div>
                    </div>
                </div>
                <div class="census">
                <div class="form-check mb-2 mr-sm-2">
                            <label class="form-check-label" for="inlineFormCheck">
                                Do you want to incluide the insurance data in the census ?
                            </label>
                            <input class="form-check-input" name="Cargoother" value="x" type="checkbox"
                                id="inlineCheck">
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
