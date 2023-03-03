var initialPhpUrl='scripts/php/view/';

//PHP pages redirect logic
function sendToPhpPage(url) {
    if (url=='login.php') {
        sendToLoginPage(url);
        //sendToLoginPage() is defined in index.js
    }
}