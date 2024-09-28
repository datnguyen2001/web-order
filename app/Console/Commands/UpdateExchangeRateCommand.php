<?php

namespace App\Console\Commands;

use App\Models\SettingModel;
use Illuminate\Console\Command;

class UpdateExchangeRateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-exchange-rate-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
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
            try{
                $existingSetting->exchange_rate = $usd_to_vnd;
                $existingSetting->save();
                $this->info('Done');
            }catch(\Exception $e){
                $this->error($e->getMessage());
            }

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
