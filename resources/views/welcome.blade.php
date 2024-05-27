@include('front.header');

<section class="yourself">
  <div class="container">
      <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                  <div class="nearly">
                      <p>Find Data Now</p>
                  </div>
            </div>
      </div>
  </div>
</section>
<section class="after">
  <div class="container">
      <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                  <div class="absences">
                  <form action="/action_page.php">
                  <label for="sel1" class="form-label">Search by State</label>
                  <select class="form-select" id="sel1" name="sellist1">
                    <option>Select</option>
                  </select>
                  </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
              <div class="absences">
              <form action="/action_page.php">
              <label for="sel1" class="form-label">Search by City</label>
              <select class="form-select" id="sel1" name="sellist1">
                <option>Select</option>
              </select>
              </div>
        </div>
      </div>
  </div>
</section>
<section class="after">
  <div class="container">
      <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                  <div class="absences">
                  <form action="/action_page.php">
                  <label for="sel1" class="form-label">Search by Zipcode</label>
                  <select class="form-select" id="sel1" name="sellist1">
                    <option>Select</option>
                  </select>
                  </div>
            </div>
      </div>
  </div>
</section>
<section class="after">
  <div class="container">
      <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                  <div class="absences">
                  <form action="/action_page.php">
                  <label for="sel1" class="form-label">Search by Class</label>
                  <select class="form-select" id="sel1" name="sellist1">
                    <option>Select</option>
                    <option>Authorized</option>
                    <option> Exempt</option>
                    <option>Private Property</option>
                    <option> Private Passenger Business</option>
                    <option>Private Passenger Non-Business</option>
                    <option>Migrant</option>
                    <option>U.S. Mail</option>
                    <option>Federal Gov't</option>
                    <option>State Gov't</option>
                    <option>Local Gov't</option>
                    <option>Indian Tribe</option>
                    <option>Other</option>
                  </select>
                  </div>
            </div>
      </div>
  </div>
</section>
<section class="after">
  <div class="container">
      <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                  <div class="absences">
                  <form action="/action_page.php">
                  <label for="sel1" class="form-label">Search by Power Units</label>
                  <select class="form-select" id="sel1" name="sellist1">
                    <option>Select</option>
                    <option> Min and Max (max 8)</option>
                    <option> Min and Max (max 8)</option>
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
<section class="after">
  <div class="container">
      <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                  <div class="absences">
                  <form action="/action_page.php">
                  <label for="sel1" class="form-label">Search by Carship</label>
                  <select class="form-select" id="sel1" name="sellist1">
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
      </div>
  </div>
</section>
<section class="tracking">
      <div class="container">
            <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="carship">
                              <h5>Other Option</h5>
                        </div>
                  </div>
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                       <div class="finaces">
                          <div class="form-check mb-2 mr-sm-2">
                             <label class="form-check-label" for="inlineFormCheck">
                               Genfreight
                            </label>
                           <input class="form-check-input" type="checkbox" id="inlineCheck">
                          </div>
                        </div>
                  </div>
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                              Household
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Metalsheet
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Motorveh
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Drivetow
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Logpole
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                       <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Bldgmat
                         </label>
                        <input class="form-check-input" type="checkbox" id="inlineCheck">
                       </div>
                     </div>
               </div>
               <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                <div class="finaces">
                   <div class="form-check mb-2 mr-sm-2">
                      <label class="form-check-label" for="inlineFormCheck">
                       MobileHome
                     </label>
                    <input class="form-check-input" type="checkbox" id="inlineCheck">
                   </div>
                 </div>
           </div>
           <div class="col-xl-2 col-lg-2 col-md-3 col-12">
            <div class="finaces">
               <div class="form-check mb-2 mr-sm-2">
                  <label class="form-check-label" for="inlineFormCheck">
                  Machlrg
                 </label>
                <input class="form-check-input" type="checkbox" id="inlineCheck">
               </div>
             </div>
       </div> 
        <div class="col-xl-2 col-lg-2 col-md-3 col-12">
        <div class="finaces">
           <div class="form-check mb-2 mr-sm-2">
              <label class="form-check-label" for="inlineFormCheck">
                Produce
             </label>
            <input class="form-check-input" type="checkbox" id="inlineCheck">
           </div>
         </div>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-3 col-12">
          <div class="finaces">
             <div class="form-check mb-2 mr-sm-2">
                <label class="form-check-label" for="inlineFormCheck">
                  Liqgas
               </label>
              <input class="form-check-input" type="checkbox" id="inlineCheck">
             </div>
           </div>
          </div>
          <div class="col-xl-2 col-lg-2 col-md-3 col-12">
            <div class="finaces">
               <div class="form-check mb-2 mr-sm-2">
                  <label class="form-check-label" for="inlineFormCheck">
                    Intermodal
                 </label>
                <input class="form-check-input" type="checkbox" id="inlineCheck">
               </div>
             </div>
            </div>
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Passengers
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="withoutfddgfd">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Oilfield
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                      </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                          <div class="withoutggg">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Livestock
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                      </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Grainfeed
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Coalcoke
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                      <div class="better">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Meat
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Garbage
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Usmail
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Chem
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Drybulk
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Coldfood
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Beverages
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Paperprod
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Utility
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Farmsupp
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Construct
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Waterwell
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div> 
                  <div class="col-xl-2 col-lg-2 col-md-3 col-12">
                    <div class="finaces">
                        <div class="form-check mb-2 mr-sm-2">
                          <label class="form-check-label" for="inlineFormCheck">
                            Cargoother
                          </label>
                          <input class="form-check-input" type="checkbox" id="inlineCheck">
                        </div>
                    </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                          <div class="network">
                            <button type="button" class="btn btn" ><a href="home.html">Submit </a></button>
                          </div>
                  </div> 
          </div>
     </div> 
</section>



@include('front.footer');

