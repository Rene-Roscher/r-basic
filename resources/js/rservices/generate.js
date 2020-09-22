const generate = {
    string(length, numeric = true) {
        let c = 'abcdefghijklmnopqrstuvwxyz';
        if (numeric)
            c += c.toUpperCase() + 1234567890;
        return '-'.repeat(length).replace(/./g, b => c[~~(Math.random() * 62)])
    },
    number(min, max){
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
};
export {generate};
