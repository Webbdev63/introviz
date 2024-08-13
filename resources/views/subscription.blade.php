@include('front.header')

<section class="table-sec">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="passion">
                     <!--   <h4>Our Packages</h4>  -->
                     </div>
                        
                 <table class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th>Price per records</th>
                            <th>Additional Cost</th>
                             <th class="goal">Monthly subscriptions<br><span class="maximum">Download Maximum 500 records</span></th>
                         </tr>
                     </thead>
                      <tbody>
                        <tr>
                           <td class="recover"><span style="color: #222222">Basic</span><p>Name, DBA, DOT-Number, Address, Telephone</p></td>
                            <td class="checker text-center">$0.12</td>
                             <td class="checker text-center"><img src="front/image/Group 16.png" class="img-fluid"></td>
                     </tr>
                     </tbody>
                    </table>
                 </div>
            </div>     
        </div>
    </section>
    <section class="monthy">
        <div class="container">
            <table>
                <thead>
                  <tr>
                    <th scope="col">Email</th>
                    <td scope="col">$0.05</td>
                    <td class="wish"><img src="front/image/Group 16.png" class="img-fluid"></td>
                    
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th>Insurance records</th>
                    <td>$0.07</td>
                    <td class="wish"><img src="front/image/Group 16.png" class="img-fluid"></td>
                    
                  </tr>
                  <tr>
                    <th>Out of service records</th>
                    <td>$0.05</td>
                    <td class="wish"><img src="front/image/Group 16.png" class="img-fluid"></td>
                  </tr>   
                </tbody>
              </table>
            </div>   
    </section>
    <section class="monthy">
        <div class="container">
            <table>
                <thead>
                  <tr>
                    <th scope="col" class="total">Total Cost Per Count: </th>
                    <td scope="col">$0.05</td>
                    <td class="wish"><img src="front/image/Group 16.png" class="img-fluid"></td>
                    
                  </tr>
                </thead>
                <tbody>  
                </tbody>
              </table>
            </div>   
    </section>
    <section class="performing">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="abillity d-flex">
                        <i class="" aria-hidden="true"></i>
                        <div class="prevently">
                            <p>$250 / Month - Ability to search and view records</p>
                        </div>
                    </div>
                    <div class="abillity d-flex">
                        <i class="" aria-hidden="true"></i>
                        <div class="prevently">
                            <p>
                                You can download a maximum of 500 records every month.
                               </p>
                        </div>
                    </div>
                    <div class="abillity d-flex">
                        <i class="" aria-hidden="true"></i>
                        <div class="prevently">
                            <p>Must subscribe for 3 months minimum</p>
                        </div>
                    </div>
                    <div class="minium ">
                        
                        
                   

                       @auth 
                       <form method="POST" action="{{ route('subscriptioncheckout') }}">
                        @csrf
                        <input type="hidden" id="orderId" name="orderId" value="1">
                        <input type="hidden" id="orderPrice" name="orderPrice" value="750">
                        <input type="hidden" id="orderQuantity" name="orderQuantity" value="10">
                        <input type="hidden" id="customer_id" name="customer_id" value="{{ auth()->check() ? auth()->user()->id : '' }}">

                       <button type="submit" class="btn btn">Place order <i class="" aria-hidden="true"></i>
                       </button>
                       </form>
                @else
                <a href="{{route('register')}}"><button type="button" class="btn btn"> Place order <i class="" aria-hidden="true"></i>
                </button></a>
                
                @endauth 
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- <div class="col-xl-6 col-lg-6 col-md-6 col-12">
            <div class="start">
                <img src="/front/front/image/ifjefe.png">
            </div>
            <div class="mind">

                <form method="POST" action="{{ route('subscriptioncheckout') }}">
                    @csrf
                    <input type="hidden" id="orderId" name="orderId" value="1">
                    <input type="hidden" id="orderPrice" name="orderPrice" value="750">
                    <input type="hidden" id="orderQuantity" name="orderQuantity" value="10">
                    <input type="hidden" id="customer_id" name="customer_id" value="2">

                    <button type="submit" id="placeOrderHide" class="btn">Place order </button>
                </form>
            </div>
        </div> -->

@include('front.footer')