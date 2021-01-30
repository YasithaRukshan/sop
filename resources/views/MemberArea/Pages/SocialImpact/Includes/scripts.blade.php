<script src="{{asset('MemberArea/libs/amchart/core.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/charts.js')}}"></script>
<script src="{{asset('MemberArea/libs/amchart/animated.js')}}"></script>


<!-- Chart code -->
<script>
    $(document).ready(function () {
        var loader1 =
            '<div class="text-center spinner1 pt-4">  <div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> </div>';
        var loader2 =
            '<div class="text-center spinner2 pt-4">  <div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> </div>';
        var loader3 =
            '<div class="text-center spinner3 pt-4">  <div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> </div>';
        var loader4 =
            '<div class="text-center spinner4 pt-4">  <div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> </div>';
        var loader5 =
            '<div class="text-center spinner5 pt-4">  <div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> </div>';
        var loader6 =
            '<div class="text-center spinner6 pt-4">  <div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> </div>';
        $("#firtDiv2").html(loader1);
        $("#secondDiv2").html(loader2);
        $("#thirdDiv2").html(loader3);
        $("#fourthDiv2").html(loader4);
        $("#fifthDiv2").html(loader5);
        $("#sixthDiv2").html(loader6);
        setTimeout(function () {
            level1();
            $('.spinner1').fadeOut();
        }, 1000)
        setTimeout(function () {
            level2();
            $('.spinner2').fadeOut();
        }, 2500)
        setTimeout(function () {
            level3();
            $('.spinner3').fadeOut();
        }, 3500)
        setTimeout(function () {
            level4();
            $('.spinner4').fadeOut();
        }, 4500)
        setTimeout(function () {
            level5();
            $('.spinner5').fadeOut();
        }, 5500)
        setTimeout(function () {
            level6();
            $('.spinner6').fadeOut();
        }, 6500)
    });

</script>
@include('MemberArea.Pages.SocialImpact.Includes.Levels.level1')
@include('MemberArea.Pages.SocialImpact.Includes.Levels.level2')
@include('MemberArea.Pages.SocialImpact.Includes.Levels.level3')
@include('MemberArea.Pages.SocialImpact.Includes.Levels.level4')
@include('MemberArea.Pages.SocialImpact.Includes.Levels.level5')
@include('MemberArea.Pages.SocialImpact.Includes.Levels.level6')

<script>
    function collectPayment(reward_id, amount) {
        $.confirm({
            title: 'Are you sure,',
            content: "Do you want to collect ETH " + amount + " ",
            autoClose: 'cancel|8000',
            type: 'green',
            theme: 'material',
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
            buttons: {
                'Yes, Sure': function () {
                    $.ajax({
                        url: "{{ route('social.collect.rewards') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: {
                            reward_id: reward_id,
                        },
                        success: function (respond) {
                            location.reload();
                        }
                    });
                },
                cancel: function () {

                },

            }
        });
    }

    function collectAllPayment() {
        $.confirm({
            title: 'Are you sure,',
            content: "Do you want to collect all rewards ",
            autoClose: 'cancel|8000',
            type: 'green',
            theme: 'material',
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
            buttons: {
                'Yes, Sure': function () {
                    $.ajax({
                        url: "{{ route('social.collect.rewards.all') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        success: function (respond) {
                            location.reload();
                        }
                    });
                },
                cancel: function () {

                },

            }
        });
    }

</script>
