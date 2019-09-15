var logoutElement = document.querySelectorAll('[data-function]');

function userLogout() {
    if (this.getAttribute("data-function") == 'logout') {
        var data = 'logOut';
        var xhr = new XMLHttpRequest();
        var urlToSend = './php/logout.php';
        xhr.open('POST', urlToSend, true);
        xhr.send(data);

        // gestisco la risposta
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText == 'userLoggedOut') {
                    window.location.href = './index.php';
                } else if (xhr.responseText == 'logOutFailed') {
                    console.log('Logout failed');
                } else {
                    console.log('Logout failed 2 ');
                }
            } else {
                console.log('Logout server response failed');
            }
        };
    }
};

for (var i = 0; i < logoutElement.length; i++) {
    logoutElement[i].addEventListener('click', userLogout, false);
}
