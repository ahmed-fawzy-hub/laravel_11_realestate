<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ErrorSolutionCode | Password Set</title>
    <style type="text/css">
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #edf1f2;
            padding: 0 10px;
        }
        .wrapper{
            background-color: #79b530;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 1) 
                        0 32px 64px -48px rgba(0, 0, 0, 5);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        .form{
            padding: 25px 30px;
        }
        .form header{
            font-size: 25px;
            font-weight: 600;
            margin-bottom: 10px;
            border-bottom: 1px solid #e6e6e6;
        }
        .form form {
            margin: 20px 0;
        }
        .form form .field{
            position: relative;
            margin-bottom: 10px ;
            flex-direction: column;
            display: flex;
        }
        .form form .field input{
            width: 100%;
            padding: 10px;
            outline: none;
            border: 1px solid #e6e6e6;
            border-radius: 6px;
        }
        .form form .field label{
            
            margin-bottom: 2px;
        }
        .form form .input input{
            height: 40px;
            font-size: 16px;
        width: 100%;
        padding: 0 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        }
        .form form .form input{
            border-color: #007bff;
        }
        .form form .button input{
            margin-top: 10px;
            height: 45px;
            border: none;
            font-size: 17px;
            background: #e40046;
            color: #fff;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            margin-top: 13px;
        }
        .form .link{
            text-align: center;
            margin: 10px 0;
            font-size: 17px;
        }
        .form .link a{
            color: #e40046;
        }
        .form .link a:hover{
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Reset Password</header>
            <form action="{{ url('set_new_password/'.$token) }}" method="post">
                {{ csrf_field() }}
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="field input">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <div class="field">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="token" value="{{ $token }}">
                </div>
                <div class="field button">
                    <input type="submit" value="RESET PASSWORD" style="margin-top: 23px;">
                </div>
            </form>
        </section>
        </div>
</body>
</html>