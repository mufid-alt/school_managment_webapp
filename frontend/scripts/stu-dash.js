const announcementsList = document.querySelector('.announcements ul');
const announcementsBtn = document.querySelector('.announcements button');

// Sample announcement data
const announcements = [
  "Important message from the Principal...",
  "Upcoming school play rehearsals on Fridays.",
  "Math Club meeting after school on Tuesdays."
];

// Function to show more announcements
function showMoreAnnouncements() {
  announcementsList.style.maxHeight = "none";

  // Clear existing content
  announcementsList.innerHTML = '';
  
  // Add each announcement in a new line
  announcements.forEach(announcement => {
    const li = document.createElement('li');
    li.textContent = announcement;
    announcementsList.appendChild(li);
  });
  announcementsBtn.style.display = "none"; // Hide the "See More" button
}