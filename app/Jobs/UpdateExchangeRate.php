<?php

namespace App\Jobs;

use App\Models\SettingModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateExchangeRate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url = "https://portal.vietcombank.com.vn/Usercontrols/TVPortal.TyGia/pXML.aspx?b=10";

        $response = $this->getSslPage($url);

        $result_array = json_decode(json_encode(simplexml_load_string($response)), true);

        foreach ($result_array['Exrate'] as $currency) {
            if ($currency['@attributes']['CurrencyCode'] == 'CNY') {
                $usd_to_vnd = $currency['@attributes']['Sell'];
                $usd_to_vnd = floatval(str_replace(',', '', $usd_to_vnd));
                break;
            }
        }

        $existingSetting = SettingModel::first();
        if ($existingSetting){
            $existingSetting->exchange_rate = $usd_to_vnd;
            $existingSetting->save();
        }

    }
    private function getSslPage($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'spider');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}
