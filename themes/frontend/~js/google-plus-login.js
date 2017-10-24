//******************** google login ***********************
var apiKey = 'AIzaSyCxZ6ETbid_yekWqw6Efpe1J0hojovjuEk';

// Enter the API Discovery Docs that describes the APIs you want to
// access. In this example, we are accessing the People API, so we load
// Discovery Doc found here: https://developers.google.com/people/api/rest/
var discoveryDocs = ["https://people.googleapis.com/$discovery/rest?version=v1"];

// Enter a client ID for a web application from the Google API Console:
//   https://console.developers.google.com/apis/credentials?project=_
// In your API Console project, add a JavaScript origin that corresponds
//   to the domain where you will be running the script.
var clientId = '988698398552-ecmifd9s90f7n687kqls9ijs7vgu8bp7.apps.googleusercontent.com';

// Enter one or more authorization scopes. Refer to the documentation for
// the API or https://developers.google.com/people/v1/how-tos/authorizing
// for details.
var scopes = 'profile';

//var authorizeButton = document.getElementById('google-authorize-button');

function handleClientLoad() {
    // Load the API client and auth2 library
    gapi.load('client:auth2', initClient);
}

window.onbeforeunload = function (e) {
//      gapi.auth2.getAuthInstance().signOut();
};

function initClient() {
    gapi.client.init({
        apiKey: apiKey,
        discoveryDocs: discoveryDocs,
        clientId: clientId,
        scope: scopes
    }).then(function () {
        // Listen for sign-in state changes.
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

        // Handle the initial sign-in state.
        updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());

//        authorizeButton.onclick = handleAuthClick;
    });
}

function updateSigninStatus(isSignedIn) {
    if (isSignedIn) {
        makeApiCall();
    }
}

function handleAuthClick(event) {
    gapi.auth2.getAuthInstance().signIn();

}

// Load the API and make an API call.  Display the results on the screen.
function makeApiCall() {
    gapi.client.people.people.get({
        'resourceName': 'people/me',
        'requestMask.includeField': 'person.names,person.emailAddresses,person.genders,person.birthdays,person.photos,person.addresses,person.phoneNumbers,person.relations,person.urls,person.relationshipStatuses,person.residences'
    }).then(function (resp) {
        console.log(resp);
        var resourceName = resp.result.resourceName;
        resourceName = resourceName.split('/');
        var googleId = resourceName[resourceName.length - 1];
        var firstName = resp.result.names[0].givenName;
        var lastName = resp.result.names[0].familyName;
        var googleEmail = resp.result.emailAddresses[0].value;
        var imgUrl = resp.result.photos[0].url;
        gapi.auth2.getAuthInstance().signOut();
        var url = full_path + 'social/socialsignin';
        var loginType = 'google';
        $.post(url,
                {
                    loginType: loginType,
                    googleId: googleId,
                    firstName: firstName,
                    lastName: lastName,
                    email: googleEmail,
                    imgUrl: imgUrl
                },
                function (resp) {
                    if (resp.flag == true) {
                        success_msg(resp.msg);
                        setTimeout(function () {window.location.href = resp.redirectUrl;}, 3000);
                    } else {
                        warning_msg(resp.msg)
                    }
                }, 'json');
    });
}

googlePlusLogin = function () {
    handleAuthClick();
};
//************** end google login ****************************