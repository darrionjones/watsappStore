<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreAnalytic extends Controller
{
    public function index()
    {
        $chartData = $this->getOrderChart(['duration' => 'month']);
        $user = Auth::user();
        $store = Store::where('id', $user->current_store)->first();
        $slug = $store->slug;

        $visitor_url = $store->visitLogs()->selectRaw("count('*') as total, url")->groupBy('url')->orderBy('total', 'DESC')->get();
        $user_device = $store->visitLogs()->selectRaw("count('*') as total, device")->groupBy('device')->orderBy('device', 'DESC')->get();
        $user_browser = $store->visitLogs()->selectRaw("count('*') as total, browser")->groupBy('browser')->orderBy('browser', 'DESC')->get();
        $user_platform = $store->visitLogs()->selectRaw("count('*') as total, platform")->groupBy('platform')->orderBy('platform', 'DESC')->get();

        $devicearray = [];
        $devicearray['label'] = [];
        $devicearray['data'] = [];

        foreach ($user_device as $name => $device) {
            if (!empty($device->device)) {
                $devicearray['label'][] = $device->device;
            } else {
                $devicearray['label'][] = 'Other';
            }
            $devicearray['data'][] = $device->total;
        }

        $browserarray = [];
        $browserarray['label'] = [];
        $browserarray['data'] = [];

        foreach ($user_browser as $name => $browser) {
            $browserarray['label'][] = $browser->browser;
            $browserarray['data'][] = $browser->total;
        }
        $platformarray = [];
        $platformarray['label'] = [];
        $platformarray['data'] = [];

        foreach ($user_platform as $name => $platform) {
            $platformarray['label'][] = $platform->platform;
            $platformarray['data'][] = $platform->total;
        }

        return view('store-analytic', compact('chartData', 'visitor_url', 'devicearray', 'browserarray', 'platformarray', 'slug'));
    }

    public function getOrderChart($arrParam)
    {
        $user = Auth::user();
        $store = Store::where('id', $user->current_store)->first();
        $slug = $store->slug;

        $arrDuration = [];
        if ($arrParam['duration']) {
            if ($arrParam['duration'] == 'month') {
                $previous_month = strtotime("-1 month +2 day");
                for ($i = 0; $i < 7; $i++) {
                    $arrDuration[date('Y-m-d', $previous_month)] = date('d-M', $previous_month);
                    $previous_month = strtotime(date('Y-m-d', $previous_month) . " +1 day");
                }
            }
        }
        $arrTask = [];
        $arrTask['label'] = [];
        $arrTask['data'] = [];

        foreach ($arrDuration as $date => $label) {
            $data['visitor'] = $store->visitLogs()->select(DB::raw('count(*) as total'))->whereDate('created_at', '=', $date)->first();
            $uniq = $store->visitLogs()->select('ip')->distinct()->where('slug', $slug)->whereDate('created_at', '=', $date)->get();

            $data['unique'] = $uniq->count();
            $arrTask['label'][] = $label;
            $arrTask['data'][] = $data['visitor']->total;
            $arrTask['unique_data'][] = $data['unique'];
        }

        return $arrTask;
    }
}
