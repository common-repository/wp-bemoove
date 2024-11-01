<?php
class UserAccountInfo {

    const DEFAULT_BEHLS_HOST = "wordpress.behls-lite.jp";
    const OPTION_KEY = "BeMoOve_admin_datas";
    const ACCOUNT_ID_PARAM_KEY = "account_id";
    const ACCOUNT_APIPREKEY_PARAM_KEY = "account_apiprekey";
    const ACCOUNT_USER_NAME = "account_username";
    const ACCOUNT_COM_NAME = "account_comname";
    const ACCOUNT_USER_MAIL = "account_usermail";
    const ACCOUNT_USER_TEL = "account_usertel";
    const ACCOUNT_ACTIVATE = "account_activate";

    private $accountId;

    function getAccountId() {

        return $this->accountId;
    }

    private $accountApiprekey;

    function getAccountApiprekey() {

        return $this->accountApiprekey;
    }
	
    private $username;

    function getAccountUsername() {

        return $this->username;
    }
	
    private $comname;

    function getAccountComname() {

        return $this->comname;
    }
	
    private $usermail;

    function getAccountUsermail() {

        return $this->usermail;
    }
	
    private $usertel;

    function getAccountUsertel() {

        return $this->usertel;
    }
	
    private $activate;

    function getAccountActivate() {

        return $this->activate;
    }

    /** アカウント設定が完了済か否か  */
    function hasAccount() {

        return (!empty($this->accountId) && !empty($this->accountApiprekey));
    }

    private $behlsHost;
    public function getBehlsHost() {

        if (isset($this->behlsHost)) return $this->behlsHost;

        // 設定ファイルから読み込む   
        $this->behlsHost = self::getBehlsHostCore(); 
        return $this->behlsHost;
    }

    public static function getBehlsHostCore() {

        return (BEHLS_HOST_NAME == '' ? self::DEFAULT_BEHLS_HOST : BEHLS_HOST_NAME);
    }

    private $deliveryBehlsHost;
    public function getDeliveryBehlsHost() {

        if (isset($this->deliveryBehlsHost)) return $this->deliveryBehlsHost;

        // 設定ファイルから読み込む    
        $this->deliveryBehlsHost = self::getDeliveryBehlsHostCore();
        return $this->deliveryBehlsHost;
    }

    public static function getDeliveryBehlsHostCore() {

        return (BEHLS_DELIVERY_HOST_NAME == '' ? self::getBehlsHostCore() : BEHLS_DELIVERY_HOST_NAME);
    }

    private function __construct($accountId, $accountApiprekey,$username,$comname,$usermail,$usertel,$activate){

        $this->accountId = $accountId;
        $this->accountApiprekey = $accountApiprekey;
        $this->username = $username;
        $this->comname = $comname;
        $this->usermail = $usermail;
        $this->usertel = $usertel;
        $this->activate = $activate;
    }

    static function getInstance() {
        $opt = get_option(self::OPTION_KEY);
        
        return new UserAccountInfo(
            $opt[self::ACCOUNT_ID_PARAM_KEY]
            , $opt[self::ACCOUNT_APIPREKEY_PARAM_KEY]
            , $opt[self::ACCOUNT_USER_NAME]
            , $opt[self::ACCOUNT_COM_NAME]
            , $opt[self::ACCOUNT_USER_MAIL]
            , $opt[self::ACCOUNT_USER_TEL]
            , $opt[self::ACCOUNT_ACTIVATE]
        );
		
    }
	
	//
    static function createInstance($accountId, $accountApiprekey,$username="",$comname="",$usermail="",$usertel="",$activate="") {

        $instance = new UserAccountInfo($accountId, $accountApiprekey,$username,$comname,$usermail,$usertel,$activate);
        return $instance;
    }
	
	//
    function save() {

        $opt = array();
        $opt[self::ACCOUNT_ID_PARAM_KEY] = $this->accountId;
        $opt[self::ACCOUNT_APIPREKEY_PARAM_KEY] = $this->accountApiprekey;
        $opt[self::ACCOUNT_USER_NAME] = $this->username;
        $opt[self::ACCOUNT_COM_NAME] = $this->comname;
        $opt[self::ACCOUNT_USER_MAIL] = $this->usermail;
        $opt[self::ACCOUNT_USER_TEL] = $this->usertel;
        $opt[self::ACCOUNT_ACTIVATE] = $this->activate;
        update_option(self::OPTION_KEY, $opt);
    }

    function remove() {
        $opt = array();
        $opt[self::ACCOUNT_ID_PARAM_KEY] = '';
        $opt[self::ACCOUNT_APIPREKEY_PARAM_KEY] = '';
        $opt[self::ACCOUNT_USER_NAME] = '';
        $opt[self::ACCOUNT_COM_NAME] = '';
        $opt[self::ACCOUNT_USER_MAIL] = '';
        $opt[self::ACCOUNT_USER_TEL] = '';
        $opt[self::ACCOUNT_ACTIVATE] = '';
        $this->accountId = '';
        $this->accountApiprekey = '';
        $this->username = '';
        $this->comname = '';
        $this->usermail = '';
        $this->usertel = '';
        $this->activate = '';
        update_option(self::OPTION_KEY, $opt);
    }
}
?>
