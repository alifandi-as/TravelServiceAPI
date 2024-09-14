<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
        <div class="login-box shadow-lg">
            <div class="login-container">
                <h1>Selamat Datang!</h1><br>
                <a href="/login" class="input-btn btn btn-home">Login</a><br>
                <label>atau</label><br>
                <a href="/register" class="input-btn btn btn-home">Registrasi</a>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
<style>
    body{
        background: linear-gradient(turquoise, teal);
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
        border: 0.75vh solid lightgrey;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .btn-home{
        background-color: #227C99;
        color: white;
    }
    .btn-home:hover{
        background-color: #72CCF9
    }

    .input-box{
        margin: 5px;
        border-radius: 30px;
        padding-left: 5px;
    }

    .input-btn{
        margin: 5px;
        padding-left: 50px;
        padding-right: 50px;
        border-radius: 10px;
        box-shadow: 0px 5px #dddddd;
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
</style>
