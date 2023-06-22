<!DOCTYPE html>
<html>
<head>
  <title>RSA Voting Pass</title>
</head>
<body>
  <div style="text-align: center;">
    <!-- Your Company Logo -->
    <img src="{{asset('images/ecp_logo.png')}}" alt="ECP Logo" style="max-width: 200px; margin-bottom: 20px;">
  </div>

  <div style="text-align: center;">
    <p>Here is your Voting Pass, Don't Share with Others, keep it Secret 😶</p>
		<p><b>{{$voting_pass}}</b></p>

    <button id="copyButton" onclick="copyToClipboard()">Copy To Clipboard</button>
  </div>

  <div style="text-align: center;">
    <!-- Image Section -->
    <img src="asset('images/header.png" alt="Image" style="max-width: 400px; margin-top: 20px;">
  </div>

  <script>
    function copyToClipboard() {
      var textToCopy = "[Text you want to copy]";
      navigator.clipboard.writeText(textToCopy);
      alert("Text copied to clipboard!");
    }
  </script>
</body>
</html>

