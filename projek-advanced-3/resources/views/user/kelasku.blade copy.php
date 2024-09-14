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
    <h1 class="category">Daftar Siswa</h1>
    <form action="/orders/buy" method="get">
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Sekolah</th>
            <th>Tindakan</th>
        </tr>

            @foreach($students->original as $key => $value)
                <tr>
                    <input type="hidden" name="id[]" value={{$value["id"]}}>
                    <td>{{$value["id"]}}</td>
                    <td><img src={{url("/uploads/profile_pic/".$value["name"].".jpg")}} width="200px"></td>
                    <td>{{$value["name"]}}</td>
                    <td>{{$schools->original[$value["school_id"] - 1]["name"]}}</td>
                    <td class="text-nowrap">
                        <a href="/kelasku/view/{{$value["id"]}}" type="button" data-bs-toggle="modal" data-bs-target="#delete_modal" class="btn btn-primary delete-button" data-id={{$value["id"]}}>Lihat</a>
                    </td>

                </tr>
            @endforeach
        </table>
    </form>
</body>
</html>

<style>
input[type=number]{
    width: 50px;
}
body{
        background: linear-gradient(turquoise, teal);
        background-attachment: fixed;
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
</style>