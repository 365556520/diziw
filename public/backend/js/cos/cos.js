var config = {
    Bucket: 'diziw-1251899486',
    Region: 'ap-beijing'
};

var util = {
    createFile: function (options) {
        var buffer = new ArrayBuffer(options.size || 0);
        var arr = new Uint8Array(buffer);
        [].forEach.call(arr, function (char, i) {
            arr[i] = 0;
        });
        var opt = {};
        options.type && (opt.type = options.type);
        var blob = new Blob([buffer], options);
        return blob;
    }
};

var getAuthorization = function (options, callback) {
    // 方法一、后端通过获取临时密钥，计算签名给到前端（适用于前端调试）
  /*  var method = (options.Method || 'get').toLowerCase();
    var key = options.Key || '';
    var query = options.Query || {};
    var headers = options.Headers || {};
    var pathname = key.indexOf('/') === 0 ? key : '/' + key;
    // var url = 'http://127.0.0.1:3000/sts';
    var url = '../server/sts.php';
    var xhr = new XMLHttpRequest();
    var data = {
        method: method,
        pathname: pathname,
        query: query,
        headers: headers,
    };
    xhr.open('POST', url, true);
    xhr.setRequestHeader('content-type', 'application/json');
    xhr.onload = function (e) {
        try {
            var AuthData = JSON.parse(e.target.responseText);
        } catch (e) {
        }
        callback({
            Authorization: AuthData.authorization,
            XCosSecurityToken: AuthData.sessionToken,
        });
    }; xhr.send(JSON.stringify(data));*/
    // 方法二、后端计算签名（推荐）
/*    var method = (options.Method || 'get').toLowerCase();
    var key = options.Key || '';
    var query = options.Query || {};
    var headers = options.Headers || {};
    var pathname = key.indexOf('/') === 0 ? key : '/' + key;

    //var url = '../server/auth.php';
    var xhr = new XMLHttpRequest();
    var data = {
        method: method,
        pathname: pathname,
        query: query,
        headers: headers,
    };
    xhr.open('POST', url, true);
    xhr.setRequestHeader('content-type', 'application/json');
    xhr.onload = function (e) {
        console.log('晚上好'+e);
        callback(e.target.responseText);
    };
    xhr.send(JSON.stringify(data));*/
    var url = 'http://www.diziw.cn/admin/getobjkey'
    $.ajax({
        type:"POST",
        url:url,
        dataType:"json",
        success:function(data){
            // 方法三、前端计算签名（适用于前端调试）
            var authorization = COS.getAuthorization({
                SecretId: data.credentials.secretId,
                SecretKey: data.credentials.secretKey,
            });
            callback(authorization);
        },
        error:function(jqXHR){
            console.log("Error: "+jqXHR.status);
        }
    });
};

var cos = new COS({
    getAuthorization: getAuthorization,
});
var TaskId;


var logger = function (text, color) {
    if (typeof text === 'object') {
        try {
            text = JSON.stringify(text);
        } catch (e) {
        }
    }

};
console._log = console.log;
console._error = console.error;
console.log = function (text) {
    console._log.apply(console, arguments);
    logger(text);
};
console.error = function (text) {
    console._error.apply(console, arguments);
    logger(text, 'red');
};

function getAuth() {
    var key = '1mb.zip';
    getAuthorization({
        Method: 'get',
        Key: key
    }, function (auth) {
        // 注意：这里的 Bucket 格式是 test-1250000000
        console.log('http://' + config.Bucket + '.cos.' + config.Region + '.myqcloud.com' + '/' + key + '?sign=' + encodeURIComponent(auth));
    });
}

//获取某个对象的url
function getObjectUrl() {
    var url = cos.getObjectUrl({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Key: '1mb.zip',
        Expires: 60,
        Sign: true,
    }, function (err, data) {
        console.log(err || data);
    });
    console.log(url);
}

