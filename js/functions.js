// Receives the id of the card and fetches via AJAX the needed data
function getCard(str) {

    //clean the query string
    let str0 = str.replace(/>.+<\/b>/g, "><\/b");
    let str1 = str0.replace(/(<([^>]+)>)/gi, "");
    let str2 = str1.replace("%20", " ");

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("text").innerHTML = this.responseText;
            document.getElementById("title").innerHTML = str;
        }
    };
    xmlhttp.open("GET", "../card/read?search=" + str2, true);
    xmlhttp.send();
}

// Turns on the overlay
function on() {
    document.getElementById("overlay").style.display = "block";
}

//Turns off the overlay
function off() {
    document.getElementById("overlay").style.display = "none";
}

// Displays the cards of the selected domain with AJAX request
function display(str) {
    if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("main").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "../cards/displayByDomain?domain=" + str, true);
    xmlhttp.send();
}


/*  Functions working with
    domains dropdown list
    in the 'top' component and 'create' view */

///////////////////////////////////////////

//Shows dropdown domains list if it's hidden and hides it if displayed
function toggle_dropdown() {
    var element = document.getElementsByClassName('dropdown-content')[0];
    if (element.style.display === "block") {
        element.style.display = "none"
    } else {
        element.style.display = "block"
    }

    document.getElementById('dropdown').focus();
}

//Hides dropdown domains list
function hide_dropdown() {
    let element = document.getElementsByClassName('dropdown-content')[0];
    element.style.display = "none";
}

//Hides dropdown domains list when clicked outside of it by checking if it's in focus
function check_focus() {
    const elem = document.getElementById('dropdown');
    if (elem !== document.activeElement) {
        hide_dropdown();
    }
}

//Overwrites the selected domain
function overwrite_domain(str) {
    document.getElementById("dropdown").innerHTML = str;

    //Make disappear fromt he list the domain that has been selected and appear that was selected previously
    var dropdown_items = document.getElementsByClassName('dropdown-items');

    var i;
    for (i = 0; i < dropdown_items.length; i++) {
        var element = document.getElementsByClassName('dropdown-items')[i];
        var x = element.innerHTML;
        if(element.style.display === "none") {
            element.style.display = "block";
        }
        if(x === str) {
            element.style.display = "none";
        }
    }
}

//inserts the selected domain into input field
function input_domain(str) {
    let selected_domain = document.getElementById("selected_domain");
    if (selected_domain !== null) {
        selected_domain.value = str;
    }
}

//////////////////////////////////////

//Changes border radius of the TinyMCE frame in the 'create' and 'update' views
function radius() {
    var element = document.getElementsByClassName('tox-tinymce')[0];
    element.style.borderRadius = "10px";
}

function redirect(){
    window.location.assign("../views/login");
}




