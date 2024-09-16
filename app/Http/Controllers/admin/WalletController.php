<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WalletHistoriesModel;
use App\Models\WalletsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        $titlePage = 'Danh sách nạp tiền';
        $page_menu = 'wallet';
        $page_sub = null;
        $keySearch = $request->get('key_search');
        $query = WalletHistoriesModel::with('user');

        if (!empty($keySearch)) {
            $query->where(function ($q) use ($keySearch) {
                $q->whereHas('user', function ($subQuery) use ($keySearch) {
                    $subQuery->where('full_name', 'like', '%' . $keySearch . '%')
                        ->orWhere('phone', 'like', '%' . $keySearch . '%');
                })
                    ->orWhere('transaction_code', 'like', '%' . $keySearch . '%');
            });
        }
        $listData = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.wallet.index', compact('titlePage', 'page_menu', 'page_sub', 'listData'));
    }

    public function create ()
    {
        try{
            $titlePage = 'Thêm bài viết';
            $page_menu = 'post';
            $page_sub = null;
            $listUser = User::all();

            return view('admin.wallet.create', compact('titlePage', 'page_menu', 'page_sub','listUser'));
        }catch (\Exception $e){
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function store (Request $request)
    {
        try{
            $wallet = WalletsModel::where('user_id',$request->get('user_id'))->first();
            $amount = str_replace(",", "", $request->get('amount'));
            $wallet_type = $request->get('wallet_type');
            $timestamp = date('YmdHis');
            $transactionCode = 'GD' . $timestamp . $request->get('user_id');
            if ($wallet_type == 1){
                $old_balance = $wallet->vietnamese_money;
                $new_balance = $wallet->vietnamese_money + $amount;
            }else{
                $old_balance = $wallet->middle_money;
                $new_balance = $wallet->middle_money + $amount;
            }

            $walletHistory = new WalletHistoriesModel([
                'user_id' =>$request->get('user_id'),
                'transaction_code' =>$transactionCode,
                'amount' => $amount,
                'old_balance' => $old_balance,
                'new_balance' => $new_balance,
                'description' =>$request->get('description'),
                'wallet_type' => $wallet_type,
                'type'=>1,
            ]);
            $walletHistory->save();
            if ($wallet_type == 1){
            $wallet->vietnamese_money = $wallet->vietnamese_money + $amount;
                }else{
                $wallet->middle_money = $wallet->middle_money + $amount;
            }
            $wallet->save();

            return redirect()->route('admin.wallet.index')->with(['success' => 'Nạp tiền thành công']);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage()]);
        }
    }
}