function getBucket() {
    cos.getBucket({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function headBucket() {
    cos.headBucket({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function putBucketAcl() {
    cos.putBucketAcl({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        // GrantFullControl: 'id="qcs::cam::uin/1001:uin/1001",id="qcs::cam::uin/1002:uin/1002"',
        // GrantWrite: 'id="qcs::cam::uin/1001:uin/1001",id="qcs::cam::uin/1002:uin/1002"',
        // GrantRead: 'id="qcs::cam::uin/1001:uin/1001",id="qcs::cam::uin/1002:uin/1002"',
        // GrantReadAcp: 'id="qcs::cam::uin/1001:uin/1001",id="qcs::cam::uin/1002:uin/1002"',
        // GrantWriteAcp: 'id="qcs::cam::uin/1001:uin/1001",id="qcs::cam::uin/1002:uin/1002"',
        // ACL: 'public-read-write',
        // ACL: 'public-read',
        ACL: 'private',
        // AccessControlPolicy: {
        // "Owner": { // AccessControlPolicy 里必须有 owner
        //     "ID": 'qcs::cam::uin/459000000:uin/459000000' // 459000000 是 Bucket 所属用户的 QQ 号
        // },
        // "Grants": [{
        //     "Grantee": {
        //         "ID": "qcs::cam::uin/1001:uin/1001", // 10002 是 QQ 号
        //         "DisplayName": "qcs::cam::uin/1001:uin/1001" // 10002 是 QQ 号
        //     },
        //     "Permission": "READ"
        // }, {
        //     "Grantee": {
        //         "ID": "qcs::cam::uin/10002:uin/10002", // 10002 是 QQ 号
        //     },
        //     "Permission": "WRITE"
        // }, {
        //     "Grantee": {
        //         "ID": "qcs::cam::uin/10002:uin/10002", // 10002 是 QQ 号
        //     },
        //     "Permission": "READ_ACP"
        // }, {
        //     "Grantee": {
        //         "ID": "qcs::cam::uin/10002:uin/10002", // 10002 是 QQ 号
        //     },
        //     "Permission": "WRITE_ACP"
        // }]
        // }
    }, function (err, data) {
        console.log(err || data);
    });
}

function getBucketAcl() {
    cos.getBucketAcl({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function putBucketCors() {
    cos.putBucketCors({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        CORSConfiguration: {
            "CORSRules": [{
                "AllowedOrigin": ["*"],
                "AllowedMethod": ["GET", "POST", "PUT", "DELETE", "HEAD"],
                "AllowedHeader": ["*"],
                "ExposeHeader": ["ETag", "x-cos-acl", "x-cos-version-id", "x-cos-delete-marker", "x-cos-server-side-encryption"],
                "MaxAgeSeconds": "5"
            }]
        }
    }, function (err, data) {
        console.log(err || data);
    });
}

function getBucketCors() {
    cos.getBucketCors({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function deleteBucketCors() {
    cos.deleteBucketCors({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function putBucketTagging() {
    cos.putBucketTagging({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Tagging: {
            "Tags": [
                {"Key": "k1", "Value": "v1"},
                {"Key": "k2", "Value": "v2"}
            ]
        }
    }, function (err, data) {
        console.log(err || data);
    });
}

function getBucketTagging() {
    cos.getBucketTagging({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function deleteBucketTagging() {
    cos.deleteBucketTagging({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function putBucketPolicy() {
    var AppId = config.Bucket.substr(config.Bucket.lastIndexOf('-') + 1);
    cos.putBucketPolicy({
        Policy: {
            "version": "2.0",
            "principal": {"qcs": ["qcs::cam::uin/10001:uin/10001"]}, // 这里的 10001 是 QQ 号
            "statement": [
                {
                    "effect": "allow",
                    "action": [
                        "name/cos:GetBucket",
                        "name/cos:PutObject",
                        "name/cos:PostObject",
                        "name/cos:PutObjectCopy",
                        "name/cos:InitiateMultipartUpload",
                        "name/cos:UploadPart",
                        "name/cos:UploadPartCopy",
                        "name/cos:CompleteMultipartUpload",
                        "name/cos:AbortMultipartUpload",
                        "name/cos:AppendObject"
                    ],
                    // "resource": ["qcs::cos:ap-guangzhou:uid/1250000000:test-1250000000/*"] // 1250000000 是 appid
                    "resource": ["qcs::cos:" + config.Region + ":uid/" + AppId + ":" + config.Bucket + "/*"] // 1250000000 是 appid
                }
            ]
        },
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function getBucketPolicy() {
    cos.getBucketPolicy({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function getBucketLocation() {
    cos.getBucketLocation({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function putBucketLifecycle() {
    cos.putBucketLifecycle({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        LifecycleConfiguration: {
            "Rules": [{
                'ID': 1,
                'Filter': {
                    'Prefix': 'test123',
                },
                'Status': 'Enabled',
                'Transition': {
                    'Date': '2016-10-31T00:00:00+08:00',
                    'StorageClass': 'STANDARD_IA'
                }
            }]
        }
    }, function (err, data) {
        console.log(err || data);
    });
}

function getBucketLifecycle() {
    cos.getBucketLifecycle({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function deleteBucketLifecycle() {
    cos.deleteBucketLifecycle({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function putBucketVersioning() {
    cos.putBucketVersioning({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        VersioningConfiguration: {
            MFADelete: "Enabled",
            Status: "Enabled"
        }
    }, function (err, data) {
        console.log(err || data);
    });
}

function getBucketVersioning() {
    cos.getBucketVersioning({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function listObjectVersions() {
    cos.listObjectVersions({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Prefix: "1mb.zip"
    }, function (err, data) {
        console.log(err || JSON.stringify(data.Versions, null, '    '));
    });
}

function putBucketReplication() {
    var AppId = config.Bucket.substr(config.Bucket.lastIndexOf('-') + 1);
    cos.putBucketReplication({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        ReplicationConfiguration: {
            Role: "qcs::cam::uin/459000000:uin/459000000",
            Rules: [{
                ID: "1",
                Status: "Enabled",
                Prefix: "img/",
                Destination: {
                    Bucket: "qcs::cos:ap-guangzhou::test-" + AppId
                },
            }]
        }
    }, function (err, data) {
        console.log(err || data);
    });
}

function getBucketReplication() {
    cos.getBucketReplication({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function deleteBucketReplication() {
    cos.deleteBucketReplication({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region
    }, function (err, data) {
        console.log(err || data);
    });
}

function deleteBucket() {
    cos.deleteBucket({
        Bucket: 'testnew-' + config.Bucket.substr(config.Bucket.lastIndexOf('-') + 1),
        Region: 'ap-guangzhou'
    }, function (err, data) {
        console.log(err || data);
    });
}

function putObject() {
    // 创建测试文件
    var filename = '1mb.zip';
    var blob = util.createFile({size: 1024 * 1024 * 1});
    // 调用方法
    cos.putObject({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Key: filename, /* 必须 */
        Body: blob,
        TaskReady: function (tid) {
            TaskId = tid;
        },
        onProgress: function (progressData) {
            console.log(JSON.stringify(progressData));
        },
    }, function (err, data) {
        console.log(err || data);
    });
}

function putObjectCopy() {
    cos.putObjectCopy({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Key: '1mb.copy.zip',
        CopySource: config.Bucket + '.cos.' + config.Region + '.myqcloud.com/1mb.zip', // Bucket 格式：test-1250000000
    }, function (err, data) {
        console.log(err || data);
    });
}

function getObject() {
    cos.getObject({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Key: '1mb.zip',
    }, function (err, data) {
        console.log(err || data);
    });
}

function headObject() {
    cos.headObject({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Key: '1mb.zip'
    }, function (err, data) {
        console.log(err || data);
    });
}

function putObjectAcl() {
    cos.putObjectAcl({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Key: '1mb.zip',
        // GrantFullControl: 'id="qcs::cam::uin/1001:uin/1001",id="qcs::cam::uin/1002:uin/1002"',
        // GrantWrite: 'id="qcs::cam::uin/1001:uin/1001",id="qcs::cam::uin/1002:uin/1002"',
        // GrantRead: 'id="qcs::cam::uin/1001:uin/1001",id="qcs::cam::uin/1002:uin/1002"',
        // ACL: 'public-read-write',
        // ACL: 'public-read',
        // ACL: 'private',
        ACL: 'default', // 继承上一级目录权限
        // AccessControlPolicy: {
        //     "Owner": { // AccessControlPolicy 里必须有 owner
        //         "ID": 'qcs::cam::uin/459000000:uin/459000000' // 459000000 是 Bucket 所属用户的 QQ 号
        //     },
        //     "Grants": [{
        //         "Grantee": {
        //             "ID": "qcs::cam::uin/10002:uin/10002", // 10002 是 QQ 号
        //         },
        //         "Permission": "READ"
        //     }]
        // }
    }, function (err, data) {
        console.log(err || data);
    });
}

//获取对象Acl
function getObjectAcl() {
    cos.getObjectAcl({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Key: '测试ceshi.zip'
    }, function (err, data) {
        console.log(err || data);
    });
}
//删除一个对象
function deleteObject() {
    cos.deleteObject({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Key: '1mb.zip'
    }, function (err, data) {
        console.log(err || data);
    });
}

//删除一组对象
function deleteMultipleObject() {
    cos.deleteMultipleObject({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Objects: [
            {Key: '30mb.zip'},
        ]
    }, function (err, data) {
        console.log(err || data);
    });
}

function restoreObject() {
    cos.restoreObject({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Key: '黄蓉.mp4',
        RestoreRequest: {
            Days: 1,
            CASJobParameters: {
                Tier: 'Expedited'
            }
        }
    }, function (err, data) {
        console.log(err || data);
    });
}

//删除为完成的上传
function abortUploadTask() {
    cos.abortUploadTask({
        Bucket: config.Bucket, /* 必须 */ // Bucket 格式：test-1250000000
        Region: config.Region, /* 必须 */
        // 格式1，删除单个上传任务
        // Level: 'task',
        // Key: '10mb.zip',
        // UploadId: '14985543913e4e2642e31db217b9a1a3d9b3cd6cf62abfda23372c8d36ffa38585492681e3',
        // 格式2，删除单个文件所有未完成上传任务
        Level: 'file',
        Key: '30mb.zip',
        // 格式3，删除 Bucket 下所有未完成上传任务
        // Level: 'bucket',
    }, function (err, data) {
        console.log(err || data);
    });
}

//上传设定文件
function sliceUploadFile() {
    var blob = util.createFile({size: 1024 * 1024 * 2});
    cos.sliceUploadFile({
        Bucket: config.Bucket, // Bucket 格式：test-1250000000
        Region: config.Region,
        Key: '30mb.zip', /* 必须 */
        Body: blob,
        TaskReady: function (tid) {
            TaskId = tid;
        },
        onHashProgress: function (progressData) {
        },
        onProgress: function (progressData) {
            console.log('onProgress', JSON.stringify(progressData));
        },
    }, function (err, data) {
        console.log(err || data);
    });
}



/*startprogress()显示上传进度和上传状态 这个方法用到jq和vue 选择文件后上传
* progress 进度条
 * peeds 上传状态
 * percent 当前上传的进度
 * speed上传的速度
* */

var startprogress = function (progress,percent) {
    progress.show();
    progress.css('width',percent+'%');
    progress.html(percent+'%');
}
//path上传存放的路径field是vue的对象俩面包含了上传这块的全部信息
//用用法selectFileToUpload('#progress','#videourl');
function selectFileToUpload(field,path) {
    //选择文件后上传
    var input = document.createElement('input');
    //状态对象
    var speeds = $('#speed'+field.id);
    //进度条
    var progress =$('#progress'+field.id);
    input.type = 'file';
    input.onchange = function (e) {
        var file = this.files[0];
        //获取上传文件的名字去掉中文.replace(/[\u4E00-\u9FA5]/g,"c")把名字（字符串）中的中文字符都换成c
        var filename = file.name.replace(/[\u4E00-\u9FA5]/g,"c");
        //获取当前时间戳
        var timestamp= new Date().getTime();
        //组成新的名字
        var newname = path+'/'+timestamp+'and'+filename;
        if (file) {
            if (file.size > 1024 * 1024) {
                cos.sliceUploadFile({
                    Bucket: config.Bucket, // Bucket 格式：test-1250000000
                    Region: config.Region,
                    Key: newname,
                    Body: file,
                    TaskReady: function (tid) {
                        TaskId = tid;
                    },
                    onHashProgress: function (progressData) {
                        console.log('onHashProgress', JSON.stringify(progressData));
                        var percent = parseInt(progressData.percent * 10000) / 100;
                        var speed = parseInt(progressData.speed / 1024 / 1024 * 100) / 100;
                        console.log('进度：' + percent + '%; 速度：' + speed + 'Mb/s;');
                        //设置进度条
                        startprogress(progress,percent);
                        speeds.html('速度:' + speed + 'Mb/s');
                    },
                    onProgress: function (progressData) {
                        console.log('onProgress', JSON.stringify(progressData));
                        var percent = parseInt(progressData.percent * 10000) / 100;
                        var speed = parseInt(progressData.speed / 1024 / 1024 * 100) / 100;
                        console.log('进度：' + percent + '%; 速度：' + speed + 'Mb/s;');
                        //设置进度条
                        startprogress(progress,percent);
                        speeds.html('速度:' + speed + 'Mb/s');
                    }
                }, function (err, data) {
                    //上传成功后 把上传资源的地址传给 输入框
                    field.path = 'https://'+data.Location;
                    //上传状态
                    speeds.html('上传完成');
                    console.log(data.Location + ' ++++++上传' + (err ? '失败' : '完成'));
                    console.log(err || data);
                });
            } else {
                cos.putObject({
                    Bucket: config.Bucket, // Bucket 格式：test-1250000000
                    Region: config.Region,
                    Key: newname,
                    Body: file,
                    TaskReady: function (tid) {
                        TaskId = tid;
                    },
                    onProgress: function (progressData) {
                        console.log(JSON.stringify(progressData));
                        var percent = parseInt(progressData.percent * 10000) / 100;
                        var speed = parseInt(progressData.speed / 1024 / 1024 * 100) / 100;
                        console.log('2进度：' + percent + '%; 速度：' + speed + 'Mb/s;');
                        //设置进度条
                        startprogress(progress,percent);
                        speeds.html('速度:' + speed + 'Mb/s');
                    },
                }, function (err, data) {
                    //上传成功后 把上传资源的地址传给 输入框
                    field.path = 'https://'+data.Location;
                    //上传状态
                    speeds.html('上传完成');
                    console.log(err || data);
                    console.log(data.Location + ' ++++++上传' + (err ? '失败' : '完成'));
                });
            }
        }
    };
    input.click();
}


//上传
function uploadFiles() {
    var filename = '233.zip';
    var blob = util.createFile({size: 1024 * 1024 * 0.001});
    cos.uploadFiles({
        files: [{
            Bucket: config.Bucket, // Bucket 格式：test-1250000000
            Region: config.Region,
            Key: '测试' + filename,
            Body: blob,
        }],
        SliceSize: 1024 * 1024,
        onProgress: function (info) {
            var percent = parseInt(info.percent * 10000) / 100;
            var speed = parseInt(info.speed / 1024 / 1024 * 100) / 100;
            console.log('进度：' + percent + '%; 速度：' + speed + 'Mb/s;');
        },
        onFileFinish: function (err, data, options) {
            console.log(options.Key + ' 上传' + (err ? '失败' : '完成'));
        },
    }, function (err, data) {
        console.log(err || data);
    });
}

/*

(function () {
    var list = [
        // 'getService', // 不支持
        'getAuth',
        'getObjectUrl',
        // 'putBucket', // 不支持
        'getBucket',
        'headBucket',
        'putBucketAcl',
        'getBucketAcl',
        'putBucketCors',
        'getBucketCors',
        // 'deleteBucketCors', // 不提供
        'putBucketTagging',
        'getBucketTagging',
        'deleteBucketTagging',
        'putBucketPolicy',
        'getBucketPolicy',
        'getBucketLocation',
        'getBucketLifecycle',
        'putBucketLifecycle',
        'deleteBucketLifecycle',
        'deleteBucketLifecycle',
        'putBucketVersioning',
        'getBucketVersioning',
        'putBucketReplication',
        'getBucketReplication',
        'deleteBucketReplication',
        'deleteBucket',
        'putObject',
        'putObjectCopy',
        'getObject',
        'headObject',
        'putObjectAcl',
        'getObjectAcl',
        'deleteObject',
        'deleteMultipleObject',
        'restoreObject',
        'abortUploadTask',
        'sliceUploadFile',
        'selectFileToUpload', //选择文件后上传
        'uploadFiles', //上传
    ];
    var container = document.querySelector('.main');
    var html = [];
    list.forEach(function (name) {
        html.push('<a href="javascript:void(0)">' + name + '</a>');
    });
    container.innerHTML = html.join('');
    container.onclick = function (e) {
        if (e.target.tagName === 'A') {
            var name = e.target.innerText.trim();
            window[name]();
        }
    };
})();
*/
