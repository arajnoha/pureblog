let lastSegment;

if (document.querySelectorAll("a#editpage")[0]) {
    let url = window.location.pathname.split('/');
    lastSegment = url.pop() || url.pop();
    document.querySelectorAll("a#editpage")[0].href = document.querySelectorAll("a#editpage")[0].href + "?id=" + lastSegment;

}

document.addEventListener("click", function(e){
    if (e.target.matches("a#deletepage")) {
        e.preventDefault();
        if (confirm("Do you really want to delete the current page ?")) {
            let slug = "../admin/deletepage.php?id=" + lastSegment;
            window.location.href = slug;
        }
    }
});