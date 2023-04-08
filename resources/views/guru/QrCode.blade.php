<!DOCTYPE html>
<html>
<head>
    <title>QR Code Generator</title>
</head>
<body>
    <h1>QR Code Generator</h1>
    <form method="POST" action="{{ route('qrcode.generate') }}">
        @csrf
        <label for="data">Data:</label>
        <input type="text" id="data" name="data">
        <button type="submit">Generate QR Code</button>
    </form>
    @if (isset($qrCode))
        <img src="data:image/png;base64,{{ base64_encode($qrCode) }}">
    @endif
</body>
</html>
