jQuery(function(){
    NProgress.configure({
        showSpinner: false
    });

    NProgress.start();

    document.onreadystatechange = function() {
        "complete" == document.readyState && setTimeout(NProgress.done, 500);
    }
});
