const aadharNumberInput = document.getElementById('aadhar-number');
const startCameraButton = document.getElementById('start-camera');
const capturePhotoButton = document.getElementById('capture-photo');
const saveDataButton = document.getElementById('save-data');
const cameraPreview = document.getElementById('camera-preview');
const videoElement = document.getElementById('camera');
let stream;
let photoData;

startCameraButton.addEventListener('click', async () => {
    try {
        stream = await navigator.mediaDevices.getUserMedia({ video: true });
        videoElement.srcObject = stream;
        cameraPreview.style.display = 'block';
        startCameraButton.disabled = true;
        capturePhotoButton.disabled = false;
    } catch (error) {
        console.error('Error accessing webcam:', error);
    }
});

capturePhotoButton.addEventListener('click', () => {
    const canvas = document.createElement('canvas');
    canvas.width = videoElement.videoWidth;
    canvas.height = videoElement.videoHeight;
    const context = canvas.getContext('2d');
    context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
    photoData = canvas.toDataURL('image/jpeg');
    capturePhotoButton.disabled = true;
    saveDataButton.disabled = false;
    
});

saveDataButton.addEventListener('click', async (event) => {
    event.preventDefault(); // Prevent the default form submission behavior

    const aadharNumber = aadharNumberInput.value;

    if (!aadharNumber || !photoData) {
        alert('Please enter Aadhar number and capture a photo.');
        return;
    }

    try {
        const response = await fetch('saveverify.php', {
            method: 'POST',
            body: JSON.stringify({ aadharNumber, photoData }),
            headers: {
                'Content-Type': 'application/json',
            },
        });

        if (response.ok) {
            const responseData = await response.json();
            alert(responseData.message);
            window.location.href = "Complaintpage.html"; 
        } else {
            alert('Error saving data.');
        }
    } catch (error) {
        console.error('Error saving data:', error);
    }
     // saveDataButton.addEventListener("click", function() {
      //     window.location.href = "Complaintpage.html"; 
        //});



});


