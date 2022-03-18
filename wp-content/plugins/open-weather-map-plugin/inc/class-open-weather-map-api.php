<?php

defined('ABSPATH') or die();


class OpenWeatherMapApi
{
    public function __construct()
    {
        //add settings option to save API Key
        add_action('admin_init', [$this, 'register_api_key_setting_options']);
        //TODO Call Weather Data for X City
    }

    /**
     * Add API key option to wp general page
     */
    function register_api_key_setting_options()
    {
        add_settings_section(
            'owm_section_id',
            'Open Weather Map API Key',
            function () {
                echo '<p>You can add you open Weather Map API here. You can get one from this page <a href="https://openweathermap.org/api" target="_blank">Openweathermap</a></p>';
            },
            'general'
        );

        add_settings_field(
            'owm_api_key',
            'API Key',
            [$this, 'render_api_key_settings_option'],
            'general',
            'owm_section_id'
        );

        register_setting(
            'general',
            'owm_api_key',
            'esc_attr'
        );
    }

    /**
     * render input field for api key option
     */
    function render_api_key_settings_option()
    {
        $value = get_option('owm_api_key');
        ?>
        <label for="owm_api_key_field">
            <input id="owm_api_key_field" type="text" value="<?php echo $value; ?>" name="owm_api_key">
        </label>
        <?php
    }

    /**
     * Function to crawl data from Open weather API
     * @param $lat
     * @param $lon
     * @param string $units
     * @return string
     */
    public static function get_data_from_owm($lat, $lon, string $units = 'metric'): string
    {

        $api_key = get_option('owm_api_key');
        //check api key
        if (empty($api_key)) {
            return 'Pls check your Open weather API Key!';
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $lon . '&appid=' . $api_key . '&units=' . $units,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);

        //catch curl error
        if (curl_errno($curl)) {
            return 'Curl error: ' . curl_error($curl);
        }

        curl_close($curl);

        //check & parse Data
        $data = json_decode($response, true);

        if (isset($data['cod']) && $data['cod'] != 200) {
            return 'Error! code:' . $data['message'];
        }

        return 'Temperature now: ' . $data['main']['temp'] . '°C';
    }
}

new OpenWeatherMapApi();
