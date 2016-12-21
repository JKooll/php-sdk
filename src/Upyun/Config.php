<?php
namespace Upyun;

/**
 * Class Config
 *
 * @package Upyun
 */
class Config {
    /**
     * @var string 服务名称
     */
    public $bucketName;
    /**
     * @var string 操作员名
     */
    public $operatorName;
    /**
     * @var string 操作员密码 md5 hash 值
     */
    public $operatorPassword;

    /**
     * @var bool 是否使用 https
     */
    public $useSsl;

    /**
     * @var string 上传使用的接口类型，可以设置为 `REST`：使用 rest api 上传，`AUTO` 根据文件大小自动判断，`BLOCK` 使用断点续传
     * 当上传小文件时，不推荐使用断点续传；上传时如果设置了异步预处理`withAsyncProcess=true`，将会使用表单 api 上传
     */
    public $uploadType = 'AUTO';

    /**
     * @var int 上传的接口类型设置为 `AUTO` 时，文件大小的边界值：小于该值时，使用 rest api，否则使用断点续传。 默认 30M
     */
    public $sizeBoundary = 31457280;
    /**
     * @var int 分块上传`Multi`接口的最大分块值
     */
    public $maxBlockSize = 5242880;

    /**
     * @var int 分块时，每个块的过期时间
     */
    public $blockExpiration = 60;

    /**
     * @var int request timeout seconds
     */
    public $timeout = 60;


    /**
     * @var string 异步云处理的回调通知地址
     */
    public $processNotifyUrl;

    private $version = '3.0.0';



    /**
     * @var string 表单 api 的秘钥
     */
    private $formApiKey;

    /**
     * @var string rest api 和 form api 的接口地址
     */
    static $restApiEndPoint;


    /**
     * rest api 和 form api 接口请求地址，详见：http://docs.upyun.com/api/rest_api/
     */
    const ED_AUTO            = 'v0.api.upyun.com';
    const ED_TELECOM         = 'v1.api.upyun.com';
    const ED_CNC             = 'v2.api.upyun.com';
    const ED_CTT             = 'v3.api.upyun.com';

    /**
     * 分块上传接口请求地址
     */
    const ED_FORM            = 'm0.api.upyun.com';

    /**
     * 异步云处理接口地址
     */
    const ED_VIDEO           = 'p0.api.upyun.com';

    /**
     * 刷新接口地址
     */
    const ED_PURGE           = 'http://purge.upyun.com/purge/';

    public function __construct($bucketName, $operatorName, $operatorPassword) {
        $this->bucketName = $bucketName;
        $this->operatorName = $operatorName;
        $this->setOperatorPassword($operatorPassword);
        $this->useSsl          = false;
        self::$restApiEndPoint = self::ED_AUTO;
    }

    public function setOperatorPassword($operatorPassword) {
        $this->operatorPassword = md5($operatorPassword);
    }

    public function getFormApiKey() {
        if(! $this->formApiKey) {
            throw new \Exception('form api key is empty.');
        }

       return $this->formApiKey;
    }

    public function setFormApiKey($key) {
        $this->formApiKey = $key;
    }

    public function getVersion() {
        return $this->version;
    }
}
