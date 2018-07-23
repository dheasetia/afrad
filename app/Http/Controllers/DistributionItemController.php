<?php

namespace App\Http\Controllers;

use App\DistributionItem;
use App\Http\Requests\DistributionItemPostRequest;
use Illuminate\Http\Request;

class DistributionItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_active');

    }
    // A J A X
    public function ajax_store(DistributionItemPostRequest $request)
    {
        $distribution_item = new DistributionItem();
        $distribution_item->seq_num = $request->seq_num;
        $distribution_item->distribution_id = $request->distribution_id;
        $distribution_item->is_money = $request->is_money;
        $distribution_item->item_id = $request->item_id;
        $distribution_item->cost = $request->cost;
        $distribution_item->quantity = $request->quantity;
        $distribution_item->subtotal = intval($request->cost) * intval($request->quantity);
        $distribution_item->save();

        if ($distribution_item->id == null) {
            $result = [
                'status'    => 'fail',
                'message'   => 'تعذر حفظ البند',
            ];
        } else {
            $result = [
                'status' => 'success',
                'message'   => 'تم حفظ بند  المساعدة',
                'seq_num'       => $distribution_item->seq_num,
                'is_money'  => $distribution_item->is_money == '1' ? 'نقدي' : 'عيني',
                'item'      => $distribution_item->item->item,
                'cost'      => $distribution_item->cost,
                'quantity'      => $distribution_item->quantity,
                'subtotal'      => $distribution_item->subtotal,
            ];
        }
        return response()->json($result);
    }
}
