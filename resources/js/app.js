import './bootstrap';

import Alpine from 'alpinejs';
import * as bootstrap from 'bootstrap';

window.Alpine = Alpine;

Alpine.start();

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

document.addEventListener("DOMContentLoaded", function(event) {
    var userId = document.querySelector("meta[name='user_id']").getAttribute('content')

    window.Echo.private(`App.Models.Employee.${userId}`)
        .notification((notification) => {
            handleNotification(notification)              
          });
          
    Livewire.on('chat-updated', () => {
        var chat = document.getElementById('chat')
        chat.scrollTop = chat.scrollHeight
    })
  });

function handleNotification(notification) {    
    switch (notification.type) {
        case 'App\\Notifications\\MessageNotification':
            handleMessage(notification)            
            break;
        case 'App\\Notifications\\TaskNotification':
            handleTaskNotification(notification)
            break;
        default:
            break;
    }    
}

function handleMessage(notification) {    
    showToast(getTelegramMessageToastView(notification))
    dispatchUpdateChatEvent()
}

function dispatchUpdateChatEvent() {        
    Livewire.emit('update-chat')    
}

function handleTaskNotification(notification) {
    showToast(getTaskNotificationToastView(notification))
}

function showToast(toastView) {
    let div = insertToast(toastView)

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

function getTaskNotificationToastView(notification) {
    return `    
        <div class="toast-header">
            <strong class="me-auto">Уведомление</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            ${notification.employeeName}, не забудьте выполнить задачу <strong>${notification.taskTitle}</strong> 😉
        </div>`
}

function getTelegramMessageToastView(notification) {
    return `<div class="toast-header">
                <strong class="me-auto">${notification.message.from.first_name}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-break">
                ${notification.message.text}
            </div>`;
}