@include('front.header')

<section class="yourself">
    <div class="container-fluid">
        <div class="row">
 
            <div class="col-sm-12 form_data">

                <form>

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
                                                    {{ $states == $state->state_code ? 'selected' : '' }}>
                                                    {{ $state->state }}</option>
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
                                <input type="hidden" name="saveRunCount" id="saveRunCount" value="no">
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

                                <script type="text/javascript">
                                    $(document).ready(function() {

                                        $('#state').on('change', function() {
                                            var state_code = this.value;

                                            localStorage.removeItem('city');
                                            $('#city').html('');
                                            $.ajax({
                                                url: '{{ route('getCities') }}',
                                                type: 'POST',
                                                data: {
                                                    state_code: state_code,
                                                    _token: '{{ csrf_token() }}'
                                                },
                                                success: function(result) {
                                                    var a = JSON.stringify(result)
                                                    localStorage.setItem('city', a);
                                                    getCities(result);
                                                }
                                            });
                                        });
                                    });

                                    function getCities(result) {
                                        $('#city').html('<option value="">Select City</option>');
                                        $.each(result, function(key, value) {

                                            var opt_value = value.id + '-' + value.city + '-' + value.state_code;
                                            $('#city').append('<option value="' + opt_value +
                                                '"  {{ $states == $state->state_code ? 'selected' : '' }}  >' + value.city + '</option>');
                                        });

                                    }
                                </script>
                                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                                    <div class="absences">

                                        <label for="sel1" class="form-label">Zip Code</label>
                                        <input class="form-input" name="zip_code" id="zip_code">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
         
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="network">
                            <button type="submit" class="btn btn">Submit</button>
                        </div>
                    </div>
                   </form>
            </div>
        </div>
    </div>
    </div>
</section>




@include('front.footer');
