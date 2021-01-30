<!--Plugin JavaScript file-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>
    $(document).ready(function () {
        $("video").get(0).play();

        revnue();
    });

    $("#priceOfOil").ionRangeSlider({
        skin: "round",
        min: 1000,
        max: 1000000,
        from: 300000,
        step: 1, // default 1 (set step)
        grid: false, // default false (enable grid)
        onChange: function (data) {
            revnue();
        },
    });
    $("#wtiPrice").ionRangeSlider({
        skin: "round",
        min: 35,
        max: 120,
        from: 67,
        step: 1, // default 1 (set step)
        grid: true, // default false (enable grid)
        grid_num: 17, // default 4 (set number of grid cells)
        grid_snap: false, // default false (snap grid to step)
        onChange: function (data) {
            revnue();
        },
    });
    $("#avgOilRecovery").ionRangeSlider({
        skin: "round",
        min: 310,
        max: 450,
        from: 350,
        step: 10, // default 1 (set step)
        grid: true, // default false (enable grid)
        grid_num: 14, // default 4 (set number of grid cells)
        grid_snap: false, // default false (snap grid to step)
        onChange: function (data) {
            revnue();
        },
    });
    /**
     *
     * calculate revenue
     */
    function revnue() {
        var lsx = ($('#priceOfOil').val());
        var awti = ($('#wtiPrice').val());
        var aorp = ($('#avgOilRecovery').val());
        var lsorewards = ((lsx * 3650) * (aorp / 1000000)) / 100
        var euv = (lsorewards * (awti - 18))
        lsorewards = numberFormat(lsorewards)
        euv = numberFormat(euv)
        $('#lso-rewards').html(lsorewards);
        $('#euv-display').html(euv);
    }
    $('[data-bgimgset]').each(function () {
        var bgImgUrl = $(this).data('bgimgset');
        $(this).css({
            'background-image': 'url(' + bgImgUrl + ')',
        });
    });

    function numberFormat(value) {
        return Number(parseFloat(value).toFixed(2)).toLocaleString('en', {
            minimumFractionDigits: 2
        });
    }

    function numberFormatWithComma(value) {
        return Number(value).toLocaleString('en');
    }

    var url_string = window.location.href
    var url = new URL(url_string);
    var referralvalue = url.searchParams.get("a");
    setCookie("referralId", referralvalue, 180);
    getCookie("referralId");

    $(function () {
        $('.lazy').lazy();
    });

    

</script>
