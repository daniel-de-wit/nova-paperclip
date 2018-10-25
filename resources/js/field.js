Nova.booting((Vue, router) => {
    Vue.component('index-paperclip-file', require('./components/IndexField'));
    Vue.component('detail-paperclip-file', require('./components/DetailField'));
    Vue.component('form-paperclip-file', require('./components/FormField'));

    Vue.component('index-paperclip-image', require('./components/IndexField'));
    Vue.component('detail-paperclip-image', require('./components/DetailField'));
    Vue.component('form-paperclip-image', require('./components/FormField'));

    Vue.component('index-paperclip-video', require('./components/IndexField'));
    Vue.component('detail-paperclip-video', require('./components/DetailField'));
    Vue.component('form-paperclip-video', require('./components/FormField'));
})
