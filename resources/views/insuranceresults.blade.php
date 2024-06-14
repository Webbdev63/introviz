@include('front.header');
<style>
    #elementToHide {
        display: none;
        color: red
    }

    .saverecord {
            background-color: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
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
                        <td class="fields">{{ $viewName }}</td>
                    </tr>
                    <tr>
                        <td class="without">Filter Type</td>
                        <td class="passion">{{ $filter }}</td>
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
          
                <form method="POST" {{-- action="{{ route('search') }}" --}} id="CensusForm">
                    @csrf
                    <div class="absences">
                        <h5>Create Your Order:</h5>
                    </div>
                    <p class="saverecord">*You can save minimum 100 records</p>
                    @php
                        if ($count <= 100) {
                        @endphp
                            <div class="outside">
                                <ul class="list-group">
                                    <li class="list-group-item box">Order Quantity:</li>
                                    <li class="list-group-item layout">
                                        <input type="text" class="form-control" id="order_quantity"
                                            value="{{ $count }}" placeholder="Enter order quantity" name="order_quantity" readonly>
                                        <input type="hidden" class="form-control" id="order_count" value="{{ $count }}"
                                            placeholder="Enter order quantity" name="old_order_quantity">
                                    </li>
                                </ul>
                            </div>
                        @php
                        } else {
                        @endphp
                        <span class="tooltip">?
                        <span class="tooltiptext">*You can save minimum 100 records</span>
                        </span>
                            <div class="outside">
                                <ul class="list-group">
                                    <li class="list-group-item box">Order Quantity:</li>
                                    <li class="list-group-item layout">
                                        <input type="text" onkeyup="updateRowCount()" class="form-control" id="order_quantity"
                                            value="{{ $count }}" placeholder="Enter order quantity" name="order_quantity">
                                        <input type="hidden" class="form-control" id="order_count" value="{{ $count }}"
                                            placeholder="Enter order quantity" name="old_order_quantity"  min="100" max="{{ $count }}">
                                    </li>
                                </ul>
                            </div>
                        @php
                        }
                        @endphp

                      
                    <div class="view">
                        <input type="text" required class="form-control"
                            placeholder="Enter file name" id="fileName123" name="fileName">
                    </div>
                    <p id="elementToHide"> Please Enter name</p>
                    <input type="hidden" id="totalPrice" value="{{ number_format($count * 0.1, 2) }}"
                        name="totalPrice">
                    <input type="hidden" name="saveRunCount" value="YES">
                    <div class="explicit">
                        <button type="button" id="save-button" class="btn btn-secondary"
                            onclick="submitCensusForm()">SaveCount <img
                                src="/front/image/grocery-store.png" class="img-fluid"></button>
                    </div>

                </form>


                <div class="empolyee d-flex">
                    <p>Total Cost: </p>
                    <div class="were">
                        <p id="order_count_price">$ {{ number_format($count * 0.1, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                <div class="start">
                    <img src="/front/image/ifjefe.png">
                </div>
                <div class="mind">


                    {{-- <form method="POST" action="{{ route('search') }}">
                        @csrf
                        @foreach (request()->all() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                       @endforeach
          
          
                        <input type="hidden" name="exportToExcel" id="" value="yes">
                        <button type="submit">place order</button>
                    </form> --}}

                    <a href="{{ route('checkoutpage') }}" class="btn btn">place order<img
                            src="/front/image/touch.png" class="img-fluid"></a>
                </div>
            </div>

        </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function submitCensusForm() {

     
        var formData = new FormData(document.getElementById("CensusForm"));
        var fillInput = document.getElementById("fileName123").value;
        //var inputbox =  fillInput.value;
        if (fillInput == '') {
            document.getElementById('elementToHide').style.display = "block";
            return;
        }else{
            document.getElementById('elementToHide').style.display = "none";
        }

        $.ajax({
            url: "{{ route('outOfServiceSearch') }}", // Replace with your backend script URL
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                document.getElementById('save-button').style.visibility = 'hidden';
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Form submitted successfully!.Please proccess with Payment',
                });

            },
            error: function(xhr, status, error) {
                // Handle error here
                console.error("Error submitting form:", error);
            }
        });

    }


//     document.addEventListener('DOMContentLoaded', function() {
//     var orderQuantityInput = document.getElementById('order_quantity');
//     var orderCountInput = document.getElementById('order_count');
//     var orderCountPrice = document.getElementById('order_count_price');
//     var totalPriceInput = document.getElementById('totalPrice');
//     var recordsSpan = document.getElementById('records');

//     function updateRowCount() {
//         var updateCount = parseInt(orderQuantityInput.value);
//         var oldCount = parseInt(orderCountInput.value);

//         if (isNaN(updateCount) || updateCount < 100) {
//             alert('Please enter a value of at least 100.');
//           orderQuantityInput.value = 100;
//           var updateCount = parseInt(orderQuantityInput.value);

//           var price = updateCount * 0.10;
//         orderCountPrice.innerHTML = '$ ' + price.toFixed(2);
//         totalPriceInput.value = price.toFixed(2);
//         recordsSpan.innerHTML = updateCount + ' Records';
          
        
//         }

//         if (updateCount > oldCount) {
//             alert('Please enter a value less than or equal to ' + oldCount);
//             return;
//         }

//         var price = updateCount * 0.10;
//         orderCountPrice.innerHTML = '$ ' + price.toFixed(2);
//         totalPriceInput.value = price.toFixed(2);
//         recordsSpan.innerHTML = updateCount + ' Records';
//     }

//     function enforceMinQuantity() {
//         var count = parseInt(orderQuantityInput.value, 10);

//         if (isNaN(count) || count < 100) {
//             orderQuantityInput.disabled = true;
//         } else {
//             orderQuantityInput.disabled = false;
            
//         }
//     }

//     orderQuantityInput.addEventListener('input', updateRowCount);

//     // Initial check on page load
//     enforceMinQuantity();
// });

                function updateRowCount() {

                var updateCount = document.getElementById('order_quantity').value
                var oldCount = document.getElementById('order_count').value
                var order_price = document.getElementById('order_count_price').innerHTML
                var minQuantity = 100;
                updateCount = parseInt(updateCount)
                oldCount = parseInt(oldCount)

                if (updateCount < minQuantity) {
                            alert('Please enter at least ' + minQuantity + ' records.');
                            return false;
                        }
                if (updateCount <= oldCount) {
                    var price = updateCount * 0.10;
                    document.getElementById('order_count_price').innerHTML = '$ ' + price.toFixed(2);
                    document.getElementById('totalPrice').value = price.toFixed(2);
                    document.getElementById('records').innerHTML = oldCount + ' Records';

                } else {
                    alert('Please Enter less then ' + oldCount)
                }


                }

       


</script>

@include('front.footer');
