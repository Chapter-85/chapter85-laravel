<script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/SmoothScroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.scrollTo.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.localScroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.viewport.mini.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.countTo.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.appear.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.sticky.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.parallax-1.1.3.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.fitvids.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/masonry.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/morphext.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.lazyload.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/all.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/contact-form.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('theme/dist/default/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
<!--[if lt IE 10]><script type="text/javascript" src="js/placeholder.js"></script><![endif]-->
<script>
    // forEach method
    var forEach = function(array, callback, scope) {
        for (var i = 0; i < array.length; i++) {
            callback.call(scope, i, array[i]);
        }
    };

    var spinner = document.querySelector("#spinner"),
        angle = 0,
        images = document.querySelectorAll("#spinner figure"),
        numpics = images.length,
        degInt = 360 / numpics,
        start = 0,
        current = 1;

    forEach(images, function(index, value) {
        images[index].style.webkitTransform = "rotateY(-" + start + "deg)";
        images[index].style.transform = "rotateY(-" + start + "deg)";
        images[index].addEventListener("click", function() {
            if (this.classList.contains('current')) {
                this.classList.toggle("focus");
            }
        })
        start = start + degInt;
    });

    function setCurrent(current) {
        document.querySelector('figure#spinner figure:nth-child(' + current + ')').classList.add('current');
        document.querySelector('figure#spinner figure:nth-child(' + current + ')').classList.add('focus');
    }

    function galleryspin(sign) {
        forEach(images, function(index, value) {
            images[index].classList.remove('current');
            images[index].classList.remove('focus');
            images[index].classList.remove('caption');
        })

        if (!sign) {
            angle = angle + degInt;
            current = (current + 1);
            if (current > numpics) {
                current = 1;
            }
        } else {
            angle = angle - degInt;
            current = current - 1;
            if (current == 0) {
                current = numpics;
            }
        }

        spinner.setAttribute("style", "-webkit-transform: rotateY(" + angle + "deg); transform: rotateY(" + angle +
            "deg); ");
        setCurrent(current);
    }

    $(document).on('click', '.show_paswd', function(e) {
        if ($('#password-input').attr('type') == 'text') {
            $('#password-input').attr('type', 'password');
        } else {
            $('#password-input').attr('type', 'text');
        }
    });

    document.body.onkeydown = function(e) {
        switch (e.which) {
            case 37: // left cursor
                galleryspin('-');
                break;

            case 39: // right cursor
                galleryspin('');
                break;

            case 90: // Z - zoom image in forefront image
                document.querySelector('figure#spinner figure.current').classList.toggle('focus');
                break;

            case 67: // C - show caption for forefront image
                document.querySelector('figure#spinner figure.current').classList.toggle('caption');
                break;

            default:
                return; // exit this handler for other keys
        }
        e.preventDefault();
    }

    setCurrent(1);
</script>
