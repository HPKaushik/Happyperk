type = ['', 'info', 'success', 'warning', 'danger'];


demo = {
    initPickColor: function() {
        $('.pick-class-label').click(function() {
            var new_class = $(this).attr('new-class');
            var old_class = $('#display-buttons').attr('data-class');
            var display_div = $('#display-buttons');
            if (display_div.length) {
                var display_buttons = display_div.find('.btn');
                display_buttons.removeClass(old_class);
                display_buttons.addClass(new_class);
                display_div.attr('data-class', new_class);
            }
        });
    },

    // initDocumentationCharts: function() {
    //     /* ----------==========     Daily Sales Chart initialization For Documentation    ==========---------- */

    //     dataDailySalesChart = {
    //         labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
    //         series: [
    //             [12, 17, 7, 17, 23, 18, 38]
    //         ]
    //     };

    //     optionsDailySalesChart = {
    //         lineSmooth: Chartist.Interpolation.cardinal({
    //             tension: 0
    //         }),
    //         low: 0,
    //         high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
    //         chartPadding: {
    //             top: 0,
    //             right: 0,
    //             bottom: 0,
    //             left: 0
    //         },
    //     }

    //     var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

    //     md.startAnimationForLineChart(dailySalesChart);
    // },

    // initDashboardPageCharts: function() {

    //     /* ----------==========     Daily Sales Chart initialization    ==========---------- */

    //     dataDailySalesChart = {
    //         labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
    //         series: [
    //             [12, 17, 7, 17, 23, 18, 38]
    //         ]
    //     };

    //     optionsDailySalesChart = {
    //         lineSmooth: Chartist.Interpolation.cardinal({
    //             tension: 0
    //         }),
    //         low: 0,
    //         high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
    //         chartPadding: {
    //             top: 0,
    //             right: 0,
    //             bottom: 0,
    //             left: 0
    //         },
    //     }

    //     var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

    //     md.startAnimationForLineChart(dailySalesChart);



    //     /* ----------==========     Completed Tasks Chart initialization    ==========---------- */

    //     dataCompletedTasksChart = {
    //         labels: ['12am', '3pm', '6pm', '9pm', '12pm', '3am', '6am', '9am'],
    //         series: [
    //             [230, 750, 450, 300, 280, 240, 200, 190]
    //         ]
    //     };

    //     optionsCompletedTasksChart = {
    //         lineSmooth: Chartist.Interpolation.cardinal({
    //             tension: 0
    //         }),
    //         low: 0,
    //         high: 1000, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
    //         chartPadding: {
    //             top: 0,
    //             right: 0,
    //             bottom: 0,
    //             left: 0
    //         }
    //     }

    //     var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

    //     // start animation for the Completed Tasks Chart - Line Chart
    //     md.startAnimationForLineChart(completedTasksChart);


    //     /* ----------==========     Emails Subscription Chart initialization    ==========---------- */

    //     var dataEmailsSubscriptionChart = {
    //         labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    //         series: [
    //             [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]

    //         ]
    //     };
    //     var optionsEmailsSubscriptionChart = {
    //         axisX: {
    //             showGrid: false
    //         },
    //         low: 0,
    //         high: 1000,
    //         chartPadding: {
    //             top: 0,
    //             right: 5,
    //             bottom: 0,
    //             left: 0
    //         }
    //     };
    //     var responsiveOptions = [
    //         ['screen and (max-width: 640px)', {
    //             seriesBarDistance: 5,
    //             axisX: {
    //                 labelInterpolationFnc: function(value) {
    //                     return value[0];
    //                 }
    //             }
    //         }]
    //     ];
    //     var emailsSubscriptionChart = Chartist.Bar('#emailsSubscriptionChart', dataEmailsSubscriptionChart, optionsEmailsSubscriptionChart, responsiveOptions);

    //     //start animation for the Emails Subscription Chart
    //     md.startAnimationForBarChart(emailsSubscriptionChart);

    // },

    // initGoogleMaps: function() {
    //     var myLatlng = new google.maps.LatLng(40.748817, -73.985428);
    //     var mapOptions = {
    //         zoom: 13,
    //         center: myLatlng,
    //         scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
    //         styles: [{
    //             "featureType": "water",
    //             "stylers": [{
    //                 "saturation": 43
    //             }, {
    //                 "lightness": -11
    //             }, {
    //                 "hue": "#0088ff"
    //             }]
    //         }, {
    //             "featureType": "road",
    //             "elementType": "geometry.fill",
    //             "stylers": [{
    //                 "hue": "#ff0000"
    //             }, {
    //                 "saturation": -100
    //             }, {
    //                 "lightness": 99
    //             }]
    //         }, {
    //             "featureType": "road",
    //             "elementType": "geometry.stroke",
    //             "stylers": [{
    //                 "color": "#808080"
    //             }, {
    //                 "lightness": 54
    //             }]
    //         }, {
    //             "featureType": "landscape.man_made",
    //             "elementType": "geometry.fill",
    //             "stylers": [{
    //                 "color": "#ece2d9"
    //             }]
    //         }, {
    //             "featureType": "poi.park",
    //             "elementType": "geometry.fill",
    //             "stylers": [{
    //                 "color": "#ccdca1"
    //             }]
    //         }, {
    //             "featureType": "road",
    //             "elementType": "labels.text.fill",
    //             "stylers": [{
    //                 "color": "#767676"
    //             }]
    //         }, {
    //             "featureType": "road",
    //             "elementType": "labels.text.stroke",
    //             "stylers": [{
    //                 "color": "#ffffff"
    //             }]
    //         }, {
    //             "featureType": "poi",
    //             "stylers": [{
    //                 "visibility": "off"
    //             }]
    //         }, {
    //             "featureType": "landscape.natural",
    //             "elementType": "geometry.fill",
    //             "stylers": [{
    //                 "visibility": "on"
    //             }, {
    //                 "color": "#b8cb93"
    //             }]
    //         }, {
    //             "featureType": "poi.park",
    //             "stylers": [{
    //                 "visibility": "on"
    //             }]
    //         }, {
    //             "featureType": "poi.sports_complex",
    //             "stylers": [{
    //                 "visibility": "on"
    //             }]
    //         }, {
    //             "featureType": "poi.medical",
    //             "stylers": [{
    //                 "visibility": "on"
    //             }]
    //         }, {
    //             "featureType": "poi.business",
    //             "stylers": [{
    //                 "visibility": "simplified"
    //             }]
    //         }]

    //     }
    //     var map = new google.maps.Map(document.getElementById("map"), mapOptions);

    //     var marker = new google.maps.Marker({
    //         position: myLatlng,
    //         title: "Hello World!"
    //     });

    //     // To add the marker to the map, call setMap();
    //     marker.setMap(map);
    // },

    initMaterialWizard: function() {
        // Code for the Validator
//        var $validator = $('.wizard-card form').validate({
//            rules: {
//                firstname: {
//                    required: true,
//                    minlength: 3
//                },
//                lastname: {
//                    required: true,
//                    minlength: 3
//                },
//                email: {
//                    required: true,
//                    minlength: 3,
//                }
//            },
//
//            errorPlacement: function(error, element) {
//                $(element).parent('div').addClass('has-error');
//            }
//        });

        // Wizard Initialization
        $('.wizard-card').bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn-next, .move_on_select',
            'previousSelector': '.btn-previous',

//            onNext: function(tab, navigation, index) {
//                var $valid = $('.wizard-card form').valid();
//                if (!$valid) {
//                    $validator.focusInvalid();
//                    return false;
//                }
//            },

            onInit: function(tab, navigation, index) {
                //check number of tabs and fill the entire row
                var $total = navigation.find('li').length;
                var $wizard = navigation.closest('.wizard-card');

                $first_li = navigation.find('li:first-child a').html();
                $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
                $('.wizard-card .wizard-navigation').append($moving_div);

                refreshAnimation($wizard, index);

                $('.moving-tab').css('transition', 'transform 0s');
            },
//
//            onTabClick: function(tab, navigation, index) {
//                var $valid = $('.wizard-card form').valid();
//
//                if (!$valid) {
//                    return false;
//                } else {
//                    return true;
//                }
//            },

            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;

                var $wizard = navigation.closest('.wizard-card');

                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $($wizard).find('.btn-next').hide();
                    $($wizard).find('.btn-finish').show();
                } else {
                    $($wizard).find('.btn-next').show();
                    $($wizard).find('.btn-finish').hide();
                }

                button_text = navigation.find('li:nth-child(' + $current + ') a').html();

                setTimeout(function() {
                    $('.moving-tab').text(button_text);
                }, 150);

//                var checkbox = $('.footer-checkbox');
//
//                if (!index == 0) {
//                    $(checkbox).css({
//                        'opacity': '0',
//                        'visibility': 'hidden',
//                        'position': 'absolute'
//                    });
//                } else {
//                    $(checkbox).css({
//                        'opacity': '1',
//                        'visibility': 'visible'
//                    });
//                }

                refreshAnimation($wizard, index);
            }
        });


        // Prepare the preview for profile picture
        $("#wizard-picture").change(function() {
            readURL(this);
        });

        $('[data-toggle="wizard-radio"]').click(function() {
            wizard = $(this).closest('.wizard-card');
            wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
            $(this).addClass('active');
            $(wizard).find('[type="radio"]').removeAttr('checked');
            $(this).find('[type="radio"]').attr('checked', 'true');
        });

