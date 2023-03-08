import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])


const deleteButtons = document.querySelectorAll('.confirm-delete-button[type="submit"]');

deleteButtons.forEach((button) => {
    button.addEventListener('click', function (event) {

        event.preventDefault();

        const projectTitle = button.getAttribute('data-title');

        const modal = document.getElementById('delete-project-modal');

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();

        const modalContent = modal.querySelector('#modal-item-title');

        modalContent.textContent = projectTitle;

        const deleteButton = modal.querySelector('#confirm-delete');

        deleteButton.addEventListener('click', () => {
            button.parentElement.submit();
        })
    })
})