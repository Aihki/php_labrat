'use strict';
const modifyLinks = document.querySelectorAll('.modify-link');
const modifyModal = document.querySelector('#modify-modal');
const modifyContent = document.querySelector('#modify-content');
const closeModal = document.querySelectorAll('.close-modal');
const successModal = document.querySelector('#success-modal');


modifyLinks.forEach((link) => {
    link.addEventListener('click', async (evt) => {
        evt.preventDefault();
        const id = link.dataset.id;
        const response = await fetch('modifyForm.php?id=' + id);
        const html = await response.text();
        modifyContent.innerHTML = '';
        modifyContent.insertAdjacentHTML('beforeend', html);
        modifyModal.showModal();

    })
})

closeModal.forEach((link) => {
    const parent = link.closest('dialog');
    link.addEventListener('click', () => {
        parent.close();
    })
});

const urlParams = new URLSearchParams(window.location.search);

if (urlParams.has('success')){
    successModal.showModal();
}