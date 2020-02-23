<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản trị Samacom</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="loginColumns animated fadeInDown">
    <div class="row">

        <div class="col-md-6">
            <h2 class="font-bold">Welcome to Samacom system </h2>

            <p>
                Samacom trực thuộc Công ty Cổ phần đào tạo Nguồn nhân lực HRP Việt Nam, đơn vị tiên phong cung ứng và đào tạo nhân viên kinh doanh máu lửa, nhiệt huyết, có thái độ tốt và kỹ năng chuyên môn bài bản cho các doanh nghiệp, tổ chức tại Việt Nam.
            </p>

            <p>
                Sứ mệnh: Là đơn vị kết nối nhân sự về Sales với chất lượng và sự phù hợp tốt nhất cho các doanh nghiệp Việt Nam, nâng tầm sự phát triển của các doanh nghiệp Việt vươn tầm thế giới.
            </p>

        </div>
        <div class="col-md-6">
            <div class="ibox-content">
                <form class="m-t" role="form" action="{{url('/login')}}" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email hoặc số điện thoại">
                        @if($errors->has('email'))
                            <p class="text-danger pull-right">
                                {{$errors->first('email')}}
                            </p>
                        @endif
                        @if($errors->has('accountNotFound'))
                            <p class="text-danger pull-right">
                                {{ $errors->first('accountNotFound') }}
                            </p>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" value="{{ old('password') }}" name="password" placeholder="Password">
                        @if($errors->has('password'))
                            <p class="text-danger pull-right">
                                {{$errors->first('password')}}
                            </p>
                        @endif
                        @if($errors->has('messageErrorPassword'))
                            <p class="text-danger pull-right">
                                {{ $errors->first('messageErrorPassword') }}
                            </p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                </form>
                <p class="m-t">
                    <small>Thông tin liên lạc liên hệ SAMACOM TEAM</small>
                    <br/>
                    <small class="text-danger">Phone: 0868888336</small>
                </p>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            Copyright SAF Company
            <a href="https://samacom.com.vn">
                <small class="text-info"> Samacom</small>
            </a>
        </div>
        <div class="col-md-6 text-right">
            <small>© 2019-2020</small>
        </div>
    </div>
</div>

</body>

</html>
