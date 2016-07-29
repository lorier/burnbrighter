jQuery( function($){
    // The carousel widget
    $('.tw-carousel-wrapper').each(function(){

        var $$ = $(this),
            $postsContainer = $$.closest('.tw-carousel-container'),
            $container = $$.closest('.tw-carousel-container').parent(),
            $itemsContainer = $$.find('.tw-carousel-items'),
            $items = $$.find('.tw-carousel-item'),
            $firstItem = $items.eq(0);

        var position = 0,
            page = 1,
            fetching = false,
            numItems = $items.length,
            totalPosts = $$.data('found-posts'),
            complete = numItems == totalPosts,
            itemWidth = ( $firstItem.width() + parseInt($firstItem.css('margin-right')) ),
            isRTL = $postsContainer.hasClass('js-rtl'),
            updateProp = isRTL ? 'margin-right' : 'margin-left';

        $('.tw-carousel-nav.left').hide();

                console.log( 'totalPosts at beginning: ' + totalPosts);

        var updatePosition = function(){
            //don't go back before the beginning
            if ( position < 0  ) position = 0;

            //don't go past the end
            if ( position >= (totalPosts - 1) ){
                position = ( totalPosts - 2 );
            }
            $itemsContainer.css('transition-duration', "0.45s");
            
            $itemsContainer.css(updateProp, -( (itemWidth) * position) + 'px' );

            // if ( position >= $$.find('.tw-carousel-item').length - 1 ) {
            //     position = $$.find('.tw-carousel-item').length - 1;
            //     
            updateControls(position, numItems);
        };

        // var updatePositionAjax = function() {


        //         // Fetch the next batch
        //         if( !fetching &&  !complete ) {
        //             fetching = true;
        //             page++;
        //             $itemsContainer.append('<li class="tw-carousel-item tw-carousel-loading"></li>');

        //             $.get(
        //                 $$.data('ajax-url'),
        //                 {
        //                     query : $$.data('query'),
        //                     action : 'tw_carousel_load',
        //                     paged : page
        //                 },
        //                 function (data, status){
        //                     var $items = $(data.html);
        //                     $items.appendTo( $itemsContainer ).hide().fadeIn();
        //                     $$.find('.tw-carousel-loading').remove();
        //                     numItems = $$.find('.tw-carousel-item').length;
        //                     complete = numItems == totalPosts;
        //                     fetching = false;
        //                 }
        //             )
        //         }
        //     $itemsContainer.css('transition-duration', "0.45s");
            
        //     $itemsContainer.css(updateProp, -( (itemWidth) * position) + 'px' );
        //     updateControls(position, numItems);
            
        // };
        var updateControls = function(position, totalPosts){
            console.log("totalPosts: " + totalPosts);
            console.log("position: " + position);
                if (position >= totalPosts-2){
                    $('.tw-carousel-nav.right').hide();
                }else {$('.tw-carousel-nav.right').show();}

                if (position <= 0){
                    $('.tw-carousel-nav.left').hide();
                }else {$('.tw-carousel-nav.left').show();}
        };

        $container.on( 'click', 'a.tw-carousel-nav.left',
            function(e){
                e.preventDefault();
                position -= isRTL ? -1 : 1;
                updatePosition();
            }
        );

        $container.on( 'click', 'a.tw-carousel-nav.right',
            function(e){
                e.preventDefault();
                position += isRTL ? -1 : 1;
                console.log("clickhandler: " + position);
                updatePosition();
            }
        );
        var validSwipe = false;
        var prevDistance = 0;
        var startPosition = 0;
        var velocity = 0;
        var prevTime = 0;
        var posInterval;
        var negativeDirection = isRTL ? 'right' : 'left';
        
        // Verify "swipe" method exists prior to invoking it.
        if( 'function' === typeof $$.swipe ) {
        	$$.swipe( {
	            excludedElements: "",
	            triggerOnTouchEnd: true,
	            threshold: 75,
	            swipeStatus: function (event, phase, direction, distance, duration, fingerCount, fingerData) {
	                if ( phase == "start" ) {
	                    startPosition = -( itemWidth * position);
	                    prevTime = new Date().getTime();
	                    clearInterval(posInterval);
	                }
	                else if ( phase == "move" ) {
	                    if( direction == negativeDirection ) distance *= -1;
	                    setNewPosition(startPosition + distance);
	                    var newTime = new Date().getTime();
	                    var timeDelta = (newTime - prevTime) / 1000;
	                    velocity = (distance - prevDistance) / timeDelta;
	                    prevTime = newTime;
	                    prevDistance = distance;
	                }
	                else if ( phase == "end" ) {
	                    validSwipe = true;
	                    if( direction == negativeDirection ) distance *= -1;
	                    if(Math.abs(velocity) > 400) {
	                        velocity *= 0.1;
	                        var startTime = new Date().getTime();
	                        var cumulativeDistance = 0;
	                        posInterval = setInterval(function () {
	                            var time = (new Date().getTime() - startTime) / 1000;
	                            cumulativeDistance += velocity * time;
	                            var newPos = startPosition + distance + cumulativeDistance;
	                            var decel = 30;
	                            var end = (Math.abs(velocity) - decel) < 0;
	                            if(direction == negativeDirection) {
	                                velocity += decel;
	                            } else {
	                                velocity -= decel;
	                            }
	                            if(end || !setNewPosition(newPos)) {
	                                clearInterval(posInterval);
	                                setFinalPosition();
	                            }
	                        }, 20);
	                    } else {
	                        setFinalPosition();
	                    }
	                }
	                else if( phase == "cancel") {
	                    updatePosition();
	                }
	            }
	        } );
        }
        
        
        var setNewPosition = function(newPosition) {
            if(newPosition < 50 && newPosition >  -( itemWidth * numItems )) {
                $itemsContainer.css('transition-duration', "0s");
                $itemsContainer.css(updateProp, newPosition + 'px' );
                return true;
            }
            return false;
        };
        var setFinalPosition = function() {
            var finalPosition = parseInt( $itemsContainer.css(updateProp) );
            position = Math.abs( Math.round( finalPosition / itemWidth ) );
            updatePosition();
        };
        $$.on('click', '.tw-carousel-item a',
            function (event) {
                if(validSwipe) {
                    event.preventDefault();
                    validSwipe = false;
                }
            }
        )
    } );
} );
