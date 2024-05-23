<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function show()
    {
        $commentsCount = Comment::all()->count();
        $productsCount = Product::all()->count();
        $transactionsCount = Transaction::all()->count();
        $ordersCount = Order::all()->count();

        $month = 12;

        $successTransactions = Transaction::getData($month, 1);
        $successTransactionsChart = $this->chart($successTransactions, $month);

        $unsuccessTransactions = Transaction::getData($month, 0);
        $unsuccessTransactionsChart = $this->chart($unsuccessTransactions, $month);

        return view('admin.dashboard', [
            'successTransactions' => array_values($successTransactionsChart),
            'unsuccessTransactions' => array_values($unsuccessTransactionsChart),
            'labels' => array_keys($successTransactionsChart),
            'transactionsCount' => [
                $successTransactions->count(),
                $unsuccessTransactions->count(),
            ],
            'cards' => [
                'comments' => $commentsCount,
                'products' => $productsCount,
                'transactions' => $transactionsCount,
                'orders' => $ordersCount,
            ],

        ]);
    }

    private function chart($transaction, $month)
    {
        $monthName = $transaction->map(function ($item) {
            return verta($item->created_at)->format('%B %y');
        });

        $amount = $transaction->map(function ($item) {
            return $item->amount;
        });

        $result = [];

        foreach ($monthName as $i => $v) {
            if (!isset($result[$v])) {
                $result[$v] = 0;
            }
            $result[$v] += $amount[$i];
        }

        if (count($result) != $month) {
            for ($i = 0; $i < $month; $i++) {
                $monthName = verta()->subMonths($i)->format('%B %y');
                $jalaliMonth[$monthName] = 0;
            }
            return array_reverse(array_merge($jalaliMonth, $result));
        }

        return $result;
    }

}
