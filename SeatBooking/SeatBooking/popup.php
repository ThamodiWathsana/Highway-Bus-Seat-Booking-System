<!DOCTYPE html>
<html>
<head>
    <title>Popup Box</title>
    <link rel="stylesheet" type="text/css" href="popup.css">
</head>
<body>
    <div class="popup">
        <img src="tick.png">
        <h1>Thank You!</h1>
        <p>Your details have been successfully submitted. Thanks!</p>
        <button type="button" onclick="closePopup()">OK</button>
    </div>
<script>
		let popup = document.getElementById("popup");
        let paymentForm = document.getElementById("paymentForm");
        paymentForm.addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission
            openPopup();
        });
        function openPopup() {
            popup.classList.add("open-popup");
        }
        function closePopup() {
            popup.classList.remove("open-popup");
	          }

    function closePopup() {
        window.close(); // Close the popup window
    }
</script>
</body>
</html>
