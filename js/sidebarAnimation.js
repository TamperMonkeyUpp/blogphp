let closeSideBar = document.getElementById("sidebarClose")
let sideBar = document.getElementById("sidebar")
let cont = document.getElementById("cont");
let content = document.getElementById("content");
let openSideBar = document.getElementById("sidebarOpen");
closeSideBar.addEventListener('click', function(){
    if (window.innerWidth <= 600) {
        sideBar.style.width = "0";
        sideBar.style.transition = "0.1s";
        content.style.display = "block";
        content.style.transition = "0.1s";
        setTimeout( function(){
            openSideBar.style.display = "block";
        }, 30)
        cont.style.display = "none";
        setTimeout( function(){
        sideBar.style.display = "none";
    }, 85)
    }else{
        sideBar.style.width = "0";
        sideBar.style.transition = "0.1s";
        content.style.marginLeft = "0";
        content.style.transition = "0.1s";
        setTimeout( function(){
            openSideBar.style.display = "block";
        }, 30)
        cont.style.display = "none";
        setTimeout( function(){
            sideBar.style.display = "none";
        }, 85)
    } 
    
});

openSideBar.addEventListener('click', function(){
    if (window.innerWidth <= 600) {
        sideBar.style.display = "block";
        sideBar.style.transition = "0.1s ";
        content.style.display = "none";
        content.style.transition = "0.1s ";
        openSideBar.style.display = "none";
        cont.style.display = "block";
        sideBar.style.width = "100%";
   
    }else{
        sideBar.style.display = "block";
        sideBar.style.transition = "0.1s ";
        content.style.marginLeft = "270px";
        content.style.transition = "0.1s ";
        openSideBar.style.display = "none";
        cont.style.display = "block";
        setTimeout( function(){
        sideBar.style.width = "270px";
        }, 5);
    }
    
    
    
});

