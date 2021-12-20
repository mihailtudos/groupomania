export function isLoggedIn() {
    return localStorage.getItem("isLoggedIn") == 'true';
}

export function logIn() {
    localStorage.setItem("isLoggedIn", true);
}

export function logOut() {
    localStorage.setItem("isLoggedIn", false);
}

export function notAuth(to, from, next) {
    try {
        if (!isLoggedIn()) {
            next()
        } else {
            next({
                name: "home" // back to safety route //
            })
        }
    } catch (e) {
        next({
            name: "home" // back to safety route //
        })
    }
}

export function auth(to, from, next) {
    try {
        if (isLoggedIn()) {
            next()
        } else {
            next({
                name: "login" // back to safety route //
            })
        }
    } catch (e) {
        next({
            name: "login" // back to safety route //
        })
    }
}
