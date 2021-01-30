<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solar Oil Project</title>
    <link href="{{ asset('PublicArea/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container">
       <div class="row justify-content-center">
           <div class="col-lg-3" style="margin-top: 100px;">
            <img src="{{asset('PublicArea/images/logo.png')}}?{{ rand(1,9999) }}" alt="" style="width: 100%;"
            id="nav_logo">
           </div>
       </div>
       <div class="row">
       <div class="col-lg-12 text-center mt-4">
        <h1>500 ERROR</h1>
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    <h4 class="text-uppercase">Internal Server Error</h4>
                    <div class="mt-5 text-center">
                        <a class="btn btn-primary waves-effect waves-light" href="{{route('landing')}}">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
        
       </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>