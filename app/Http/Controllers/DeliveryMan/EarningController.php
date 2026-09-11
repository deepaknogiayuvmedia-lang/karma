<?php

namespace App\Http\Controllers\DeliveryMan;

use App\CPU\Convert;
use App\Http\Controllers\Controller;
use App\Model\DeliveryManTransaction;
use App\Model\DeliverymanWallet;
use App\Model\WithdrawRequest;
use App\Traits\CommonTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class EarningController extends Controller
{
    public function earning()
    {
        $deliveryMan = auth('delivery_man')->user();
        $wallet = DeliverymanWallet::where('delivery_man_id', $deliveryMan->id)->first();

        $transactions = DeliveryManTransaction::where('delivery_man_id', $deliveryMan->id)
            ->orderBy('id', 'desc')
            ->paginate(20);

        $totalEarning = ($wallet->current_balance ?? 0) + ($wallet->total_withdraw ?? 0);
        $withdrawable = ($wallet->current_balance ?? 0) - ($wallet->cash_in_hand ?? 0) - ($wallet->pending_withdraw ?? 0);

        return view('delivery-man-views.earning', compact(
            'wallet', 'transactions', 'totalEarning', 'withdrawable', 'deliveryMan'
        ));
    }

    public function withdraw_form()
    {
        $deliveryMan = auth('delivery_man')->user();
        $wallet = DeliverymanWallet::where('delivery_man_id', $deliveryMan->id)->first();

        $totalEarning = ($wallet->current_balance ?? 0) + ($wallet->total_withdraw ?? 0);
        $withdrawable = ($wallet->current_balance ?? 0) - ($wallet->cash_in_hand ?? 0) - ($wallet->pending_withdraw ?? 0);

        return view('delivery-man-views.withdraw', compact(
            'wallet', 'totalEarning', 'withdrawable', 'deliveryMan'
        ));
    }

    public function submit_withdraw(Request $request)
    {
        $deliveryMan = auth('delivery_man')->user();

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:bank_transfer,bkash,nagad,rocket,manual',
            'account_number' => 'required|string|min:5|max:50',
            'account_holder_name' => 'nullable|string|max:100',
            'note' => 'nullable|string|max:255',
        ]);

        $withdrawable = CommonTrait::delivery_man_withdrawable_balance($deliveryMan->id);

        if ($request->amount > $withdrawable) {
            return back()->with('error', 'Amount exceeds withdrawable balance!');
        }

        if ($request->amount < 1) {
            return back()->with('error', 'Invalid withdraw amount!');
        }

        $wallet = DeliverymanWallet::where('delivery_man_id', $deliveryMan->id)->first();
        if (!$wallet) {
            return back()->with('error', 'Wallet not found!');
        }

        $parentId = $deliveryMan->seller_id ?? 0;

        WithdrawRequest::create([
            'delivery_man_id' => $deliveryMan->id,
            'seller_id' => $parentId == 0 ? null : $parentId,
            'admin_id' => $parentId == 0 ? 1 : null,
            'amount' => Convert::usd($request->amount),
            'transaction_note' => $request->note ?? '',
            'withdrawal_method_fields' => json_encode([
                'payment_method' => $request->payment_method,
                'account_number' => $request->account_number,
                'account_holder_name' => $request->account_holder_name ?? '',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $wallet->pending_withdraw += Convert::usd($request->amount);
        $wallet->save();

        Toastr::success('Withdraw request submitted successfully!');
        return back();
    }
}
