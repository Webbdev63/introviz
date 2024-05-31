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
                  
                  <label for="sel1" class="form-label">Search by State</label>
          
                  <select class="form-select" id="state" name="state">
                    <option>Select State</option>
                    @foreach($states as $state)
                  <option value="{{ $state->state_code }}">{{ $state->state }}</option>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
   
    <script type="text/javascript">
        $(document).ready(function () {
            $('#state').on('change', function () {
                var state_code = this.value;
                //alert(state_id);
                $('#city').html('');
                $.ajax({
                    url: '{{ route("getCities") }}',
                    type: 'POST',
                    data: {
                      state_code: state_code,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (result) {
                        $('#city').html('<option value="">Select City</option>');
                        $.each(result, function (key, value) {
                            $('#city').append('<option value="' + value + '">' + value + '</option>');
                        });
                    }
                });
            });
        });
    </script>
              </div>
        </div>
           <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                  <div class="absences">
                
                  <label for="sel1" class="form-label">Search by Zipcode</label>
                  <input class="form-select" name="Phy_zip" id="Phy_zip">
                
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
                
                  <label for="sel1" class="form-label">Search by Class</label>
                  <select class="form-select" id="cls" name="cls">
                    <option>Select</option>
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
                  <form action="/action_page.php">
                  <label for="sel1" class="form-label">Search by Carship</label>
                  <select class="form-select" id="CARSHIP" name="CARSHIP">
                    <option>Select</option>
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
                  <select class="form-select" id="sel1" name="TOT_PWR">
                    <option>Select Power Units</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                  </select>
                  </div>
            </div>

      </div>
  </div>
</section>
<section class="payroll">
      <div class="container">
          <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                    <div class="units">
                          <h4>Private passenger</h4>
                    </div>
                    <div class="encodhing">
                      <div class="form-check form-check-inline"> 
                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                        <input class="form-check-input" type="radio" name="private_passenger" id="inlineRadio1" value="Yes">
                      </div>
                    <div class="form-check form-check-inline best time">
                      <label class="form-check-label" for="inlineRadio2">No</label>
                      <input class="form-check-input" type="radio" name="private_passenger" id="inlineRadio2" value="No">
                      
                    </div>
                </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                  <div class="indictors ">
                     <h4> Hazmat Indicator</h4>
                  </div>
                  <div class="currency">
                      <div class="encodhing">
                        <div class="form-check form-check-inline"> 
                          <label class="form-check-label" for="inlineRadio1">Yes</label>
                          <input class="form-check-input" type="radio" name="hazmat_indicator" id="inlineRadio1" value="Yes">
                        </div>
                        <div class="form-check form-check-inline  best time">
                        <label class="form-check-label" for="inlineRadio2">No</label>
                        <input class="form-check-input" type="radio" name="hazmat_indicator" id="inlineRadio2" value="No">
                        
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
                           <input class="form-check-input" name="Genfreight" value="x" name type="checkbox" id="inlineCheck">
                          </div>
                        </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                             HOUSEHOLD GOODS
                          </label>
                          <input class="form-check-input" name="Household" value="x" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                         METAL: SHEETS, COILS, ROLLS
                          </label>
                          <input class="form-check-input" type="checkbox"  value="x" name="Metalsheet" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                           MOTOR VEHICLES
                          </label>
                          <input class="form-check-input" name=" Motorveh" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            DRIVEAWAY / TOWAWAY
                          </label>
                          <input class="form-check-input" name="Drivetow" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6  col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                           LOGS, POLES, BEAMS
                          </label>
                          <input class="form-check-input" name="Logpole" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                       <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                          BUILDING MATERIALS
                         </label>
                        <input class="form-check-input" name="Bldgmat" value="x"  type="checkbox" id="inlineCheck">
                       </div>
                     </div>
               </div>
               <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                <div class="finaces">
                   <div class="form-check mb-2 mr-sm-2">
                      <label class="form-check-label" for="inlineFormCheck">
                       MOBILE HOMES
                     </label>
                    <input class="form-check-input" name="MobileHome" value="x"  type="checkbox" id="inlineCheck">
                   </div>
                 </div>
           </div>
           <div class="col-xl-3 col-lg-3 col-md-6 col-12">
            <div class="finaces">
               <div class="form-check mb-2 mr-sm-2">
                  <label class="form-check-label" for="inlineFormCheck">
                MACHINERY, LARGE OBJECTS
                 </label>
                <input class="form-check-input" name="Machlrg" value="x"  type="checkbox" id="inlineCheck">
               </div>
             </div>
       </div> 
     
        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
        <div class="finaces">
           <div class="form-check mb-2 mr-sm-2">
              <label class="form-check-label" for="inlineFormCheck">
                FRESH PRODUCE 
             </label>
            <input class="form-check-input" name="Produce" value="x"  type="checkbox" id="inlineCheck">
           </div>
         </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-12">
          <div class="finaces">
             <div class="form-check mb-2 mr-sm-2">
                <label class="form-check-label" for="inlineFormCheck">
                LIQUIDS/GASES  
               </label>
              <input class="form-check-input" name="Liqgas" value="x"  type="checkbox" id="inlineCheck">
             </div>
           </div>
          </div>
          <div class="col-xl-3 col-lg-3 col-md-6 col-12">
            <div class="finaces">
               <div class="form-check mb-2 mr-sm-2">
                  <label class="form-check-label" for="inlineFormCheck">
              INTERMODAL CONTAINERS      
                 </label>
                <input class="form-check-input" name="Intermodal" value="x"  type="checkbox" id="inlineCheck">
               </div>
             </div>
            </div>
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                          PASSENGERS  
                          </label>
                          <input class="form-check-input" name="Passengers" value="x"  type="checkbox" id="inlineCheck">
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
                          <input class="form-check-input" name="Oilfield" value="x"  type="checkbox" id="inlineCheck">
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
                          <input class="form-check-input" name="Livestock" value="x"  type="checkbox" id="inlineCheck">
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
                          <input class="form-check-input" name="Grainfeed" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                       COAL/COKE  
                          </label>
                          <input class="form-check-input" name="Coalcoke" value="x"  type="checkbox" id="inlineCheck">
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
                          <input class="form-check-input" name="Meat" value="x"  type="checkbox" id="inlineCheck">
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
                          <input class="form-check-input" name="Garbage"  value="x" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                           U.S. MAIL  
                          </label>
                          <input class="form-check-input" name="Usmail" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                        CHEMICALS    
                          </label>
                          <input class="form-check-input" name="Chem" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                       COMMODITIES DRY BULK   
                          </label>
                          <input class="form-check-input" name="Drybulk" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                REFRIGERATED FOOD            
                          </label>
                          <input class="form-check-input" name="Coldfood" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                         BEVERAGES   
                          </label>
                          <input class="form-check-input" name="Beverages" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                        PAPER PRODUCTS    
                          </label>
                          <input class="form-check-input" name="Paperprod"  value="x" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                       UTILITY     
                          </label>
                          <input class="form-check-input" name="Utility"  value="x" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                         FARM SUPPLIES   
                          </label>
                          <input class="form-check-input" name="Farmsupp" value="x" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                        CONSTRUCTION    
                          </label>
                          <input class="form-check-input" name="Construct" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            WATER-WELL
                          </label>
                          <input class="form-check-input" name="Waterwell" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                      OTHER      
                          </label>
                          <input class="form-check-input" name="Cargoother" value="x"  type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div>



                  <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                          <div class="network">
                            <button type="submit" class="btn btn" >Submit</button>
                          </div>
                  </div> 
          </div>
     </div> 
</section>
      </form>


@include('front.footer');


