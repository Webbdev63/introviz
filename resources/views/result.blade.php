@include('front.header');


<section class="support">
        <div class="container">
                <div class="row">
                     <div class="effort">
                        <table class="alliance">
                               <tr>
                                 <th colspan="2">Your Selected Fields</th>
                                </tr>
                                <tr>
                                  <td class="hardest">Search Type</td>
                                  <td class="fields">CENSUS</td>
                                </tr>
                                <tr>
                                 <td class="without">Filter Type</td>
                                 <td  class="passion">5</td>
                                </tr>
                                <tr>
                                  <td class="hardest">Applied Filter</td>
                                  <td  class="fields">12</td>
                                </tr>
                        </table>
                    </div>  
              </div>
        </div>
</section>
<section class="applied">
    <div class="container">
          <div class="row">
                <div class="co-xl-6 col-lg-6 col-md-6 col-12">
                      <div class="recurthing">
                            <p>Total Available Records</p>
                      </div>
                </div>
                <div class="co-xl-6 col-lg-6 col-md-6 col-12">
                  <div class="recurthing">
                        <p>{{ $count }} Records</p>
                  </div>
            </div>
          </div>
    </div>
</section>
<section class="records">
        <div class="container">
              <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-6 col-12">
                          <div class="absences">
                                <h5>Create Your Order:</h5>
                          </div>
                          <div class="outside">
                            <ul class="list-group">
                              <li class="list-group-item box">Order Quantity:</li>
                              <li class="list-group-item layout"><input type="text" class="form-control" id="order_quantity" value="{{ $count }}" placeholder="Enter order quantity" name="order_quantity"></li>
                            </ul>
                          </div>
                          <div class="view">
                            <input type="email" class="form-control" id="Enter file name" placeholder="Enter file name" name="Enter file name">
                          </div>
                          <div class="explicit">
                            <button type="button" class="btn btn-secondary">SaveCount  <img src="/front/image/grocery-store.png" class="img-fluid"></button>
                          </div>
                          <div class="empolyee d-flex">
                                <p>Total Cost: </p>
                                <div class="were">
                                    <p>$425.00</p>
                                </div>
                          </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                          <div class="start">
                                <img src="/front/image/ifjefe.png">
                          </div>
                          <div class="mind">
                            <button type="button" class="btn btn"><a href="#">place order<img src="/front/image/touch.png" class="img-fluid"></a></button>
                          </div>
                    </div>
              </div>
        </div>
</section>


@include('front.footer');