//        $('[data-toggle="wizard-checkbox"]').click(function() {
//            if ($(this).hasClass('active')) {
//                $(this).removeClass('active');
//                $(this).find('[type="checkbox"]').removeAttr('checked');
//            } else {
//                $(this).addClass('active');
//                $(this).find('[type="checkbox"]').attr('checked', 'true');
//            }
//        });

        $('.set-full-height').css('height', 'auto');

        //Function to show image before upload

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(window).resize(function() {
            $('.wizard-card').each(function() {
                $wizard = $(this);

                index = $wizard.bootstrapWizard('currentIndex');
                refreshAnimation($wizard, index);

                $('.moving-tab').css({
                    'transition': 'transform 0s'
                });
            });
        });

        function refreshAnimation($wizard, index) {
            $total = $wizard.find('.nav li').length;
            $li_width = 100 / $total;

            total_steps = $wizard.find('.nav li').length;
            move_distance = $wizard.width() / total_steps;
            index_temp = index;
            vertical_level = 0;

            mobile_device = $(document).width() < 600 && $total > 3;

            if (mobile_device) {
                move_distance = $wizard.width() / 2;
                index_temp = index % 2;
                $li_width = 50;
            }

            $wizard.find('.nav li').css('width', $li_width + '%');

            step_width = move_distance;
            move_distance = move_distance * index_temp;

            $current = index + 1;

            if ($current == 1 || (mobile_device == true && (index % 2 == 0))) {
                move_distance -= 8;
            } else if ($current == total_steps || (mobile_device == true && (index % 2 == 1))) {
                move_distance += 8;
            }

            if (mobile_device) {
                vertical_level = parseInt(index / 2);
                vertical_level = vertical_level * 38;
            }

            $wizard.find('.moving-tab').css('width', step_width);
            $('.moving-tab').css({
                'transform': 'translate3d(' + move_distance + 'px, ' + vertical_level + 'px, 0)',
                'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

            });
        }
    },
       initFormExtendedDatetimepickers: function() {
        $('.datetimepicker').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }

        });

        $('.datepicker').datetimepicker({
            format: 'MM/DD/YYYY',
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });

        $('.timepicker').datetimepicker({
            //          format: 'H:mm',    // use this format if you want the 24hours timepicker
            format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            }
        });
    },

    showNotification: function(from, align) {
        color = Math.floor((Math.random() * 4) + 1);

        $.notify({
            icon: "notifications",
            message: "Welcome to <b>Material Dashboard</b> - a beautiful freebie for every web developer."

        }, {
            type: type[color],
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    }
}