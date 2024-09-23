const openPopupButton = document.getElementById('openPopup');
const closePopupButton = document.getElementById('closePopup');
const popup = document.getElementById('popup');

openPopupButton.addEventListener('click', () => {
    popup.style.display = 'flex';
});

closePopupButton.addEventListener('click', () => {
    popup.style.display = 'none';
});
