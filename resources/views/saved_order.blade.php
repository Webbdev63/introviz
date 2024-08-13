@include('front.header')
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
                        {{-- 
                        <th>Order id</th>
                        --}}
                        <th>Download Source</th>
                     </tr>
                  </thead>
                  <tbody>
                     {{-- @foreach($savedData as $i=>$data) --}}
                    
                     <tr>
                        <td>{{$savedData->id}}</td>
                        <td>{{$savedData->fileName}}</td>
                        <td>{{$savedData->orderQuantity}}</td>
                        <td>$ {{ $savedData->orderPrice}}</td>
                        {{-- 
                        <td>{{$data->id}}</td>
                        --}}
                        <!-- <td><a href="{{ route('exportToExcel', ['id' => $savedData->id]) }}" class="btn btn">Download</button></td> -->
                        
                           <td>
                           <form id="downloadForm" action="{{ route('exportToExcel', ['id' => $savedData->id]) }}" method="GET">
                           <button type="submit" class="btn btn-download" id="downloadButton">
                           Download
                           <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                           </button>
                           </form>
                           <div id="loader" class="d-none">
                           <div class="spinner-border" role="status">
                           <span class="visually-hidden">Loading...</span>
                           </div>
                           </div>
                           </td>
                        <input type="hidden" name="filename" id="filename" value="{{$savedData->fileName}}">
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</section>
@include('front.footer')
<script>
//    $('#downloadButton').on('click', function (e) {
//     e.preventDefault(); // Prevent default form submission

//     var $button = $(this);
//     var $spinner = $button.find('.spinner-border');

//     // Show the loader
//     $('#loader').removeClass('d-none');

//     // Submit the form
//     $('#downloadForm').submit();

//     // Optionally, hide the loader after a timeout if you expect the download to start
//     setTimeout(function() {
//         $('#loader').addClass('d-none');
//     }, 10000); // Adjust timeout as needed
// });


document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('downloadForm');
    const downloadButton = document.getElementById('downloadButton');
    const loader = document.getElementById('loader');
    const fileName = $('#filename').val();
    
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        // Show the loader and disable the button
        downloadButton.querySelector('.spinner-border').classList.remove('d-none');
        downloadButton.setAttribute('disabled', 'true');
        
        // Perform the AJAX request
        fetch(form.action, {
            method: 'GET'
        })
        .then(response => response.blob())
        .then(blob => {
            // Create a link to download the file
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
           // a.download = $savedData->fileName '.xlsx'; // Change the filename if necessary
           a.download = fileName + '.xlsx';
            document.body.appendChild(a);
            a.click();
            a.remove();
            
            // Hide the loader and enable the button
            downloadButton.querySelector('.spinner-border').classList.add('d-none');
            downloadButton.removeAttribute('disabled');
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Hide the loader and enable the button in case of error
            downloadButton.querySelector('.spinner-border').classList.add('d-none');
            downloadButton.removeAttribute('disabled');
        });
    });
});


  </script>
