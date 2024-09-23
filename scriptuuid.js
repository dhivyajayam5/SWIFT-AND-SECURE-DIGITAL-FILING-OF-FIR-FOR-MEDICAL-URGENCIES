document.getElementById("retrieveForm").addEventListener("submit", function (event) {
    event.preventDefault();
    
    const uuid = document.getElementById("uuid").value;

    // Send an AJAX request to PHP script
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "retrieveuuid.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById("result").innerHTML = xhr.responseText;
        }
    };
    
    xhr.send("uuid=" + uuid);
});
