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
    <a href="/kelasku" class="btn" id="btn-exit"><<</a>
    <div class="action-container">
        <a href="/process/poke/{{$student->original["id"]}}" class="btn btn-action btn-secondary shadow" id="btn-poke">Poke</button>
        <a href="https://api.whatsapp.com/send?phone=62{{$student->original["telephone"]}}" class="btn btn-action shadow" id="btn-whatsapp">WA</a>
    </div>
    <img src="{{url("/uploads/profile_pic/".$student->original['name'].".jpg")}}" class="rounded-circle profile-pic">
    <div class="login-box shadow-lg">
        <div class="login-container">
            <h1 id="view-title">{{$student->original["name"]}}</h1>
            <div class="field-bg">{{$school->original}}</div>
            <div class="field-bg">+62 {{$student->original["telephone"]}}</div>
                <!--
                <a href="/" name="register" class="input-btn btn btn-secondary">Kembali</a>
                <a href="/edit" class="input-btn btn btn-primary">Edit</a>
                <a href="/process/logout" class="input-btn btn btn-warning">Logout</a>
                <button type="button" data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-danger delete-button">Hapus</a>
-->
            </form>
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
        bottom: 15%;
        left: 50%;
        transform: translate(-50%, 15%);
        width: 80%;
        height: 50%;
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
        height: 50%;
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

    .profile-pic{
        position: absolute;
        width: 20vh;
        height: 20vh;
        top: 10%;
        left: 50%;
        transform: translate(-50%, -10%);
    }

#btn-exit{
    position: absolute;
    top: 2vh;
    left: 2vh;
    font-weight: bold;
    font-size: 24px;
}

#view-title{
  margin-bottom: 7vh;
  font-size: 5vh;
  font-weight: bold;
}

.action-container{
    position: absolute;
    width: 100%;
    top: 35%;
    left: 50%;
    transform: translate(-50%, -35%);
    text-align: center;
}

#btn-poke{
  border-radius: 3vh;
  color: white;
  background: #FF842B;
  margin: 0 0.5vh;
}

#btn-poke{
  border-radius: 3vh;
  color: white;
  background: #FF842B;
  margin: 0 0.5vh;
}

#btn-whatsapp{
  border-radius: 50%;
  background: #CEFFC1;
  margin: 0 0.5vh;
}

.btn-action{
    font-weight: bold;
    font-size: 2.5vh;
}
</style>
