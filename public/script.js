//fucntion to show selected section
function showSection(sectionID){
    //initially, select all sections
    // use querySelectorAll for all sections with class content and homecontent
    const sections = document.querySelectorAll('section');
    
    //hide the resulting content sections using foreach
    sections.forEach(section => {
        section.style.display='none';
    });


    //select the section that would
    //be displayed when clicked
    const targetSection = document.getElementById(sectionID);
    if (targetSection) {
        targetSection.style.display='block';
    }
}

function hideAll(){
    
    const sections=document.querySelectorAll('section');

    sections.forEach(section => {
        section.style.display='none';
    });

    document.getElementById('home').style.display='block';
}


//for the insertion success
window.onload = function() {
        hideAll();

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('status') === 'success') {
        showSection('create');

        const toast = document.getElementById('success-toast');

        if (toast) {
            toast.classList.remove('toast-hidden');
        
            // Hide it automatically after 3 seconds
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.classList.add('toast-hidden'), 500);
            }, 3000);
        }

        // Clean the URL
        window.history.replaceState({}, document.title, window.location.pathname);
        }else{
            hideAll();
    }
}
