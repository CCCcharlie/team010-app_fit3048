
jQuery(document).ready(function($) {
    'use strict';

    // ==============================================================
    // Notification list
    // ==============================================================
    if ($(".notification-list").length) {

        $('.notification-list').slimScroll({
            height: '250px'
        });

    }

    // ==============================================================
    // Menu Slim Scroll List
    // ==============================================================


    if ($(".menu-list").length) {
        $('.menu-list').slimScroll({

        });
    }

    // ==============================================================
    // Sidebar scrollnavigation
    // ==============================================================

    if ($(".sidebar-nav-fixed a").length) {
        $('.sidebar-nav-fixed a')
            // Remove links that don't actually link to anything

            .click(function(event) {
                // On-page links
                if (
                    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                    location.hostname == this.hostname
                ) {
                    // Figure out element to scroll to
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                    // Does a scroll target exist?
                    if (target.length) {
                        // Only prevent default if animation is actually gonna happen
                        event.preventDefault();
                        $('html, body').animate({
                            scrollTop: target.offset().top - 90
                        }, 1000, function() {
                            // Callback after animation
                            // Must change focus!
                            var $target = $(target);
                            $target.focus();
                            if ($target.is(":focus")) { // Checking if the target was focused
                                return false;
                            } else {
                                $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                $target.focus(); // Set focus again
                            };
                        });
                    }
                };
                $('.sidebar-nav-fixed a').each(function() {
                    $(this).removeClass('active');
                })
                $(this).addClass('active');
            });

    }

    // ==============================================================
    // tooltip
    // ==============================================================
    if ($('[data-toggle="tooltip"]').length) {

            $('[data-toggle="tooltip"]').tooltip()

        }

     // ==============================================================
    // popover
    // ==============================================================
       if ($('[data-toggle="popover"]').length) {
            $('[data-toggle="popover"]').popover()

    }
     // ==============================================================
    // Chat List Slim Scroll
    // ==============================================================


        if ($('.chat-list').length) {
            $('.chat-list').slimScroll({
            color: 'false',
            width: '100%'


        });
    }

    // Time-Zone Selector

    /*Generated 2016-05-23 08:17:41.711000*/
    // ==============================================================
    // dropzone script
    // ==============================================================

    // document.addEventListener("DOMContentLoaded", () => {
    //     const checklistForm = document.getElementById("checklist-form");
    //
    //     // Load previously checked items from local storage
    //     for (let i = 0; i < checklistForm.elements.length; i++) {
    //         const element = checklistForm.elements[i];
    //         if (element.type === "checkbox") {
    //             const isChecked = localStorage.getItem(element.name) === "true";
    //             element.checked = isChecked;
    //         }
    //     }
    //
    //     // Save checked items to local storage when checkboxes are clicked
    //     checklistForm.addEventListener("change", (event) => {
    //         if (event.target.type === "checkbox") {
    //             localStorage.setItem(event.target.name, event.target.checked);
    //         }
    //     });
    // });

 //     if ($('.dz-clickable').length) {
 //            $(".dz-clickable").dropzone({ url: "/file/post" });
 // }

}); // AND OF JQUERY


// $(function() {
//     "use strict";




   // var monkeyList = new List('test-list', {
    //    valueNames: ['name']

     // });
  // var monkeyList = new List('test-list-2', {
    //    valueNames: ['name']

   // });






// });
