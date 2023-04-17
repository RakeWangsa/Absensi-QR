@extends('layouts.main')

@section('container')
<div class="pagetitle mt-3">
   <div class="container">
      <div class="row align-items-center">
         <div class="col">
            <h1>QR Code Scanner</h1>
         </div>
      </div>
   </div>
</div>



<div class="row">

   


      <div class="card col-md-12 mt-2 pb-4">
         <div class="card-body">
             {{-- <h5 class="card-title">QR Code Scanner</h5> --}}
             <div class="table-container border">
           
            </div>
         </div>
      </div>
</div>
@endsection




{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>barcode Scanner</title>
    <script src="{{ asset('html5-qrcode.min.js') }}"></script>
</head>

<body>
    <div id="qr-reader" style="width: 100%"></div>

    <form id="myForm" class="mt-3">
    <input type="text" size="50" id="result-input" placeholder="Scan QR Code atau ketikkan code disini"/>
    <button type="submit" class="btn btn-primary" id="submit-button">Submit</button>
    </form>

    <audio id="myAudio">
        <source src="{{ asset('sounds/qrcode.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var x = document.getElementById("myAudio");

        function playAudio() {
            x.play();
        }

        function onScanSuccess(decodedText, decodedResult) {
            scannerResult = decodedText;

            // memperbarui nilai value dari input
            $('#result-input').val(scannerResult);

            if (scannerResult === "999") {
                // mengirimkan formulir secara otomatis jika input adalah "999"
                $('#myForm').submit();
            }

            // melakukan AJAX request jika diperlukan
            $.ajax({
                url: '/post',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    data: scannerResult
                },
                success: function(response) {
                    console.log(response);
                    playAudio();
                    $('#scannerResult').html(response['data']);
                }
            });
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", {
                fps: 10,
                qrbox: {
                    width: 500,
                    height: 500
                },
                rememberLastUsedCamera: true,
                showTorchButtonIfSupported: true
            });

        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>


</html> --}}
