function isAndroidWechat() {
    // 第一个条件用来判断是否为Android系统，第二个用来判断是否为微信
    return (/android/.test(navigator.userAgent.toLowerCase()) &&
    /micromessenger/.test(navigator.userAgent.toLowerCase()));
}
function updateURL(url, args, hash) {
    // 时间戳参数，默认是"t"
    let key = (args || 't') + '=';
    /**
     * 如果使用路由（比如react-router）跳转并刷新，
     * 则需要将目标hash也传递过来（比如event.currentTarget.hash），
     * 一般用不到这个参数，可直接省略
     */
    let router = hash || location.hash;
    // 匹配规则
    const reg = new RegExp(key + '\\d+');
    // 获取当前时间
    let timestamp = new Date();
    if (url.indexOf(key) > -1) {
        // 如果有时间戳，则直接更新
        return url.replace(reg, key + timestamp);
    } else {
        // 如果没有时间戳，则加上时间戳
        if (url.indexOf('\?') > -1) {
            let urlArr = url.split('\?');
            if (urlArr[1]) {
                return urlArr[0] + '?' + key + timestamp + '&' + urlArr[1];
            } else {
                return urlArr[0] + '?' + key + timestamp;
            }
        } else {
            // 使用hash路由的情况
            if (url.indexOf('#') > -1) {
                return url.split('#')[0] + '?' + key + timestamp + router;
            } else {
                return url + '?' + key + timestamp;
            }
        }
    }
}
function reloadPage() {
    if (isAndroidWechat()) {
        // 先添加时间戳
        location.href = updateURL(location.href);
        // 然后强制刷新
        location.reload(true);
    } else {
        // 直接强制刷新
        location.reload(true);
    }
}