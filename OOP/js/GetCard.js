function getCard(str) {

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("content").innerHTML = this.responseText;
            document.getElementById("textareaEdit").innerHTML = this.responseText;
            document.getElementById("topic").innerHTML = str;

            var text = document.getElementById('topicEdit');
            text.value = str;

        }
    };
    xmlhttp.open("GET", "../root/GetCard.php?q=" + str, true);
    xmlhttp.send();

    var cardShow = document.getElementById("card");
    cardShow.style.display = "block";
    var editForm = document.getElementById("editForm");
    editForm.style.display = "none";
}
