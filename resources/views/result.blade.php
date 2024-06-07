@include('front.header');
<a href="/">
<button type="button" class=" winner">Back</button>
</a>
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
                        <td class="passion">{{$filter}}</td>
                    </tr>
                    <tr>
                        <td class="hardest">Applied Filter</td>
                        <td class="fields">{{ $countFilters }}</td>
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
                    <p id="records">{{ $count }} Records</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="records">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 col-12">
                <form method="POST" action="{{ route('search') }}">
                    @csrf
                    <div class="absences">
                        <h5>Create Your Order:</h5>
                    </div>
                    <div class="outside">
                        <ul class="list-group">
                            <li class="list-group-item box">Order Quantity:</li>
                            <li class="list-group-item layout">
                                <input type="text" onkeyup="updateRowCount()" class="form-control"
                                    id="order_quantity" value="{{ $count }}" placeholder="Enter order quantity"
                                    name="order_quantity">
                                <input type="hidden" class="form-control" id="order_count" value="{{ $count }}"
                                    placeholder="Enter order quantity" name="old_order_quantity">
                            </li>
                        </ul>
                    </div>
                    <div class="view">
                        <input type="text" required class="form-control" id="Enter file name"
                            placeholder="Enter file name" name="fileName">
                    </div>
                    <input type="hidden" name="saveRunCount" value="YES">
                    <div class="explicit">
                        <button type="submit" class="btn btn-secondary">SaveCount <img
                                src="/front/image/grocery-store.png" class="img-fluid"></button>
                    </div>
                    <input type="hidden" id="totalPrice" value="{{ $count * 0.10; }}" name="totalPrice">
                  </form>


                    <div class="empolyee d-flex">
                        <p>Total Cost: </p>
                        <div class="were">
                            <p id="order_count_price">$ {{ $count * 0.10;}}</p>
                        </div>
                    </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                <div class="start">
                    <img src="/front/image/ifjefe.png">
                </div>
                <div class="mind">
                    <a href="{{route('savedOrder')}}" class="btn btn">place order<img
                            src="/front/image/touch.png" class="img-fluid"></a>
                </div>
            </div>

        </div>
</section>
<script>
    function updateRowCount() {

        var updateCount = document.getElementById('order_quantity').value
        var oldCount = document.getElementById('order_count').value
        var order_price = document.getElementById('order_count_price').innerHTML
        updateCount = parseInt(updateCount)
        oldCount = parseInt(oldCount)
        if (updateCount <= oldCount) {
            var price = updateCount * 0.10;
            document.getElementById('order_count_price').innerHTML = '¢ ' + price.toFixed(2);
            document.getElementById('totalPrice').value =  price.toFixed(2);
            document.getElementById('records').innerHTML = oldCount + ' Records';
            console.log(price);
        } else {
            alert('Please Enter less then ' + oldCount)
        }


    }
</script>

@include('front.footer');
