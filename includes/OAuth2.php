<?php
class OAuth2 {
    function __construct($clientId, $secret, $redirectUrl) {
        $this->_clientId = $clientId;
        $this->_secret = $secret;
        $this->_redirectUrl = $redirectUrl;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function startRedirection($scope) {
        $randomString = OAuth2::generateToken();
        $_SESSION['discord']['state'] = $randomString;
        header('Location: https://discord.com/api/oauth2/authorize?client_id=' . $this->_clientId . '&redirect_uri=' . urlencode($this->_redirectUrl) . '&response_type=code&scope=' . join('%20', $scope) . "&state=" . $randomString);
    }

    public function isRedirected() {
        return isset($_GET['code']);
    }

    public function getCustomInformation($endpoint) {
        return $this->getInformation($endpoint);
    }

    public function getUserInformation() {
        return $this->getInformation('users/@me');
    }

    public function getConnectionsInformation() {
        return $this->getInformation('users/@me/connections');
    }

    public function getGuildsInformation() {
        return $this->getInformation('users/@me/guilds');
    }

    private function getInformation($endpoint) {
        if (!isset($_SESSION['discord']['token']) || empty($_SESSION['discord']['token'])) {
            $response = $this->loadToken();
            if ($response !== true) {
                return ["code" => 0, "message" => $response];
            }
        }
        $curl = curl_init('https://discord.com/api/v6/' . $endpoint);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, "false");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $_SESSION['discord']['token']
        ));
        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);
        return $response;
    }

    public function loadToken() {
        if (!isset($_SESSION['discord']['state']) || empty($_SESSION['discord']['state']) || $_GET['state'] != $_SESSION['discord']['state']) {
            unset($_SESSION['discord']);
            return 'Invalid state';
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://discord.com/api/v6/oauth2/token",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "client_id=" . $this->_clientId . "&client_secret=" . $this->_secret . "&grant_type=authorization_code&code=" . $_GET['code'] . "&redirect_uri=" . urlencode($this->_redirectUrl),
            CURLOPT_RETURNTRANSFER => "false"
        ));
        $response = json_decode(curl_exec($curl), true);
        if ($response === null) {
            return 'Invalid state';
        }
        if (array_key_exists('error_description', $response)) {
            return $response['error_description'];
        }
        $_SESSION['discord']['token'] = $response['access_token'];
        curl_close($curl);
        return true;
    }

    private static function generateToken() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLen = strlen($characters);
        $randomString = "";
        for ($i = 0; $i < 20; $i++) {
            $randomString .= $characters[rand(0, $charactersLen - 1)];
        }
        return $randomString;
    }

    private $_clientId;
    private $_secret;
    private $_redirectUrl;
}
?>
