const camera = document.getElementById('camera');
const captureBtn = document.getElementById('capture-btn');
const canvas = document.getElementById('canvas');
const capturedImage = document.getElementById('captured-image');
const submitBtn = document.getElementById('submit-btn');
const verificationForm = document.getElementById('verification-form');

// Access the webcam
navigator.mediaDevices.getUserMedia({ video: true })
    .then(stream => {
        camera.srcObject = stream;
    })
    .catch(error => {
        console.error('Error accessing webcam:', error);
    });

// Capture image from webcam
captureBtn.addEventListener('click', () => {
    canvas.width = camera.videoWidth;
    canvas.height = camera.videoHeight;
    canvas.getContext('2d').drawImage(camera, 0, 0, canvas.width, canvas.height);
    capturedImage.src = canvas.toDataURL('image/png');
    capturedImage.style.display = 'block';
});

// Form submission
verificationForm.addEventListener('submit', event => {
    event.preventDefault();
    // You can add code here to handle the form submission, e.g., send the data to a server.
    // Remember to handle sensitive data securely and follow proper security practices.
});
