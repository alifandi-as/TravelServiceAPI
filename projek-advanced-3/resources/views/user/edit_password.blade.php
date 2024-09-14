<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
@if ($errors->any())
<div class="alert alert-danger error-box">
    <h1>Error</h1>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li><br>
        @endforeach
    </ul>
</div>
@endif
    <h1 class="title">Edit Password</h1>
    <a href="/profile" class="btn" id="btn-exit"><<</a>
        <div class="login-box shadow-lg">
            <div class="login-container">
                <div class="form-container">
                    <form action="/process/edit/password" method="POST">
                        @csrf
                        <label>Password Lama</label><br>
                        <input type="password" required name="old_password" class="input-box shadow-sm"><br>
                        <label>Password Baru</label><br>
                        <input type="password" required name="new_password" class="input-box shadow-sm"><br>
                        <label>Konfirmasi Password</label><br>
                        <input type="password" required name="confirmation_password" class="input-box shadow-sm"><br>
                        <input type="submit" name="edit" value="Simpan Perubahan" class="input-btn btn btn-login">
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
<style>
    body{
        background: linear-gradient(#AFF4E4, #29839D);
        background-attachment: fixed;
        margin:0 auto;
    }
    .login-box{
        background-color: white;
        position: absolute;
        bottom: 20%;
        left: 50%;
        transform: translate(-50%, 20%);
        width: 70%;
        height: 65%;
        border-radius: 5vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-weight: bold;
    }

    .btn-login{
        background: linear-gradient(to right, turquoise, teal);
        color: white;
        font-weight: bold;
    }

    .btn-login:hover{
        background: linear-gradient(to right, teal, black);
        color: white;
    }

    .input-box{
        margin: 5px;
        border-radius: 30px;
        padding-left: 5px;
        background-color: #EFEFEF;
    }

    .input-btn{
        margin: 5px;
        border-radius: 20px;
    }

    .error-box{
        position: absolute;
        bottom: 50%;
        left: 10%;
        transform: translate(-10%, 50%);
        width: 40%;
        /* border-radius: 5%; */
        padding: 20px;
    
    }
    

    .title{
        
        position: absolute;
        bottom: 72%;
        left: 15%;
        border-radius: 5vh;
        text-align: left;
        text-shadow: 0px 3px rgba(0, 0, 0, .25);
    }

#btn-exit{
    position: absolute;
    top: 2vh;
    left: 2vh;
    font-weight: bold;
    font-size: 24px;
}
</style>
