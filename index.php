<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="stylesheet" href="css/buttons.css" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <title>更新授权</title>
</head>

<body>
<div class="container-center content" onclick="goClose()">
    <div class="container-center operating" onclick="setCloseOk()">
        <div class="load-container"></div>
        <input type="file" name="file" id="upload_input" style="display: none">
        <button class="button button-glow button-action" id="openFile">选择文件上传</button>
        <div class="load">
            <div class="load-bar" style="width: 0%;" progress="0" id="load_bar"></div>
        </div>
    </div>
    <div class="container-center operating" onclick="setCloseOk()">
        <div class="password-receive">
            <input placeholder="输入秘钥，获取文件" id="key_input">
        </div>
        <button class="button button-glow button-royal"style="cursor:pointer id="openKey">文件上传成功</button>
    </div>
</div>
<div class="container-center">
    <h1 style="margin-bottom: 50px">更新授权文件</h1>
    <button class="button button-3d button-action btn-block" onclick="goOpenSend()">更新授权文件</button>

</div>

<script src="js/script.js"></script>
<script src="js/jquery.js"></script>
<script src="js/uploader.js"></script>
<script>
    var openFile = document.getElementById('openFile');
    var openKey = document.getElementById('openKey');
    var upload_input = document.getElementById('upload_input');
    var key_input = document.getElementById('key_input');
    //发送文件
    openFile.onclick = function () {
        upload_input.click();
    }
    //选中文件后上传
    upload_input.onchange = function () {
        document.getElementsByClassName('load')[0].style.display = 'block';
        var load_bar = document.getElementById('load_bar');
        //上传文件
        (new uploader($('#upload_input').get(0), {
            url: 'upload.php',
            error: function (err) {
                alert(err.message);
            },
            success: function (mes) {
                console.log(mes);
                key_input.value = mes.key;
                goOpenReceive();
            },
            progress: function (data) {
                load_bar.style.width = data.percent + '%';
            }
        })).start();
    }
    //接收文件
    openKey.onclick = function () {
        $.post('upload.php', {
            key: key_input.value,
        }, function (data) {
            if (data.status == 0) {
                window.location.href = data.message.value;
            } else {
                key_input.value = '';
                alert(data.message)
            }
        });
    }
</script>
</body>

</html>