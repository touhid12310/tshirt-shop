var myStorage = ''

function clearlStorage() {
    localStorage.clear()
}

function pushToStorage(key, value) {
    localStorage.setItem(key, value);
}

function pullFromStorage(key) {
    return localStorage.getItem(key);
}

function removeFromStorage(key) {
    localStorage.removeItem(key);
}

function pushObjectToStorage(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}

function pullObjectFromStorage(key) {
    return JSON.parse(localStorage.getItem(key));
}