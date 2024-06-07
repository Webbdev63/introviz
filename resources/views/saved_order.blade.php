@include('front.header');

<section class="journalistic">
        <div class="container">
                <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                <div class=" orthographic">

                                    <table class="table table-bordered">
                                        <thead>
                                          <tr>
                                            <th>Sr No:</th>
                                            <th>File Name</th>
                                            <th>Number of rows</th>

                                            <th>Order Price</th>
                                            <th>Order id</th>
                                            <th>Download Source</th>

                                          </tr>
                                        </thead>
                                        <tbody>
                                          @foreach($savedData as $i=>$data)

                                          <tr>
                                            <td>{{++$i}}</td>

                                            <td>{{$data->fileName}}</td>
                                            <td>{{$data->orderQuantity}}</td>
                                            <td> {{'¢ '.$data->orderPrice}}</td>
                                            <td>{{$data->id}}</td>

                                            <td><button type="button" class="btn btn">Download</button></td>
                                          </tr>
                                          @endforeach

                                        </tbody>
                                      </table>
                                </div>
                        </div>
                </div>
        </div>
</section>
@include('front.footer');
