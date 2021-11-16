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
                                district = "Ba Đình";
                                break;
                            case "2":
                                district = "Đống Đa";
                                break;
                            case "3":
                                district = "Hai Bà Trưng";
                                break;
                            case "4":
                                district = "Cầu Giấy";
                                break;
                            case "5":
                                district = "Hoàn Kiếm";
                                break;
                            case "6":
                                district = "Tây Hồ";
                                break;
                        }
                        if (element.status == 1) {
                            status = "Đang sử dụng";
                        } else if (element.status == 2) {
                            status = "Đang thi công";
                        } else {
                            status = "Đang tu sửa";
                        }
                        listHTML += `<tr>
                                     <th scope="row">${element.id}</th>
                                     <td>${element.name}</td>
                                     <td>${district}</td>
                                     <td>Hà Nội</td>
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