@include('front.header');

<section class="yourself">
    <div class="container">
        <div class="row">
            <!--   <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                  <div class="nearly">
                      <p>Find Data Now</p>
                  </div>
            </div>   -->
        </div>
    </div>
</section>
<form method="POST" action="{{ route('search') }}">
    @csrf

    <section class="after">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="absences">

                        <label for="sel1" class="form-label">NAME</label>

                        <input class="form-select" id="LEGAL_NAME" name="LEGAL_NAME">

                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="absences">
                        <label for="sel1" class="form-label">BUSINESS NAME</label>
                          <input class="form-select" id="DBA_NAME" name="DBA_NAME">

                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="absences">

                        <label for="sel1" class="form-label">PHYSICAL ADDRESS</label>
                        <input class="form-select" name="BUS_STREET_PO" id="BUS_STREET_PO">
                    </div>
                </div>
            </div>
        </div>
    </section>

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

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

                <script type="text/javascript">
                    $(document).ready(function() {

                        $('#state').on('change', function() {
                            var state_code = this.value;
                            //alert(state_id);
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
                                  var a=JSON.stringify(result)
                                 localStorage.setItem('city', a);
                                    getCities(result);
                                }
                            });
                        });
                    });

                </script>
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="absences">

                        <label for="sel1" class="form-label">Search by Zipcode</label>
                        <input class="form-select" name="zip_code" id="zip_code">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="after">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="absences">

                        <label for="sel1" class="form-label">Phone number</label>

                        <input class="form-select" id="BUS_TELNO" name="BUS_TELNO">

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



@include('front.footer');
