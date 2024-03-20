const darkMode = document.querySelector('.dark-mode');
let darkModeCookie = localStorage.getItem('darkMode');

const enableDarkMode = () => {
    //1. add the class darkmode to the body
    document.body.classList.add('dark-mode-variables');
    //2. update darkMode in the local storage
    localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
    //1. remove the class darkmode from the body
    document.body.classList.remove('dark-mode-variables');
    //2. update darkMode in the local storage
    localStorage.removeItem('darkMode', 'enabled');
}

if(darkModeCookie === 'enabled'){
    enableDarkMode();
    darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
    darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
}

darkMode.addEventListener('click', () => {
    darkModeCookie = localStorage.getItem('darkMode');
    if(darkModeCookie != 'enabled'){
        enableDarkMode();
    }else{
        disableDarkMode();
    }
    darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
    darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
});