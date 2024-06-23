// ==============SIDEBAR 
const menu = document.querySelector('.fa-bars');
const sidebar = document.querySelector('.sidebar');

menu.addEventListener("click", () => {
    sidebar.classList.toggle("active");
});

// ==========CUSTOM CALENDAR
const header = document.querySelector('.today-time');
const dates = document.querySelector('.dates');
const navs = document.querySelectorAll('#prev, #next');
const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December"
];

let date = new Date();
let month = date.getMonth();
let year = date.getFullYear();

function renderCalendar(){
  const start = new Date(year, month, 1).getDay();
  const endDate = new Date(year, month + 1, 0).getDate();
  const end = new Date(year, month, endDate).getDay();
  const endDatePrev = new Date(year, month, 0).getDate();

  let datesHtml = '';

  for(let i = start; i > 0; i--){
    datesHtml += `<li class="inactive">${endDatePrev - i + 1}</li>`;
  }

  for(let i = 1; i <= endDate; i++){
    let className =
      i === date.getDate() &&
      month === new Date().getMonth() &&
      year === new Date().getFullYear()
        ? ' class="today"': '';
    datesHtml += `<li ${className}>${i}</li>`;
  }

  for(i = end; i < 6; i++){
    datesHtml += `<li class="inactive">${i - end + 1}</li>`;
  }

  dates.innerHTML = datesHtml;
  header.textContent = `${months[month]}, ${year}`;
}

navs.forEach(nav => {
  nav.addEventListener('click', e => {
    const btnId = e.target.id;

    if(btnId === 'prev' && month === 0){
      year--;
      month = 11;
    }else if(btnId === 'next' && month === 11){
      year++;
      month = 0;
    }else{
      month = (btnId === 'next') ? month + 1: month - 1;
    }
    date = new Date(year, month, new Date().getDate());
    year = date.getFullYear();
    month = date.getMonth();

    renderCalendar();
  })
});
renderCalendar();

// =============== MIXITUP FILTER FEATURED
const cards = document.querySelector('.cards-wrapper');
const mixer = mixitup(cards);

//Active Feature button
const linkFeatured = document.querySelectorAll('.card-btn');

function activeFeatured(){
    linkFeatured.forEach(l=> l.classList.remove('active-btn'));
    this.classList.add('active-btn');
}
linkFeatured.forEach(l=> l.addEventListener('click', activeFeatured));

// =============LOG OUT BUTTON POP UP============
const container = document.querySelector('.person');

container.addEventListener('click', () => {
  container.classList.toggle('active');
});

// ===========DARK THEME MODE===========
const modebtn = document.querySelector('.mode');
modebtn.addEventListener('click', () => {
  document.body.classList.toggle("dark-theme");
  if(document.body.classList.contains('dark-theme')){
    modebtn.innerHTML = '<i class="fa-solid fa-sun"></i>';
  }else{
    modebtn.innerHTML = '<i class="fa-solid fa-moon"></i>';
  }
});

// Function to apply styles when viewport hits 1024px or below
function applyOnBigScreens() {
  const mediaQuery = window.matchMedia('(max-width: 1024px)');
  
  function handleViewportChange(e) {
    if (e.matches) {
      sidebar.classList.add("active");
      menu.style.pointerEvents = "none";
    } else {
      sidebar.classList.remove('active');
      menu.style.pointerEvents = "all";
    }
  }

  // Initial check
  handleViewportChange(mediaQuery);

  // Add listener to respond to viewport changes
  mediaQuery.addEventListener('change', handleViewportChange);
}
applyOnBigScreens();

// Function to apply styles when viewport hits 640px
function applyOnMediumScreens() {
  const mediaQuery = window.matchMedia('(min-width: 640px)');
  
  function handleViewportChange(e) {
    if (e.matches) {
      sidebar.classList.add("active");
      menu.style.pointerEvents = "all";
    } else {
      sidebar.classList.remove('active');
      menu.style.pointerEvents = "none";
    }
  }

  // Initial check
  handleViewportChange(mediaQuery);

  // Add listener to respond to viewport changes
  mediaQuery.addEventListener('change', handleViewportChange);
}
applyOnMediumScreens();

// Function to apply styles when viewport hits 476px or below
function applyOnSmallScreens() {
  const mediaQuery = window.matchMedia('(min-width: 476px)');
  
  function handleViewportChange(e) {
    if (e.matches) {
      sidebar.classList.add("active");
      menu.style.pointerEvents = "all";
    } else {
      sidebar.classList.remove('active');
      menu.style.pointerEvents = "none";
    }
  }

  // Initial check
  handleViewportChange(mediaQuery);

  // Add listener to respond to viewport changes
  mediaQuery.addEventListener('change', handleViewportChange);
}
applyOnSmallScreens();