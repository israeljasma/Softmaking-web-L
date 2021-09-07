export default {
    install(Vue, options) {
        (Vue.prototype.showSwalToast = (
            title = "A custom message",
            icon = "success",
            timer = 3000
        ) => {
            Vue.swal.fire({
                toast: true,
                icon,
                title,
                position: "top-end",
                showConfirmButton: false,
                timer,
                timerProgressBar: true,
                didOpen: toast => {
                    toast.addEventListener("mouseenter", Vue.swal.stopTimer);
                    toast.addEventListener("mouseleave", Vue.swal.resumeTimer);
                }
            });
        }),
            (Vue.showSwalModal = (
                title = "A custom message",
                text = "A description of custom message",
                icon = "success"
            ) => {
                Vue.swal(title, text, icon);
            }),
            Vue.mixin({
                mounted() {}
            });
    }
};
