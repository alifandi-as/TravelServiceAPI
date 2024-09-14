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
    <h1 class="title">Daftar Teman</h1>
    <a href="/profile" class="user-img">
        @if (auth()->check())
            <img src="{{url("/uploads/profile_pic/".auth()->user()->name)}}" class="rounded-circle user-profile-pic">
        @else
            <img src="{{url('default.png')}}" class="rounded-circle user-profile-pic">
        @endif
    </a>
    <form action="/kelasku/search" method="GET">
        <input type="text" name="q" id="search_field" class="input-box shadow" placeholder="🔎 Cari Teman">
    </form>
        <div class="login-box shadow-lg">
            <div class="login-container">
                <div class="row overflow-auto">
                    @foreach ($students->original as $key => $value)
                    <div class="col-lg-4 col-md-6">
                      <div class="card shadow">
                        <a href="/kelasku/view/{{$value["id"]}}" class="btn card-body">
                            <img src={{url("/uploads/profile_pic/".$value["name"])}} width="90vh" height="90vh" class="profile-pic rounded-circle shadow">
                          <h4 class="card-title">{{$value["name"]}}</h4>
                          <label class="card-text">{{$schools->original[$value["school_id"] - 1]["name"]}}</label>
                        </a>
                      </div>
                    </div>
                    @endforeach
                  </div>
            </div>


        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>
<style>
    body{
        background: linear-gradient(to bottom right, #82E2D6, #29839D);
        background-attachment: fixed;
        margin:0 auto;
    }
    .login-box{
        background-color: white;
        position: absolute;
        top: 27%;
        left: 50%;
        transform: translate(-50%, 0%);
        width: 100%;
        height: 73vh;
        border-radius: 7vh 7vh 0 0;
        justify-content: center;
        text-align: center;
        overflow-y: auto;
        padding-top: 3vh;
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
        bottom: 85vh;
        left: 8vh;
        border-radius: 5vh;
        text-align: left;
        text-shadow: 0px 3px rgba(0, 0, 0, .25);
    }

    .user-img{
      
        position: absolute;
        top: 5vh;
        right: 5vh;
    }

    .user-profile-pic{
        
        width: 8vh;
        height: 8vh;
    }

    #search_field{
        position: absolute;
        top: 17.5%;
        left: 50%;
        transform: translate(-50%, -17.5%);
        width: 80%;
        height: 7vh;
        border-radius: 2vh;
        font-size: 3vh;
        padding-left: 2vh;
    }

    .login-container{
        width: 90%;
        height: 100%;
        margin: 0 auto;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .row{
        width: 95%;
        margin: 0 auto;
        padding-bottom: 20px;
    }

    .card{
        margin: 1vh 0;
        border-radius: 3vh;
    }

    .card-body{
        background: #DCDCDC;
        text-decoration: none;
        text-align: left;
        border-radius: 3vh;
        box-shadow: 0px 4px rgba(0, 0, 0, .15);
        font-weight: bold;
    }

    .card-body:hover{
        background: #83aebc;
    }

    .card-body:active{
        background: #3395B4 !important;
    }

    .profile-pic{
        float: left;
        margin-right: 3vh;
    }

    .card-text{
        color: #747171;
    }
</style>
