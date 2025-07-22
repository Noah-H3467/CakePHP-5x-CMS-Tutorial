function assign(data) {
    document.getElementById('email').innerText = data.email
    document.getElementById('method').innerText = data.method
}


function setCookie() {
    // example of setting a cookie in js
    document.cookie = "username=John Doe; expires=Thu, 18 Dec 2056 12:00:00 UTC; path=/";
}

async function get() {
    const res = await fetch('/articles/ajax?token=rrrr&method=get', {
        method: 'get',
        // Headers so that  Cake can recognize it as an Ajax request
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            // Says that it wants json data back from the request
            'Accept': 'application/json'
        }
    })

    const data = await res.json();

    assign(data);

    console.log(data);
}

async function post() {
    const res = await fetch('/articles/ajax?method=post', {
        method: 'post',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            // Uses authorization header with a token embedded into it
            'Authorization': 'Token rrrr',
            // Says that it wants json data back from the request
            'Accept': 'application/json',
            'X-CSRF-Token': csrfToken
        }
    })

    const data = await res.json();

    assign(data);

    console.log(data);
}