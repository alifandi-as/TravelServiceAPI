<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <div class="decor"></div>
    <img src="{{url("/uploads/profile_pic/".auth()->user()->name.".jpg")}}" class="rounded-circle profile-pic">
    <div class="login-box shadow-lg">
        <div class="login-container">
            <div class="field-bg">{{auth()->user()->name}}</div>
            <div class="field-bg">{{$school->original}}</div>
            <div class="field-bg">+62 {{auth()->user()->telephone}}</div>
                <!--
                <a href="/" name="register" class="input-btn btn btn-secondary">Kembali</a>
                <a href="/edit" class="input-btn btn btn-primary">Edit</a>
                <a href="/process/logout" class="input-btn btn btn-warning">Logout</a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-danger delete-button">Hapus</a>
-->
            </form>
        </div>
    </div>
    <a href="/profile/edit" class="btn btn-primary btn-edit-profile">Edit Profile</a>
    <div class="action-container">
        <button type="button" data-bs-toggle="modal" data-bs-target="#logout_modal" class="btn btn-warning btn-action">Logout</button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-danger btn-action">Hapus</button>
        <a href="/profile/edit/password" class="btn btn-outline-primary btn-action">Edit Password</a>
    </div>
    <div class="page-container">
        <a href="/kelasku" class="btn btn-page" id="btn-page-kelasku">🏠︎</a>
        <a href="/notifications" class="btn btn-page" id="btn-page-notification">🔔</a>
        <button class="btn btn-page btn-disabled" id="btn-page-profile">🙍🏻‍♂️</button>
    </div>
    <div class="modal fade" id="logout_modal" tabindex="-1" aria-labelledby="logout_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="logout_modal_label">Keluar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin keluar dari akun ini?
                </div>
                <div class="modal-footer">
                    <form action="/process/logout" method="get">
                        @csrf
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                        <button name="id" id="confirm_logout" type="submit" value="" class="btn btn-warning">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="delete_modal_label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="delete_modal_label">Hapus</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus akun ini?
                </div>
                <div class="modal-footer">
                    <form action="/process/delete" method="post">
                        @csrf
                        <button name="id" id="confirm_delete" type="submit" value="" class="btn btn-danger">Ya</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
<style>
body{
        margin:0 auto;
        overflow: hidden; 
    }
    .login-box{
        background-color: white;
        position: absolute;
        top: 55%;
        left: 50%;
        transform: translate(-50%, -55%);
        width: 80%;
        height: 35%;
        border-radius: 5vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-weight: bold;
    }

    .login-container{
        width: 90%;
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

    .decor{
        border-radius: 0 0 5vh 5vh;
        background-color: white;
        position: absolute;
        top: 0%;
        left: 50%;
        transform: translate(-50%, 0%);
        width: 100%;
        height: 40%;
        background: linear-gradient(turquoise, teal);
        background-attachment: fixed;
    }

    .field-bg{
        width: 100%;
        font-size: 2.5vh;
        background-color: #D9D9D9;
        border-radius: 20px;
        padding: 1.5vh 0;
        margin: 2.5vh auto;
    }

    .btn-edit-profile{
        
        position: absolute;
        top: 32%;
        left: 90%;
        transform: translate(-90%, -32%);
        font-size: 2vh;
        border-radius: 20px;
        width: 20vh;
        margin: 2.5vh auto;
        font-weight: bold;
        box-shadow: 0px 5px rgba(0, 0, 0, 0.15);
    }

    .profile-pic{
        position: absolute;
        width: 20vh;
        height: 20vh;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -10%);
    }

    .action-container{
        position: absolute;
        width: 100%;
        bottom: 20%;
        left: 50%;
        transform: translate(-50%, 20%);
        text-align: center;
    }

    .btn-action{
        font-weight: bold;
        font-size: 2.5vh;
    }

    .page-container{
        position: absolute;
        width: 100%;
        bottom: 5%;
        left: 50%;
        transform: translate(-50%, 5%);
        text-align: center;
    }

    .btn-page{
        background: #227C99;
        color: white;
        font-weight: bold;
        font-size: 4vh;
        margin: -3px;
    }

    #btn-page-kelasku{
        border-radius: 50% 0 0 50%;
    }

    #btn-page-notification{
        border-radius: 0;
    }

    #btn-page-profile{
        border-radius: 0 50% 50% 0;
        background: #005A77;
    }
    .btn-disabled{
        color: black;
    }
</style>
