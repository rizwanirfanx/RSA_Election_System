<!DOCTYPE html>
<html>

<head>
    <title>RSA Voting Pass</title>
</head>

<body>
    <div
        style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; width: fit-content; padding: 20px; margin: 0 auto;">

        <div style="text-align: center;">
            <!-- Your Company Logo -->
            <img src="https://upload.wikimedia.org/wikipedia/commons/4/4a/Emblem_of_the_Election_Commission_of_Pakistan.svg"
                alt="ECP Logo" style="max-width: 200px; margin-bottom: 20px;">
        </div>

        <div style="text-align: center;">
            <p style="font-size: 20px; font-family: Arial, Helvetica, sans-serif;">Here is your Voting Pass, Don't Share
                with
                Others, keep it Secret 😶</p>
            <p><b><input disabled style="background-color: white; outline: none; border: none; text-align: center;"
                        id="voting_pass" value="{{ $voting_pass }}" /></b></p>


            <button style="background-color: green; padding: 10px; color: white; border-radius: 10px;" id="copyButton"
                onclick="copyToClipboard()">Copy Voting Pass To Clipboard</button>
        </div>

        <div style="text-align: center;">
            <img src="https://ecp.gov.pk/assets/img/header.png" alt="Image"
                style="min-width: 200px; max-width: 800px; margin-top: 20px;">
        </div>

    </div>
    <script>
        function copyToClipboard() {
            const votingPassEl = document.getElementById('voting_pass')
            console.log(votingPassEl.value)
            var textToCopy = "[Text you want to copy]";
            navigator.clipboard.writeText(textToCopy);
            alert("Text copied to clipboard!");
        }
    </script>
</body>

</html>
