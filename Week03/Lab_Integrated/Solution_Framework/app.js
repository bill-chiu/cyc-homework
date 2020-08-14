// 以 Express 建立 Web伺服器
var express = require("express");
var app = express();

// 以 body-parser 模組協助 Express 解析表單與JSON資料
var bodyParser = require('body-parser');
app.use( bodyParser.json() );
app.use( bodyParser.urlencoded({extended: false}) );

// Web伺服器的靜態檔案置於 public 資料夾
app.use( express.static( "public" ) );

// 以 express-session 管理狀態資訊
var session = require('express-session');
app.use(session({
    secret: 'secretKey',
    resave: false,
    saveUninitialized: true
}));

// 指定 esj 為 Express 的畫面處理引擎
app.set('view engine', 'ejs');
app.engine('html', require('ejs').renderFile);
app.set('views', __dirname + '/view');

// 一切就緒，開始接受用戶端連線
app.listen(process.env.PORT);
console.log("Server is running... Press 'Stop' button to exit.");

// 路由設定:
// 格式:  /controllerName/actionName
app.get("/", function (request, response) {
    doControllerAction("home", "index", request, response);
});

app.get("/:controllerName", function (request, response) {
    var controllerName = request.params.controllerName;
    var actionName = request.params.actionName;
    doControllerAction(controllerName, "index", request, response);
});

app.get("/:controllerName/:actionName", function (request, response) {
    var controllerName = request.params.controllerName;
    var actionName = request.params.actionName;
    doControllerAction(controllerName, actionName, request, response);
});

// Clinet 端送來的 POST 請求，各 controller 以 post_actionName 負責處理
// 例如: 
// 1. Client 以 GET /member/login 取得登入表單
// 2. 登入表單以 POST 傳送表單資料到 /member/login，
//    以 post_login 函式處理
app.post("/", function (request, response) {
    doControllerAction("home", "post_index", request, response);
});

app.post("/:controllerName", function (request, response) {
    var controllerName = request.params.controllerName;
    var actionName = request.params.actionName;
    doControllerAction(controllerName, "post_index", request, response);
});

app.post("/:controllerName/:actionName", function (request, response) {
    var controllerName = request.params.controllerName;
    var actionName = "post_" + request.params.actionName;
    doControllerAction(controllerName, actionName, request, response);
});

app.put("/:controllerName/:actionName", function (request, response) {
    var controllerName = request.params.controllerName;
    var actionName = "put_" + request.params.actionName;
    doControllerAction(controllerName, actionName, request, response);
});

app.delete("/:controllerName/:actionName", function (request, response) {
    var controllerName = request.params.controllerName;
    var actionName = "delete_" + request.params.actionName;
    doControllerAction(controllerName, actionName, request, response);
});


// 呼叫 controller.action() 以處理 Client 端送來的請求
function doControllerAction(controllerName, actionName, request, response) {
    var moduleName = "./controller/" + controllerName + ".js";
    var controllerClass = require(moduleName);
    var controller = new controllerClass(request, response, controllerName);
    controller[actionName]();    
}
