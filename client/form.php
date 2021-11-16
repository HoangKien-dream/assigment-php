<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        #status{
            text-align: center;
            margin-top: 20px;
        }
        #district{
            margin-top: 20px;
            text-align: center;
        }
        .container{
            border: 1px solid black;
            margin-top: 300px;
        }
        .button{
            margin:20px 0;
            text-align: center;
        }
        .title{
            margin-top: 5px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="title">
        <h1>Form City</h1>
    </div>
    <form method="post" name="city-form" action="table.php">
        <div class="row">
            <div class="col-6" style="margin-top: 10px">
                Name Street <input class="form-control" type="text"  name="name" required>
            </div>
            <div class="col-6" style="margin-top: 10px">
                Founding <input class="form-control" type="date"  name="founding" required>
            </div>
            <div class="col-6">
                <select class="form-control" name="district" id="district" required>
                </select>
            </div>
            <div class="col-6">
                <select class="form-control" name="status" id="status" required>
                    <option>--- Status ---</option>
                    <option value="1">Đang sử dụng</option>
                    <option value="2">Đang thi công</option>
                    <option value="3">Đang tu sửa</option>
                </select>
            </div>
        </div>
        <div class="button">
            <button  type="submit" class="btn btn-primary btn-sm">Submit</button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        function loadData() {
            $.ajax({
                url: 'http://localhost:2910/city-manager/api/list-district.php',
                method: 'GET',
                success: function (data) {
                    console.log(data)
                    var districtHTML = ` <option>--- District ---</option>`;
                    data.forEach(element => {
                        districtHTML += `<option value="${element.id}">${element.name}</option>`;
                    });
                    $('#district').html(districtHTML);
                },
                error: function () {
                    alert("Error");
                }
            })
        }

        loadData();

        const inputName = $('input[name=name]');
        const inputDistrict = $('select[name=district]');
        const inputFounding = $('input[name=founding]');
        const inputStatus = $('select[name=status]');
        $('form[name=city-form]').submit(function (event) {
            event.preventDefault();
            let data = {
                name: inputName.val(),
                district: inputDistrict.val(),
                founding: inputFounding.val(),
                status: inputStatus.val()
            }
            console.log(data)
            $.ajax({
                url: 'http://localhost:2910/city-manager/api/store-city.php',
                method: 'POST',
                data: JSON.stringify(data),
                success: function (responseData) {
                    alert(responseData.message);
                    // loadData();
                },
                error: function () {

                }
            });
        });
    })
</script>
</body>
</html>
