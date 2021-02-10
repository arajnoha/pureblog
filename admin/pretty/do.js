if (document.querySelectorAll("a#editpage")[0]) {
    document.querySelectorAll("a#editpage")[0].href = document.querySelectorAll("a#editpage")[0].href + "?id=" + window.location.pathname.split("/").pop();

}

document.addEventListener("click", function(e){
    if (e.target.matches("a#deletepage")) {
        e.preventDefault();
        if (confirm("Do you really want to delete the current page ?")) {
            let slug = "../admin/deletepage.php?id=" + window.location.pathname.split("/").pop();
            window.location.href = slug;
        }
    }
});