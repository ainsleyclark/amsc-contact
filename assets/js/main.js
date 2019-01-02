window.addEventListener("load", function() {
    
    //Get tabs
    var tabs = document.querySelectorAll("ul.nav_tabs > li");
    
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].addEventListener("click", switchTab);
    }

    function switchTab(event) {
        event.preventDefault();

        document.querySelector("ul.nav_tabs li.active").classList.remove("active");
        document.querySelector(".admin_box.active").classList.remove("active");
        
        var clickedTab = event.currentTarget;
        var anchor = event.target;
        var activePanelID = anchor.getAttribute("href");

        //console.log(activePanelID);

        clickedTab.classList.add("active");
        document.querySelector(activePanelID).classList.add("active");

    }
});

