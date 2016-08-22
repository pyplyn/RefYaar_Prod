<?php

function imageValidation() {
    ?>
    <script>
        var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
        // Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
        var isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
        var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
        // At least Safari 3+: "[object HTMLElementConstructor]"
        var isChrome = !!window.chrome && !isOpera;              // Chrome 1+
        var isIE = /*@cc_on!@*/false || !!document.documentMode; // At least IE6

        var _URL = window.URL;
        var file, img;
        if (isChrome || isFirefox) {
            alert();
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function () {
                    alert("Width:" + this.width + "   Height: " + this.height);//this will give you image width and height and you can easily validate here....
                };
                img.src = _URL.createObjectURL(file);
            }
        }
    </script>


    <?php

}
?>