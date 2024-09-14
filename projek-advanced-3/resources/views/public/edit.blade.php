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
        <div class="login-box">
            <div class="login-container">
                <h1>Halaman Edit</h1><br>
                <form action="users/edit" method="POST">
                    @csrf
                    <label>Nama:</label> <input type="text" required name="name" class="input-box" value={{auth()->user()->name}}><br>
                    <label>Email:</label> <input type="text" required name="email" class="input-box" value={{auth()->user()->email}}><br>
                    <label>Password Lama:</label><input type="password" required name="prior_password" class="input-box"><br>
                    <label>Password Baru:</label><input type="password" required name="password" class="input-box"><br>
                    
                    <a href="/profile" name="register" class="input-btn btn btn-secondary">Kembali</a>
                    <input type="submit" name="edit" value="Edit" class="input-btn btn btn-primary">
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
<style>
    body{
        background: url(https://images.squarespace-cdn.com/content/v1/61709486e77e1d27c181981c/d83dcb10-ebeb-4c82-ae65-5c2543ec823b/0223_UrbanSpace_ZeroIrving_LizClayman_166.png);
        background-size: cover;
        margin:0 auto;
    }
    .login-box{
        background-color: white;
        position: absolute;
        bottom: 50%;
        left: 90%;
        transform: translate(-90%, 50%);
        width: 40%;
        height: 65%;
        border-radius: 5%;
        border: 1vh solid grey;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .input-box{
        margin: 5px;
        border-radius: 30px;
        padding-left: 5px;
    }

    .input-btn{
        margin: 5px;
        border-radius: 10px;
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
