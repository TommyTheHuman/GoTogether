var invisibleTrigger = document.getElementsByClassName("invisibleTrigger");

var showInvisible = function() {
    if (this.classList.contains("invisibleTrigger--isVisible")){
        this.classList.remove('invisibleTrigger--isVisible');
    } else {
        this.classList.add('invisibleTrigger--isVisible');
    }
};


for (var i = 0; i < invisibleTrigger.length; i++) {
    invisibleTrigger[i].addEventListener('click', showInvisible, false);
}