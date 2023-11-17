function abilita(filtro) {
    var e = filtro.value;
    var button = document.getElementById("applicaFiltro");
    button.removeAttribute("disabled");
    if (e == "piattaforma") {
        var el = document.getElementsByName("piattaforma");
        el[0].removeAttribute("hidden");
        el = document.getElementsByName("categoria");
        el[0].setAttribute("hidden", true);
        el = document.getElementsByName("lingua");
        el[0].setAttribute("hidden", true);
    }
    if (e == "categoria") {
        var el = document.getElementsByName("categoria");
        el[0].removeAttribute("hidden");
        el = document.getElementsByName("piattaforma");
        el[0].setAttribute("hidden", true);
        el = document.getElementsByName("lingua");
        el[0].setAttribute("hidden", true);
    }
    if (e == "lingua") {
        var el = document.getElementsByName("lingua");
        el[0].removeAttribute("hidden");
        el = document.getElementsByName("categoria");
        el[0].setAttribute("hidden", true);
        el = document.getElementsByName("piattaforma");
        el[0].setAttribute("hidden", true);
    }
    if (e == "blank") {
        button.setAttribute("disabled", true);
        var el = document.getElementsByName("lingua");
        el[0].setAttribute("hidden", true);
        el = document.getElementsByName("categoria");
        el[0].setAttribute("hidden", true);
        el = document.getElementsByName("piattaforma");
        el[0].setAttribute("hidden", true);
    }
}




