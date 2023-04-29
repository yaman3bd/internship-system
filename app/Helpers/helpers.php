<?php
if (! function_exists('getCountries')) {
    function getCountries()
    {
        return collect(json_decode(file_get_contents(database_path('seeders/data/countries.json')), true));
    }
}
