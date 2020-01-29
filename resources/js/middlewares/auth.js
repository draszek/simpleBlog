import store from "../store";
import router from '../router';


export function auth(to, from, next) {
    if (!store.getters.isLogged) {
        return router.push({name: 'login'});
    }

    return next();
}

export function authAdministrator(to, from, next) {
    if (!store.getters.isLogged || store.getters.getAccountType !== 'administrator') {
        return router.push({name: 'login'});
    }

    return next();
}

export function authRedactor(to, from, next) {
    if (!store.getters.isLogged || !['redactor', 'administrator'].includes(store.getters.getAccountType)) {
        return router.push({name: 'login'});
    }

    return next();
}

