// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    if (response.status === 'connected') {
        api();
    } else if (response.status === 'not_authorized') {
        document.getElementById('status').innerHTML = 'Please log ' +
                'into this app.';
    } else {
        document.getElementById('status').innerHTML = 'Please log ' +
                'into Facebook.';
    }
}

function checkLoginState() {
    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function () {
    FB.init({
        appId: $('#facebookAppId').val(),
//        appId: '1235159056596261',
        cookie: true, // enable cookies to allow the server to access 
        // the session
        xfbml: true, // parse social plugins on this page
        version: 'v2.8' // use graph api version 2.5
    });
};

// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function facebookLogin() {
    FB.login(function (response) {
        checkLoginState();
    }, {scope: 'public_profile,email'});
}
function fb_logout() {
    alert(1);
    FB.logout;
}
// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function api() {
    FB.api('/me?fields=id,email,first_name,last_name,name,picture', function (response) {
       console.log(response);
        var loginType = 'facebook';
        var data = {
            facebookId: response.id,
            loginType: loginType,
            firstName: response.first_name,
            lastName: response.last_name,
            email: response.email,
            imgUrl: response.picture.data.url
        };
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url: full_path + 'social/socialsignin',
            headers: {'X-CSRF-TOKEN': csrfToken},
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (resp) {
                if (resp.flag == true) {
                     success_msg(resp.msg);
                    setTimeout(function(){window.location.href = resp.redirectUrl;}, 3000);
                } else {
                    warning_msg(resp.msg)
                }
            }
        });
    });
}