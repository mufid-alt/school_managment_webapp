const announcementsList = document.querySelector('.announcements ul');
const announcementsBtn = document.querySelector('.announcements button');
const scheduleTable = document.getElementById('scheduleTable');

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

// Function to populate the schedule table
function populateSchedule() {
  const scheduleData = [
    { day: "M-W-F", subject: "Linux", time: "07:30 AM - 09:00 AM" },
    { day: "T-T-S", subject: "Java", time: "07:30 AM - 09:00 AM" },
    { day: "Sunday", subject: "Lab", time: "To be announced..." },
  ];

  scheduleData.forEach(item => {
    const tableRow = document.createElement('tr');
    const dayCell = document.createElement('td');
    const subjectCell = document.createElement('td');
    const timeCell = document.createElement('td');

    dayCell.textContent = item.day;
    subjectCell.textContent = item.subject;
    timeCell.textContent = item.time;

    tableRow.appendChild(dayCell);
    tableRow.appendChild(subjectCell);
    tableRow.appendChild(timeCell);

    scheduleTable.getElementsByTagName('tbody')[0].appendChild(tableRow);
  });
}

// Call functions on page load
populateSchedule();