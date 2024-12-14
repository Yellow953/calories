document.addEventListener("DOMContentLoaded", function () {
    // start delete confirmation
    document.querySelectorAll(".show_confirm").forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            var url = this.getAttribute("href");
            swal({
                title: "Are you sure you want to delete this record?",
                text: "If you delete this, it will be gone forever.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = url;
                }
            });
        });
    });
    // end delete confirmation

    // start auto dismiss
    function addAutoDismiss(alert) {
        setTimeout(function () {
            alert.style.display = "none";
        }, 5000);
    }

    var autoDismissAlerts = document.querySelectorAll(".auto-dismiss");
    autoDismissAlerts.forEach(function (alert) {
        addAutoDismiss(alert);
        alert.querySelector("button").addEventListener("click", function () {
            alert.style.display = "none";
        });
    });

    document.body.addEventListener("DOMNodeInserted", function (event) {
        if (
            event.target.classList &&
            event.target.classList.contains("auto-dismiss")
        ) {
            addAutoDismiss(event.target);
        }
    });
    // end auto dismisss

    // start reset
    const filterForms = document.querySelectorAll(".form");

    filterForms.forEach(function (form) {
        const clearButton = form.querySelector(".clear-btn");

        if (clearButton) {
            clearButton.addEventListener("click", function (e) {
                e.preventDefault();
                form.reset();

                const select2Elements = form.querySelectorAll(
                    '[data-control="select2"]'
                );
                select2Elements.forEach(function (select) {
                    $(select).val(null).trigger("change");
                });

                select2Elements.forEach(function (select) {
                    $(select).select2({
                        placeholder:
                            $(select).data("placeholder") || "Select an option",
                    });
                });
            });
        }
    });
    // end reset

    // start full screen
    function enterFullscreen() {
        if (document.documentElement.requestFullscreen) {
            document.documentElement.requestFullscreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
            document.documentElement.webkitRequestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.msRequestFullscreen) {
            document.documentElement.msRequestFullscreen();
        }
    }

    function checkFullscreenStatus() {
        if (
            document.fullscreenElement ||
            document.webkitFullscreenElement ||
            document.mozFullScreenElement
        ) {
            sessionStorage.setItem("fullscreen", "true");
        } else {
            sessionStorage.setItem("fullscreen", "false");
        }
    }

    function enterFullscreenIfNeeded() {
        if (sessionStorage.getItem("fullscreen") === "true") {
            enterFullscreen();
        }
    }

    const fullscreenButton = document.querySelector("#fullscreenButton");
    if (fullscreenButton) {
        fullscreenButton.addEventListener("click", function (event) {
            event.preventDefault();
            enterFullscreen();
        });
    }

    document.addEventListener("fullscreenchange", checkFullscreenStatus);
    document.addEventListener("webkitfullscreenchange", checkFullscreenStatus);
    document.addEventListener("mozfullscreenchange", checkFullscreenStatus);
    document.addEventListener("MSFullscreenChange", checkFullscreenStatus);

    window.addEventListener("load", enterFullscreenIfNeeded);
    // end full screen
});
