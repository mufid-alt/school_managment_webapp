document.addEventListener('DOMContentLoaded', () => {
    // Example of dynamically adding a notification
    const notificationsList = document.getElementById('notifications-list');
    const newNotification = document.createElement('p');
    newNotification.textContent = 'New assignment posted for Data Structures.';
    notificationsList.appendChild(newNotification);
});