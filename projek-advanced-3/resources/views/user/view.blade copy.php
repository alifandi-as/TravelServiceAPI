<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href={{asset('/assets/css/app.css')}}>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <x-layout.header>

        {{-- <ul class="dropdown-menu">
            @foreach($category->original as $key => $value)
                <li><a href={{"?category_id=".$value["id"]}} class="dropdown-item" >{{$value["category"]}}</a></li>
            @endforeach
        </ul> --}}
    </x-layout.header>

    <div class="order-page">
        <h1>Tes</h1>
        <div class="profile">
                <img src="{{url("/uploads/profile_pic/".$student->original["name"].".jpg")}}" class="rounded-circle float-start profile-img">
                <div class="view">

                    <h1>{{$student->original["name"]}}</h1>
                    <table class="table">
                    <tr>
                        <th>Sekolah</th>
                        <td>{{$school->original}}</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td>+62 {{$student->original["telephone"]}}</td>
                    </tr>
                    <tr>
                        <th>Tindakan</th>
                        <td>
                            <a href="process/poke/{{$student->original["id"]}}">Colek</a>
                            <a href="https://api.whatsapp.com/send?phone=62{{$student->original["telephone"]}}">WA</a>
                        </td>
                    </tr>
                    </table>
                    <a href="/kelasku" type="button" class="btn btn-primary">Kembali</a>
                </div>
          </div>
    </div>
</body>
</html>

<style>
input[type=number]{
    width: 50px;
}
body{
    background: #aaf;
}
.order-page{
    text-align: center;
    padding: 15px;

    position: relative;
    /* display: flex;
    justify-content: center; */
}
.container{
    position: absolute;
    left: 50%;
    transform: translate(-50%);
}

.category{
    margin-top: 10px;
    margin-bottom: 25px;
}

#quantity{
    width: 40px;
}



.custom-select {
  position: relative;
  font-family: Arial;
}

.custom-select select {
  display: none; /*hide original SELECT element:*/
}

.select-selected {
  background-color: DodgerBlue;
}

/*style the arrow inside the select element:*/
.select-selected:after {
  position: absolute;
  content: "";
  top: 14px;
  right: 10px;
  width: 0;
  height: 0;
  border: 6px solid transparent;
  border-color: #fff transparent transparent transparent;
}

/*point the arrow upwards when the select box is open (active):*/
.select-selected.select-arrow-active:after {
  border-color: transparent transparent #fff transparent;
  top: 7px;
}

/*style the items (options), including the selected item:*/
.select-items div,.select-selected {
  color: #ffffff;
  padding: 8px 16px;
  border: 1px solid transparent;
  border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
  cursor: pointer;
  user-select: none;
}

/*style items (options):*/
.select-items {
  position: absolute;
  background-color: DodgerBlue;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 99;
}

/*hide the items when the select box is closed:*/
.select-hide {
  display: none;
}

.select-items div:hover, .same-as-selected {
  background-color: rgba(0, 0, 0, 0.1);
}

.profile{
  margin: auto;
  width: 50%;
}
.profile-img{
  width: 250px;
  height: 250px;
  margin-right: 50px;
  float: left;
}
.picture{
  width: 250px;
  height: 250px;
  margin-right: 50px;
}
.table{
  width: 400px;
}
.view{
    float: right;
}
</style>