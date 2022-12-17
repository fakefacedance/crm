import './bootstrap';

import Alpine from 'alpinejs';
import * as bootstrap from 'bootstrap';

window.Alpine = Alpine;

Alpine.start();

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

document.addEventListener("DOMContentLoaded", function(event) {
    var userId = document.querySelector("meta[name='user_id']").getAttribute('content')

    window.Echo.private(`App.Models.Staff.${userId}`)
          .notification((notification) => {              
              showToast(notification)
          });    
  });

function showToast(notification) {
    let div = insertToast(getToastView(notification))

    div.addEventListener('hidden.bs.toast', () => {
        div.remove()
    })

    const toast = new bootstrap.Toast(div)
    toast.show()
}

function insertToast(html) {    
    let div = document.createElement('div')
    div.className = 'toast'
    div.setAttribute('role', 'alert')
    div.setAttribute('data-bs-autohide', false)
    div.innerHTML = html
    document.getElementById('toast-container').appendChild(div)        

    return div
}

function getToastView(notification) {
    return `    
        <div class="toast-header">
            <strong class="me-auto">Уведомление</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ${notification.employeeName}, не забудьте выполнить задачу <strong>${notification.taskTitle}</strong> 😉
        </div>`
}