export function isLoggedIn() {
    return localStorage.getItem("isLoggedIn") == 'true';
}

export function logIn(user) {
    localStorage.setItem("isLoggedIn", true);
}

export function logOut() {
    localStorage.setItem("isLoggedIn", false);
    localStorage.removeItem("user");
}
