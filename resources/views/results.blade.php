@include('front.header');
<style>
    #elementToHide {
        display: none;
        color: red
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
                <form method="POST" id="CensusForm">
                    @csrf
                    <div class="absences">
                        <h5>Create Your Order:</h5>
                    </div>

                    @php
                    if ($count <= 100) { @endphp <div class="outside">
                        <ul class="list-group">
                            <li class="list-group-item box">Order Quantity:<button data-toggle="tooltip" data-bs-original-title="*You can save minimum 100 records" class="btn btn-secondary tooltip_cst">?</button></li>

                            <li class="list-group-item layout">
                                <input type="text" class="form-control" id="order_quantity" value="{{$count}}" placeholder="Enter order quantity" name="order_quantity" readonly>
                                <input type="hidden" class="form-control" id="order_count" value="{{$count}}" placeholder="Enter order quantity" name="old_order_quantity">
                            </li>
                        </ul>
            </div>
            @php
            } else {
            @endphp
            <div class="outside">
                <ul class="list-group">

                    <li class="list-group-item box">Order Quantity:<button data-toggle="tooltip" data-bs-original-title="*You can save minimum 100 records" class="btn btn-secondary tooltip_cst">?</button></li>
                    <li class="list-group-item layout">
                        <input type="text" onchange="updateRowCount()" class="form-control" id="order_quantity" value="{{ $count }}" placeholder="Enter order quantity" name="order_quantity">
                        <input type="hidden" class="form-control" id="order_count" value="{{ $count }}" placeholder="Enter order quantity" name="old_order_quantity" min="100" max="{{ $count }}">
                    </li>
                </ul>
            </div>
            @php
            }
            @endphp
            <div class="view">
                <input type="text" required class="form-control" placeholder="Enter file name" id="fileName123" name="fileName">
            </div>
            <p id="elementToHide"> Please Enter name</p>
            <input type="hidden" id="totalPrice" value="{{ number_format($count * 0.1, 2) }}" name="totalPrice">
            <input type="hidden" name="saveRunCount" value="YES">
            <div class="explicit">
                <button type="button" id="save-button" class="btn btn-secondary" onclick="submitCensusForm()">SaveCount <img src="/front/image/grocery-store.png" class="img-fluid"></button>
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

                <form method="POST" action="{{ route('processPayment') }}">
                    @csrf
                    <input type="hidden" id="orderId" name="orderId">
                    <input type="hidden" id="orderPrice" name="orderPrice">
                    <input type="hidden" id="orderQuantity" name="orderQuantity">
                    <input type="hidden" id="customer_id" name="customer_id">

                    <button type="submit" class="btn ">place order </button>
                </form>
            </div>
        </div>

    </div>
</section>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function submitCensusForm() {
        debugger

        var formData = new FormData(document.getElementById("CensusForm"))
        var fillInput = document.getElementById("fileName123").value;
        //var inputbox =  fillInput.value;
        if (fillInput == '') {
            document.getElementById('elementToHide').style.display = "block";
            return;
        } else {
            document.getElementById('elementToHide').style.display = "none";
        }

        $.ajax({
            url: "/search", // Replace with your backend script URL
            type: "POST",
            data: formData,

            processData: false,
            contentType: false,

            success: function(response) {
                if (response.message == 'success') {
                    var savedData = response.data
                    console.log(savedData)

                    document.getElementById('orderId').value = savedData.id
                    document.getElementById('orderPrice').value = savedData.orderPrice
                    document.getElementById('orderQuantity').value = savedData.orderQuantity
                    document.getElementById('customer_id').value = savedData.user_id
                    localStorage.setItem('savedData', JSON.stringify(savedData));


                    document.getElementById('save-button').style.visibility = 'hidden';
                    document.getElementById('fileName123').readOnly = true;
                    document.getElementById('order_quantity').readOnly = true;
                    fileName123
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Form submitted successfully!.Please proccess with Payment',
                    });
                }

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

        //debugger
        var updateCount = document.getElementById('order_quantity').value
        var oldCount = document.getElementById('order_count').value
        var order_price = document.getElementById('order_count_price').innerHTML
        var minQuantity = 100;
        updateCount = parseInt(updateCount)
        oldCount = parseInt(oldCount)



        if (updateCount <= oldCount) {
            if (updateCount < minQuantity) {
                 document.getElementById('order_quantity').value = minQuantity;
                updateCount=minQuantity;

            }
            var price = updateCount * 0.10;
            document.getElementById('order_count_price').innerHTML = '$ ' + price.toFixed(2);
            document.getElementById('totalPrice').value = price.toFixed(2);
            document.getElementById('records').innerHTML = oldCount + ' Records';

        } else {

            document.getElementById('order_quantity').value = oldCount;
            var price = oldCount * 0.10;
            document.getElementById('order_count_price').innerHTML = '$ ' + price.toFixed(2);
            document.getElementById('totalPrice').value = price.toFixed(2);
            document.getElementById('records').innerHTML = oldCount + ' Records';
        }


    }


    $(function() {
        /*var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
	    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		    return new bootstrap.Tooltip(tooltipTriggerEl);
	    });
	    */
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>

@include('front.footer');
