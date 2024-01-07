export function required(v) {
    return !!v || 'Field is required'
}

export function email(v) {
    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern.test(v) || 'Not an email address.'
}

export function min(size: Number) {
    return v => v.length >= size || `Min ${size} characters`
}
