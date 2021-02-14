/** Code By Webdevtrick ( https://webdevtrick.com ) **/
// Do this for every bar (will change to only selected bar)
$('.bar').each(function(i) {
    if (!$(this).hasClass('stackeder')) {
        $(this).width(parseFloat($(this).attr('data-percent')) * 4 + 112)
    } else {
        $(this).width(parseFloat($(this).attr('data-percent')) * 4)
    }
    if (!$(this).hasClass('.moving-bar')) {
        $(this).append('<span class="countx"></span>')
    }
});
$('.countx').each(function() {
    $(this).text($(this).parent('.bar').attr('data-percent'));
});
$('.bar').click(function() {
    $(this).addClass('moving-bar')
    var parClass = $(this).parent('.chart').attr('class').split(' ')[1]
    $('.countx').each(function() {
        if ($(this).parent('.bar').hasClass('class' + parClass)) {
            console.log('yay');
            $(this).parent('.bar').addClass('moving-bar');

        }
        if ($(this).parent('.bar').hasClass('moving-bar')) {
            $(this).text('');
            console.log('yay2');
        }

    });
    setTimeout(function() {

        function progress(timeleft, timetotal, $element) {

            if (!$element.hasClass('stackeder')) {
                var progressBarWidth = timeleft * 4 + 112;
            } else {
                var progressBarWidth = timeleft * 4;
            }


            console.log(progressBarWidth);
            console.log($element.attr('class').split(" "));
            $element.animate({ width: progressBarWidth }, 1000);
            $element.append('<span class="count"></span>')
            if (timeleft > 0) {
                setTimeout(function() {
                    progress(timeleft - 1, timetotal, $element);
                }, 1000); //Every second, rerun this to make the progress bar smaller
            } else {
                $element.addClass('finished')
            }

            /*$(this).append('<span class="count"></span>')
            setTimeout(function() {
                $bar.css('width', $bar.attr('data-percent'));
            }, i * 1000);*/
        }

        var $moving_time
        $('.moving-bar').each(function(i) {
            var $bar = $(this);
            $moving_time = parseInt($bar.attr('data-percent'))
            console.log($bar.attr('class'))
            progress(parseInt($bar.attr('data-percent')), 200, $bar);
        });
        $('.count').each(

            function() {

                $(this).prop('Counter', /*count from the percent*/ parseInt($(this).parent('.bar').attr('data-percent'))).animate({
                    Counter: 0 //count down to zero
                }, {
                    duration: $moving_time * 1000,
                    easing: 'linear',
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    }
                });


            });


    }, 500)
});