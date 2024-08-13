@include('front.header');
<style>
    #payment-form {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        margin: 20px;
    }

    .maindiv {
        display: flex;
        flex-direction: column;
        align-content: center;
        align-items: center;
    }

    #card-button {
        display: block;
        width: 100%;
        background-color: #007bff;
        color: #ffffff;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 10px;
        max-width: 400px
    }

    #card-button:hover {
        background-color: #0056b3;
    }

    #payment-status-container {
        margin-top: 10px;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    #loader {
            display: none; /* Hidden by default */
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
</style>
<div id="loader"></div>
<section class="register">
  <div class="container">
        <div class="row">
            <div class="col-xl-7 col-lg-7 col-md-6 col-12">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                                <div class="awarde">
                                    <h5>Account Information</h5>
                                </div>
                                <div class="ibnherable">
                                    <p>Already have an account</p>
                                </div>
                            </div>
                        </div>
                    </div>
                   <form>
                        <div class="row">
                            <div class="col">
                                <div class="process">
                                    <label for="First Name" class="form-label">First Name<span
                                            class="just">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="FirstName" value="{{ auth()->check() ? auth()->user()->first_name : '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="process">
                                    <label for="Last Name" class="form-label">Last Name<span
                                            class="just">*</span></label>
                                    <input type="Last Name" class="form-control"  name="Last Name" value="{{ auth()->check() ? auth()->user()->last_name : '' }}">
                                </div>
                            </div>
                        </div>
          
                    <div class="already">
                        <div class="mb-3">
                            <label for="Email Addresss" class="form-label">Email Addresss <span
                                    class="just">*</span></label>
                            <input type="Email Addresss" class="form-control" id="Email Addresss" value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                name="Email Addresss">
                        </div>
                    </div>
                    <div class="already">
                        <div class="mb-3">
                            <label for="Phone Number" class="form-label">Phone Number <span
                                    class="just">*</span></label>
                            <input type="Phone Number" class="form-control" id="Phone Number" value="{{ auth()->check() ? auth()->user()->phone_number : '' }}"
                                name="Phone Number">
                        </div>
                    </div>

                    @auth 
                
                @else
                <div class="row">
                            <div class="col">
                                <div class="process">
                                    <label for="State" class="form-label">State<span class="just">*</span></label>
                                    <input type="State" class="form-control" placeholder="" name="State">
                                </div>
                            </div>
                            <div class="col">
                                <div class="process">
                                    <label for="City" class="form-label">City<span class="just">*</span></label>
                                    <input type="City" class="form-control" placeholder="" name="City">
                                </div>
                            </div>

                        </div>
                  
                        <div class="row">
                            <div class="col">
                                <div class="process">
                                    <label for="FirstName" class="form-label">Street Address</Address><span
                                            class="just">*</span></label>
                                    <input type="First Name" class="form-control" placeholder="" name="street_address">
                                </div>
                            </div>
                            <div class="col">
                                <div class="process">
                                    <label for="Last Name" class="form-label">Zipcode<span
                                            class="just">*</span></label>
                                    <input type="Last Name" class="form-control" placeholder="" name="cipcode">
                                </div>
                            </div>

                        </div>
                
                    <div class="street">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="check1" name="option1"
                                value="something" checked>
                            <label class="form-check-label">
                                <p>I have a ready and agree to the website <span class="here">terms and conditions</p>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="adipiscing">
                        <button type="button" class="btn btn">Login</button>
                    </div>
                @endauth
                

                </form>  
                </div>
            </div>
        
            <div class="col-xl-5 col-lg-5 col-md-6 col-12">
                <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
                <script>
                    // const appId = 'sandbox-sq0idb-84nC5pkzDdNoB8vkFG6qsw';
                    // const locationId = 'L6JC61S4HH0SG';
                    const appId =  "{{$appId}}" 
                    const locationId = "{{$locationId}}";

                    async function initializeCard(payments) {
                        const card = await payments.card();
                        await card.attach('#card-container');

                        return card;
                    }

                    async function createPayment(token, verificationToken, orderPrice, customerId, orderId, ) {
                        const body = JSON.stringify({
                            locationId,
                            sourceId: token,
                            verificationToken,
                            orderPrice,
                            customerId,
                            orderId,
                            idempotencyKey: window.crypto.randomUUID(),
                        });

                        // const paymentResponse = await fetch('/subcriptionPayment', {
                        //     method: 'POST',
                        //     headers: {
                        //         'Content-Type': 'application/json',
                        //     },
                        //     body,
                        // });
               
             
                        var ddf = await subcriptionPayment(body);
                        if (paymentResponse.ok) {
                            return paymentResponse.json();
                        }

                        const errorBody = await paymentResponse.text();
                        throw new Error(errorBody);
                    }

                    async function tokenize(paymentMethod) {
                        const tokenResult = await paymentMethod.tokenize();
                        if (tokenResult.status === 'OK') {
                            return tokenResult.token;
                        } else {
                            let errorMessage = `Tokenization failed with status: ${tokenResult.status}`;
                            if (tokenResult.errors) {
                                errorMessage += ` and errors: ${JSON.stringify(
                        tokenResult.errors,
                      )}`;
                            }

                            throw new Error(errorMessage);
                        }
                    }

                    // Required in SCA Mandated Regions: Learn more at https://developer.squareup.com/docs/sca-overview
                    async function verifyBuyer(payments, token) {
                        const verificationDetails = {
                            amount: '1.00',
                            billingContact: {
                                givenName: 'John',
                                familyName: 'Doe',
                                email: 'john.doe@square.example',
                                phone: '3214563987',
                                addressLines: ['123 Main Street', 'Apartment 1'],
                                city: 'London',
                                state: 'LND',
                                countryCode: 'GB',
                            },
                            currencyCode: 'GBP',
                            intent: 'CHARGE',
                        };

                        const verificationResults = await payments.verifyBuyer(
                            token,
                            verificationDetails,
                        );
                        return verificationResults.token;
                    }

                    // status is either SUCCESS or FAILURE;
                    function displayPaymentResults(status) {
                        const statusContainer = document.getElementById(
                            'payment-status-container',
                        );
                        if (status === 'SUCCESS') {
                            statusContainer.classList.remove('is-failure');
                            statusContainer.classList.add('is-success');
                        } else {
                            statusContainer.classList.remove('is-success');
                            statusContainer.classList.add('is-failure');
                        }

                        statusContainer.style.visibility = 'visible';
                    }

                    document.addEventListener('DOMContentLoaded', async function() {
                        if (!window.Square) {
                            throw new Error('Square.js failed to load properly');
                        }

                        let payments;
                        try {
                            payments = window.Square.payments(appId, locationId);
                        } catch {
                            const statusContainer = document.getElementById(
                                'payment-status-container',
                            );
                            statusContainer.className = 'missing-credentials';
                            statusContainer.style.visibility = 'visible';
                            return;
                        }

                        let card;
                        try {
                            card = await initializeCard(payments);
                        } catch (e) {
                            console.error('Initializing Card failed', e);
                            return;
                        }

                        async function handlePaymentMethodSubmission(event, card) {
                            event.preventDefault();

                            try {
                                // disable the submit button as we await tokenization and make a payment request.
                                cardButton.disabled = true;
                                const token = await tokenize(card);
                                const verificationToken = await verifyBuyer(payments, token);
                             
                                var orderPrice1 = {{ $data['orderPrice'] }};
                            //   var  orderPrice1  =parseFloat(orderPrice1);
                              var  orderPrice  =parseFloat(orderPrice1);
                                var orderId = {{ $data['orderId'] }};
                                var customerId = {{ $data['customer_id'] }};
                                const paymentResults = await createPayment(
                                    token,
                                    verificationToken,
                                    orderPrice,
                                    customerId,
                                    orderId,
                                );
                                displayPaymentResults('SUCCESS');

                                console.debug('Payment Success', paymentResults);
                            } catch (e) {
                                cardButton.disabled = false;
                                displayPaymentResults('FAILURE');
                                console.error(e.message);
                            }
                        }

                        const cardButton = document.getElementById('card-button');
                        cardButton.addEventListener('click', async function(event) {
                            await handlePaymentMethodSubmission(event, card);
                        });
                    });
                </script>

                <body>
                    <form id="payment-form">
                        <div id="card-container"></div>
                        @csrf<input type="hidden" name="dfd" id="dfd">

                        <button id="card-button" type="button">Pay ${{ $data['orderPrice'] }}</button>
                    </form>
                    <div id="payment-status-container"></div>
            </div>

        </div>
    </div>  


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script>
        function subcriptionPayment(data) {
            var formData = new FormData(document.getElementById("payment-form"))
            var data1 = JSON.parse(data);
            // formdata.append("file", data1);
         
            formData.append('customerId', data1.customerId);
            formData.append('idempotencyKey', data1.idempotencyKey);
            formData.append('locationId', data1.locationId);
            formData.append('orderId',  data1.orderId);
            formData.append('orderPrice', data1.orderPrice);
            formData.append('sourceId', data1.sourceId);
            formData.append('verificationToken', data1.verificationToken);


            document.getElementById('loader').style.display = 'block';


            //var inputbox =  fillInput.value;


            $.ajax({
                url: "{{ route('subcriptionPayment') }}", // Replace with your backend script URL
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    document.getElementById('loader').style.display = 'none';

                    if (response.message === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            html: 'Payment submitted successfully! Your payment ID is <b>' + response.data.payment_id + '</b>',
                        }).then((result) => {
                            // Perform an action after the Swal message is closed
                            window.location.href = window.location.origin + '/';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            text: response.message || 'Payment submission failed. Please try again later.',
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error here
                    console.error("Error submitting form:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while submitting the form. Please try again later.',
                    });
                }
            });

        }
    </script>
</section>

@include('front.footer');
