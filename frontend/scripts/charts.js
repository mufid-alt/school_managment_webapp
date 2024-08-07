// ============POP UP LOGOUT
let admin_div = document.querySelector('.person');
admin_div.addEventListener('click', () => {
    admin_div.classList.toggle('active');
});

// ==============SIDEBAR 
let menu = document.querySelector('.fa-bars');
let sidebar = document.querySelector('.sidebar');
menu.addEventListener("click", () => {
    sidebar.classList.toggle("active");
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