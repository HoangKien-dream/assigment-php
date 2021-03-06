<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid m-5">
    <form action="" name="filter" method="get">
        <div class="row">
            <div class=" col-5">
                <label for="search">Searching</label>
                <input type="text" class="form-control" id="search" name="search">
            </div>
        </div>
        <button class="btn btn-dark" style="margin-top: 10px">Filter</button>
    </form>
</div>
<table class="table">
    <thead class="thead-dark">
    <tr>
        <th class="col-1">#</th>
        <th class="col-2">
            Street names
        </th>
        <th class="col-1">District</th>
        <th class="col-1">City</th>
        <th class="col-1">CreateAt</th>
        <th class="col-1">Status</th>
    </tr>
    </thead>
    <tbody id="list">
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
       $('form[name=filter]').submit(function (event){
           event.preventDefault();
           loadData();
       })
        function loadData() {
            const inputSearch = $('input[name=search]');
                let data = {
                    search: inputSearch.val()
                }
            $.ajax({
                url: 'http://localhost:2910/city-manager/api/list-city.php',
                method: 'GET',
                data: data,
                success: function (data) {
                    var districtHTML =`<option>---District---</option>`;
                    var listHTML = '';
                    let status = "";
                    let district = "";
                    data.forEach(element => {
                        switch (element.districtId){
                            case "1":
                                district = "Ba ????nh";
                                break;
                            case "2":
                                district = "?????ng ??a";
                                break;
                            case "3":
                                district = "Hai B?? Tr??ng";
                                break;
                            case "4":
                                district = "C???u Gi???y";
                                break;
                            case "5":
                                district = "Ho??n Ki???m";
                                break;
                            case "6":
                                district = "T??y H???";
                                break;
                        }
                        if (element.status == 1) {
                            status = "??ang s??? d???ng";
                        } else if (element.status == 2) {
                            status = "??ang thi c??ng";
                        } else {
                            status = "??ang tu s???a";
                        }
                        listHTML += `<tr>
                                     <th scope="row">${element.id}</th>
                                     <td>${element.name}</td>
                                     <td>${district}</td>
                                     <td>H?? N???i</td>
                                     <td>${element.date}</td>
                                     <td>${status}</td>
                                      </tr>`;
                    });
                    $('#list').html(listHTML);
                },
                error: function () {
                    alert("Error");
                }
            })
        }
        loadData();
    })
</script>
</body>
</html>