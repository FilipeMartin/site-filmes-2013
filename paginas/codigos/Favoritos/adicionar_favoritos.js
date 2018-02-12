function addFav(){
    var url      = "http://www.mundodownload.net/";
    var title    = "Mundo Download";
    if (window.sidebar) window.sidebar.addPanel(title, url,"");
    else if(window.opera && window.print){
        var mbm = document.createElement('a');
        mbm.setAttribute('rel','sidebar');
        mbm.setAttribute('href',url);
        mbm.setAttribute('title',title);
        mbm.click();
    }
    else if(document.all){window.external.AddFavorite(url, title);}
}