var btn = document.getElementById("scroll");
btn.addEventListener('click', ScrollToTop);

function ScrollToTop(){
    if(window.scrollY!=0){
        setTimeout(function(){
                        scrollTo(0,window.scrollY-10);
                        ScrollToTop();
                    },5);
    }
}